<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Products::query()
            ->search($request->search)
            ->filterCategory($request->category_id)
            ->latest()
            ->get();

        return view('front.home', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);
        return view('front.product-detail', compact('product'));
    }
}
