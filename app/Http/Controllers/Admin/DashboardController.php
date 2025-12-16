<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = \App\Models\Products::count(); // hitung total produk
        return view('admin.dashboard', compact('totalProducts'));
    }
}
