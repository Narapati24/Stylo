<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = \App\Models\Products::count();
        $totalCategories = \App\Models\Category::count();
        $totalUsers = \App\Models\User::where('role', 'customer')->count();
        
        $recentProducts = \App\Models\Products::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalUsers', 'recentProducts'));
    }
}
