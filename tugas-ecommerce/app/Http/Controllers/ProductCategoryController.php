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

    /**
     * Tampilkan halaman form tambah kategori produk.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Validasi input form lalu simpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada, gunakan nama lain.',
        ]);

        ProductCategory::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }
}
