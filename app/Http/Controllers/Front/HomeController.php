<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Products::all()->map(function ($product) {
            $product->image_url = asset('storage/' . $product->image);
            return $product;
        });
        return view('front.home', compact('products'));
    }

    public function show($id)
    {
        return view('front.product-detail');
    }
}
