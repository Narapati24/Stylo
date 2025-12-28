<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function index()
    {
        return view('front.collection');
    }
}
