<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Kategori
Route::get('/categories', [ProductCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [ProductCategoryController::class, 'create'])->name('product-category.create');
Route::post('/categories', [ProductCategoryController::class, 'store'])->name('product-category.store');
Route::get('/categories/{category}/edit', [ProductCategoryController::class, 'edit'])->name('product-category.edit');
Route::put('/categories/{category}', [ProductCategoryController::class, 'update'])->name('product-category.update');
Route::delete('/categories/{category}', [ProductCategoryController::class, 'destroy'])->name('product-category.destroy');

// Produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
