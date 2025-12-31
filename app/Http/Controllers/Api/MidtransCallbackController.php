<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = Transaction::where('code', $request->order_id)->first();

            if (!$transaction) {
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaction->update(['status' => 'PAID']);
            } elseif ($request->transaction_status == 'pending') {
                $transaction->update(['status' => 'PENDING']);
            } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                $transaction->update(['status' => 'CANCELLED']);
            }

            return response()->json(['message' => 'Callback success']);
        }

        return response()->json(['message' => 'Invalid signature'], 400);
    }
}
