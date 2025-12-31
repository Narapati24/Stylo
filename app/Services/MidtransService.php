<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function createSnapToken($transaction)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->code,
                'gross_amount' => (int) $transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'item_details' => $transaction->items->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'price' => (int) $item->product->price,
                    'quantity' => $item->quantity,
                    'name' => substr($item->product->name, 0, 50),
                ];
            })->toArray(),
            'callbacks' => [
                'finish' => route('front.orders.index'),
            ],
        ];

        // Add shipping cost as an item if it exists
        if ($transaction->shipping_price > 0) {
            $params['item_details'][] = [
                'id' => 'SHIPPING',
                'price' => (int) $transaction->shipping_price,
                'quantity' => 1,
                'name' => 'Shipping Cost',
            ];
        }

        return Snap::getSnapToken($params);
    }

    public function checkTransactionStatus($orderId)
    {
        return Transaction::status($orderId);
    }
}
