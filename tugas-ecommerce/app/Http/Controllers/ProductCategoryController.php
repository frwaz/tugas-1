<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Tampilkan daftar semua kategori beserta jumlah produknya.
     */
    public function index()
    {
        // withCount('products') membuat kolom tambahan "products_count"
        // tanpa perlu query terpisah untuk menghitung produk tiap kategori.
        $categories = ProductCategory::withCount('products')
            ->orderBy('name')
            ->get();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }
}
