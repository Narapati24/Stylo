<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CollectionController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->inRandomOrder()->get();
        return view('front.pages.collections', compact('categories'));
    }
}
