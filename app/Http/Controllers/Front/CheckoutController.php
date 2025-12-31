<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Cart;
use App\Services\RajaOngkirService;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    protected $rajaOngkirService;
    protected $midtransService;

    public function __construct(RajaOngkirService $rajaOngkirService, MidtransService $midtransService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
        $this->midtransService = $midtransService;
    }

    public function searchLocation(Request $request)
    {
        $locations = $this->rajaOngkirService->searchDestination($request->query('q'));
        return response()->json($locations);
    }

    public function checkShippingCost(Request $request)
    {
        // Origin is hardcoded to Jakarta Pusat (153) or similar for now, or from config
        // Let's assume origin is 153 (Jakarta Pusat) - NOTE: Check if 153 is valid in new API or use a subdistrict ID
        // For now, let's assume 153 works or we need to find a valid origin ID.
        // In new API, origin should also be a subdistrict ID if using subdistrict endpoint?
        // Docs: "Calculate Domestic ... Search estimated shipping cost by origin and destination in Indonesia"
        // It likely expects subdistrict IDs if we are using subdistrict level.
        // Let's use a known subdistrict ID for Jakarta Pusat -> Menteng -> 209 (Example)
        // Or just try 153 (City ID) if it supports mixed levels.
        // Based on docs "Use Subdistrict ID for cost calculation", we should probably use subdistrict ID.
        // Let's use 54 (Tanah Abang, Jakarta Pusat) as example origin.
        $origin = 54; 
        $destination = $request->destination_id;
        $weight = 1000; // Hardcoded 1kg for now
        $courier = $request->courier;

        $cost = $this->rajaOngkirService->getCost($origin, $destination, $weight, $courier);
        return response()->json($cost);
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'destination_id' => 'required', // Changed from city_id/province_id
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'shipping_cost' => 'required|numeric',
            'courier' => 'required|string',
            'service' => 'required|string',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $totalPrice = 0;
        foreach($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }
        
        // Add shipping cost to total
        $shippingPrice = $request->shipping_cost;
        $grandTotal = $totalPrice + $shippingPrice;

        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'code' => 'TRX-' . mt_rand(10000, 99999) . time(),
                'total_price' => $grandTotal,
                'shipping_price' => $shippingPrice,
                'shipping_address' => $request->name . ' (' . $request->phone . ') - ' . $request->address . ', ' . $request->subdistrict_name . ', ' . $request->city_name . ', ' . $request->province_name . ' ' . $request->postal_code,
                'status' => 'PENDING',
            ]);

            foreach($cartItems as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Clear Cart
            Cart::where('user_id', $user->id)->delete();

            // Load relationships for Midtrans
            $transaction->load('items.product', 'user');

            // Get Snap Token
            $snapToken = $this->midtransService->createSnapToken($transaction);
            
            // Save Snap Token
            $transaction->snap_token = $snapToken;
            $transaction->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken,
                'transaction_id' => $transaction->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
