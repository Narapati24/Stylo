<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function show($id)
    {
        return view('front.product-detail');
    }
}
