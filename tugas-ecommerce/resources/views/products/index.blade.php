@extends('layouts.app')

@section('title', 'Daftar Produk — TokoKita')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Produk</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $products->total() }} produk ditemukan</p>
        </div>
        <a href="{{ route('products.create') }}"
           class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
            + Tambah Produk
        </a>
    </div>

    {{-- Filter kategori --}}
    <form method="GET" action="{{ route('products.index') }}" class="mt-6 flex flex-wrap items-center gap-3">
        <label for="category" class="text-sm font-medium text-gray-700">Kategori:</label>
        <select id="category" name="category" onchange="this.form.submit()"
                class="rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected((string) request('category') === (string) $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        @if (request('category'))
            <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline">Reset filter</a>
        @endif
    </form>

    {{-- Grid produk --}}
    @if ($products->isEmpty())
        <div class="mt-16 text-center">
            <p class="text-gray-500">Belum ada produk{{ request('category') ? ' untuk kategori ini' : '' }}.</p>
            <a href="{{ route('products.create') }}" class="mt-4 inline-block text-indigo-600 font-medium hover:underline">
                Tambah produk pertama →
            </a>
        </div>
    @else
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="group rounded-xl border border-gray-200 bg-white overflow-hidden hover:shadow-md transition-shadow">
                    <a href="{{ route('products.show', $product) }}" class="block aspect-[4/3] bg-gray-100 overflow-hidden">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 12.75h.008v.008H18v-.008zM4.5 20.25h15a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5h-15a1.5 1.5 0 00-1.5 1.5v13.5a1.5 1.5 0 001.5 1.5z" />
                                </svg>
                            </div>
                        @endif
                    </a>

                    <div class="p-4">
                        @if ($product->category)
                            <span class="inline-block text-xs font-medium text-indigo-600 bg-indigo-50 rounded-full px-2 py-0.5">
                                {{ $product->category->name }}
                            </span>
                        @endif

                        <h3 class="mt-2 font-semibold text-gray-900">
                            <a href="{{ route('products.show', $product) }}" class="hover:text-indigo-600">
                                {{ $product->name }}
                            </a>
                        </h3>

                        <p class="mt-1 text-lg font-bold text-gray-900">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <p class="mt-1 text-xs {{ $product->stock > 0 ? 'text-gray-500' : 'text-red-500' }}">
                            {{ $product->stock > 0 ? "Stok: {$product->stock}" : 'Stok habis' }}
                        </p>

                        <div class="mt-4 flex items-center gap-2">
                            <a href="{{ route('products.show', $product) }}"
                               class="flex-1 text-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                                Lihat Detail
                            </a>
                            <a href="{{ route('products.edit', $product) }}"
                               class="rounded-md border border-gray-300 px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Hapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="rounded-md border border-red-200 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $products->links() }}
        </div>
    @endif

</div>
@endsection
