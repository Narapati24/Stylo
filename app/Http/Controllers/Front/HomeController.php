<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Products::query()
            ->search($request->search)
            ->filterCategory($request->category_id)
            ->latest();

        if ($request->ajax() || $request->wantsJson()) {
            $products = $query->take(5)->get(); // Limit results for live search
            return response()->json([
                'products' => $products->map(function($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => number_format($product->price, 0, ',', '.'),
                        'image_url' => $product->image_url,
                        'url' => route('front.product', $product->id)
                    ];
                })
            ]);
        }

        $products = $query->get();

        return view('front.home', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);
        return view('front.product-detail', compact('product'));
    }
}
