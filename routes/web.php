<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CollectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleController;

// Auth Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Google Auth
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// Front Routes
Route::name('front.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product/{id}', [HomeController::class, 'show'])->name('product');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    // Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    Route::get('/collection', [CollectionController::class, 'index'])
        ->name('collection');
});

// Compatibility: some packages or views may call route('home') without the
// 'front.' prefix. Provide a simple alias that redirects to the front home.
Route::get('/home', function () {
    return redirect()->route('front.home');
})->name('home');
// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Product Resource Routes
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});
