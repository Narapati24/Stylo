<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Products;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(RajaOngkirService $rajaOngkirService)
    {
        if (!Auth::check()) {
             return redirect()->route('login')->with('error', 'Please login to view your cart');
        }

        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('product')
                        ->latest()
                        ->get();
        
        $total_price = 0;
        foreach($cartItems as $item) {
            if($item->product) {
                 $total_price += $item->product->price * $item->quantity;
            }
        }

        // $provinces = $rajaOngkirService->getProvinces();

        return view('front.orders.cart', compact('cartItems', 'total_price'));
    }

    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Please login to add items to cart'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        $product = Products::findOrFail($id);
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $id)
                        ->first();

        if($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1
            ]);
        }
    
        if ($request->wantsJson()) {
            return response()->json(['success' => 'Product added to cart successfully!']);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    public function removeFromCart($id)
    {
        if (!Auth::check()) {
             return redirect()->route('login');
        }

        // Here $id is the ID of the cart item (primary key of carts table)
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->first();
        
        if($cartItem) {
            $cartItem->delete();
        }
        
        return redirect()->back()->with('success', 'Product removed successfully!');
    }
}
