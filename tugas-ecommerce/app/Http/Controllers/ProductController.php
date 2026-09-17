<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan semua produk, dengan opsi filter kategori
    public function index(Request $request)
    {
        $category = $request->query('category');

        $products = Product::when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    // Tampilkan detail satu produk
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
