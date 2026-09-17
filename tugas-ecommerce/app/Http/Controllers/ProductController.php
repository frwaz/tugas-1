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

    // Form tambah produk baru
    public function create()
    {
        return view('products.create');
    }

    // Simpan produk baru ke database
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Tampilkan detail satu produk
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Form edit produk
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update data produk
    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // Aturan validasi dipakai bersama oleh store() dan update()
    private function validateProduct(Request $request)
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:2048',
            'stock'       => 'required|integer|min:0',
            'category'    => 'nullable|string|max:100',
        ]);
    }
}
