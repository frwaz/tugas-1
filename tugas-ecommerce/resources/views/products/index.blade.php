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

    {{-- Tabel produk --}}
    <div class="mt-6 overflow-x-auto rounded-xl border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">ID</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Gambar</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Deskripsi</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Stok</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Harga</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $product->id }}</td>
                        <td class="px-4 py-3">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                     class="h-12 w-12 rounded-md object-cover">
                            @else
                                <div class="h-12 w-12 rounded-md bg-gray-100 flex items-center justify-center text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 12.75h.008v.008H18v-.008zM4.5 20.25h15a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5h-15a1.5 1.5 0 00-1.5 1.5v13.5a1.5 1.5 0 001.5 1.5z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">
                            <a href="{{ route('products.show', $product) }}" class="hover:text-indigo-600 hover:underline">
                                {{ $product->name }}
                            </a>
                            @if ($product->category)
                                <span class="block text-xs font-normal text-indigo-600">{{ $product->category->name }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-500 max-w-xs truncate" title="{{ $product->description }}">
                            {{ $product->description ?? '—' }}
                        </td>
                        <td class="px-4 py-3 {{ $product->stock > 0 ? 'text-gray-500' : 'text-red-500' }}">
                            {{ $product->stock }}
                        </td>
                        <td class="px-4 py-3 text-gray-900 font-semibold whitespace-nowrap">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('products.edit', $product) }}"
                                   class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50">
                                    Edit
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Hapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="rounded-md border border-red-200 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            Belum ada produk{{ request('category') ? ' untuk kategori ini' : '' }}.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection
