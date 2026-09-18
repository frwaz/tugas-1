@extends('layouts.app')

@section('title', 'Dashboard - TokoKita')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <p class="text-sm text-gray-500 mb-1">Jumlah Produk</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalProducts }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <p class="text-sm text-gray-500 mb-1">Jumlah Klik Produk</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalClicks }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <p class="text-sm text-gray-500 mb-1">Jumlah Kategori</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalCategories }}</p>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="font-semibold text-lg mb-4">Produk Terbaru</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @forelse ($latestProducts as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="bg-white shadow rounded-lg overflow-hidden block hover:shadow-md transition">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}" class="w-full h-32 object-cover">
                    @else
                        <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-xs text-gray-400">
                            Tidak ada gambar
                        </div>
                    @endif
                    <div class="p-3">
                        <p class="font-medium text-sm truncate">{{ $product->name }}</p>
                        <p class="text-indigo-600 text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-gray-500 text-center py-6">Belum ada produk.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-4 py-3 border-b">
            <h2 class="font-semibold">Produk Paling Banyak Diklik</h2>
        </div>
        <table class="w-full text-left">
            <thead class="bg-gray-100 text-sm uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Klik</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($mostViewedProducts as $product)
                    <tr>
                        <td class="px-4 py-3 font-medium">
                            <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:underline">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td class="px-4 py-3">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $product->klik }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
