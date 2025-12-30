<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->route('front.cart')->with('error', 'Cart is empty');
        }
        
        $total_price = 0;
        foreach($cart as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
        
        return view('front.orders.checkout', compact('cart', 'total_price'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->route('front.cart')->with('error', 'Cart is empty');
        }

        $total_price = 0;
        foreach($cart as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
        
        $shipping_price = 0; // Logic for shipping price can be added here

        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'code' => 'TRX-' . mt_rand(10000, 99999) . '-' . time(),
                'total_price' => $total_price + $shipping_price,
                'shipping_price' => $shipping_price,
                'shipping_address' => $request->shipping_address . ', ' . $request->city . ', ' . $request->postal_code,
                'status' => 'PENDING',
            ]);

            foreach($cart as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('front.home')->with('success', 'Checkout successful! Transaction Code: ' . $transaction->code);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
}
