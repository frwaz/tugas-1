@extends('layouts.app')

@section('title', 'Edit Produk - TokoKita')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data"
          class="bg-white shadow rounded-lg p-6 max-w-xl space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Produk
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-400">
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                Kategori
            </label>
            <select id="category_id" name="category_id"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-400">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id', $product->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                    Harga
                </label>
                <input type="number" step="0.01" min="0" id="price" name="price"
                       value="{{ old('price', $product->price) }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-400">
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                    Stok
                </label>
                <input type="number" min="0" id="stock" name="stock"
                       value="{{ old('stock', $product->stock) }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-400">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi
            </label>
            <textarea id="description" name="description" rows="4"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-400">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                Gambar Produk
            </label>

            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-20 h-20 object-cover rounded mb-2">
            @endif

            <input type="file" id="image" name="image" accept="image/*"
                   class="w-full border rounded px-3 py-2">
            <p class="text-xs text-gray-500 mt-1">
                Biarkan kosong jika tidak ingin mengganti gambar.
            </p>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Simpan Perubahan
            </button>
            <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">
                Batal
            </a>
        </div>
    </form>
@endsection
