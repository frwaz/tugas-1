@extends('layouts.app')

@section('title', $product->name . ' - TokoKita')

@section('content')
    <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">&larr; Kembali ke daftar produk</a>

    <div class="bg-white shadow rounded-lg p-6 mt-4 flex flex-col md:flex-row gap-6">
        <div class="md:w-1/3">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-56 object-cover rounded">
            @else
                <div class="w-full h-56 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                    Tidak ada gambar
                </div>
            @endif
        </div>

        <div class="md:w-2/3">
            <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
            <p class="text-sm text-gray-500 mb-4">
                Kategori: {{ $product->category->name ?? '-' }}
            </p>
            <p class="text-xl font-semibold text-indigo-600 mb-4">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>
            <p class="text-gray-700 mb-4">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>
            <p class="text-sm text-gray-500 mb-4">Stok tersedia: {{ $product->stock }}</p>
            <p class="text-sm text-gray-500 mb-4">Dilihat: {{ $product->klik }} kali</p>

            <div class="flex items-center gap-3">
                <a href="{{ route('product.edit', $product) }}"
                   class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600">
                    Edit
                </a>
                <form action="{{ route('product.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
