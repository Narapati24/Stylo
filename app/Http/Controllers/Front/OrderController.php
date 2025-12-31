<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function index(Request $request)
    {
        if ($request->has('order_id') && $request->has('status_code')) {
            $code = $request->query('order_id');
            $transaction = Transaction::where('code', $code)->where('user_id', Auth::id())->first();
            
            if ($transaction && $transaction->status == 'PENDING') {
                try {
                    $status = $this->midtransService->checkTransactionStatus($transaction->code);
                    if ($status->transaction_status == 'capture' || $status->transaction_status == 'settlement') {
                        $transaction->update(['status' => 'PAID']);
                    } elseif ($status->transaction_status == 'deny' || $status->transaction_status == 'expire' || $status->transaction_status == 'cancel') {
                        $transaction->update(['status' => 'CANCELLED']);
                    }
                } catch (\Exception $e) {
                    // Log error or ignore, user can check manually
                }
            }
        }

        $orders = Transaction::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('front.orders.index', compact('orders'));
    }

    public function downloadInvoice($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);

        if ($transaction->status !== 'PAID' && $transaction->status !== 'SUCCESS') {
            return redirect()->back()->with('error', 'Invoice is only available for paid orders.');
        }

        $pdf = Pdf::loadView('front.orders.invoice', compact('transaction'));
        return $pdf->download('invoice-' . $transaction->code . '.pdf');
    }

    public function checkStatus($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        
        if ($transaction->status == 'PAID' || $transaction->status == 'CANCELLED') {
            return redirect()->back()->with('status', 'Transaction status is already updated.');
        }

        try {
            $status = $this->midtransService->checkTransactionStatus($transaction->code);
            
            if ($status->transaction_status == 'capture' || $status->transaction_status == 'settlement') {
                $transaction->update(['status' => 'PAID']);
            } elseif ($status->transaction_status == 'deny' || $status->transaction_status == 'expire' || $status->transaction_status == 'cancel') {
                $transaction->update(['status' => 'CANCELLED']);
            } elseif ($status->transaction_status == 'pending') {
                $transaction->update(['status' => 'PENDING']);
            }

            return redirect()->back()->with('status', 'Transaction status updated.');
        } catch (\Exception $e) {
            // If transaction doesn't exist in Midtrans (404), it means user hasn't paid yet
            if (str_contains($e->getMessage(), '404') || str_contains($e->getMessage(), 'Transaction doesn\'t exist')) {
                return redirect()->back()->with('warning', 'Payment has not been processed yet.');
            }
            return redirect()->back()->with('error', 'Failed to check status: ' . $e->getMessage());
        }
    }
}
