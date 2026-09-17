@extends('layouts.app')

@section('title', 'Daftar Kategori - TokoKita')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Daftar Kategori Produk</h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100 text-sm uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Nama Kategori</th>
                    <th class="px-4 py-3">Jumlah Produk</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-4 py-3">{{ $category->id }}</td>
                        <td class="px-4 py-3">{{ $category->name }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('products.index', ['category' => $category->id]) }}"
                               class="text-indigo-600 hover:underline">
                                {{ $category->products_count }} produk
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                            Belum ada kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
