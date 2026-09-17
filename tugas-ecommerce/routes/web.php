<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Kategori Produk — publik: lihat daftar kategori beserta jumlah produknya
Route::get('/categories', [ProductCategoryController::class, 'index'])->name('categories.index');

// Produk — publik: lihat daftar & detail produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Halaman (Pages) — publik: lihat daftar & detail halaman
Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('/pages/{page:slug}', [PageController::class, 'show'])->name('pages.show');

// ==========================================================================
// Route khusus Admin — hanya bisa diakses pengguna yang sudah login DAN
// memiliki role "admin" (dicek oleh middleware "admin" / AdminMiddleware).
// Kalau belum login akan diarahkan ke /login, kalau login tapi bukan admin
// akan mendapat error 403.
// ==========================================================================
Route::middleware(['auth', 'admin'])->group(function () {
    // Kategori — kelola (create/edit/delete)
    Route::get('/categories/create', [ProductCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [ProductCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [ProductCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [ProductCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [ProductCategoryController::class, 'destroy'])->name('categories.destroy');

    // Produk — kelola (create/edit/delete)
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Halaman (Pages) — kelola (create/edit/delete)
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{page:slug}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page:slug}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{page:slug}', [PageController::class, 'destroy'])->name('pages.destroy');
});

// Keranjang belanja
Route::get('/cart', function () {
    return view('cart');
})->name('cart.index');

// Checkout
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout.index');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
