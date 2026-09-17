<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk, dengan opsi filter berdasarkan kategori
     * lewat query string ?category=ID_KATEGORI
     */
    public function index(Request $request)
    {
        // with('category') = eager load supaya tidak query berulang (N+1)
        // saat menampilkan nama kategori tiap produk di view.
        $query = Product::with('category')->latest();

        if ($request->filled('category')) {
            $query->where('category_id', $request->query('category'));
        }

        $products = $query->get();

        // Dikirim juga supaya view bisa menampilkan dropdown/filter kategori.
        $categories = ProductCategory::orderBy('name')->get();

        return view('products.index', [
            'products'   => $products,
            'categories' => $categories,
            'selectedCategory' => $request->query('category'),
        ]);
    }

    /**
     * Tampilkan detail satu produk.
     */
    public function show(Product $product)
    {
        $product->load('category');

        return view('products.show', [
            'product' => $product,
        ]);
    }
}
