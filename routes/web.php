<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

// Front Routes
Route::name('front.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product/{id}', [HomeController::class, 'show'])->name('product');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    // Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Product Resource Routes
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});
