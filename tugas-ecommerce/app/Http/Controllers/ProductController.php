<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan semua produk, dengan opsi filter kategori (?category=ID)
    public function index(Request $request)
    {
        $categoryId = $request->query('category');

        $products = Product::with('category')
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = ProductCategory::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    // Form tambah produk baru
    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('products.create', compact('categories'));
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
        // Setiap kali halaman detail produk dibuka, hitung sebagai satu "klik"
        $product->increment('clicks');

        $product->load('category');

        return view('products.show', compact('product'));
    }

    // Form edit produk
    public function edit(Product $product)
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
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
            'category_id' => 'nullable|exists:categories,id',
        ]);
    }
}
