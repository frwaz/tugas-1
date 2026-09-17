<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Daftar produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Keranjang belanja
Route::get('/cart', function () {
    return view('cart');
})->name('cart.index');

// Checkout
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout.index');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
