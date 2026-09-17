<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Setiap kali halaman detail produk dibuka, hitung sebagai satu klik.
        $product->increment('klik');

        return view('products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Tampilkan halaman form tambah produk.
     */
    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('products.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Validasi input form lalu simpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ], [
            'name.required'        => 'Nama produk wajib diisi.',
            'price.required'       => 'Harga wajib diisi.',
            'price.numeric'        => 'Harga harus berupa angka.',
            'stock.required'       => 'Stok wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'image.image'          => 'File yang diunggah harus berupa gambar.',
            'image.max'            => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Simpan gambar (jika ada) ke storage/app/public/products
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan halaman form edit produk.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('products.edit', [
            'product'    => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Validasi input perubahan data produk lalu simpan ke database.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ], [
            'name.required'        => 'Nama produk wajib diisi.',
            'price.required'       => 'Harga wajib diisi.',
            'price.numeric'        => 'Harga harus berupa angka.',
            'stock.required'       => 'Stok wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'image.image'          => 'File yang diunggah harus berupa gambar.',
            'image.max'            => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Kalau ada gambar baru diunggah, ganti gambar lama:
        // hapus file lama dari storage lalu simpan file baru.
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk berdasarkan id.
     */
    public function destroy(Product $product)
    {
        // Hapus juga file gambar terkait supaya tidak jadi sampah di storage.
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
