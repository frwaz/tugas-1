@extends('layouts.app')

@section('title', $product->name . ' — TokoKita')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline">&larr; Kembali ke daftar produk</a>

    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-xl border border-gray-200 p-6">
        <div>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                     class="w-full h-72 object-cover rounded-lg">
            @else
                <div class="w-full h-72 rounded-lg bg-gray-100 flex items-center justify-center text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 12.75h.008v.008H18v-.008zM4.5 20.25h15a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5h-15a1.5 1.5 0 00-1.5 1.5v13.5a1.5 1.5 0 001.5 1.5z" />
                    </svg>
                </div>
            @endif
        </div>

        <div>
            @if ($product->category)
                <span class="inline-block text-xs font-medium text-indigo-600 bg-indigo-50 rounded-full px-3 py-1">
                    {{ $product->category->name }}
                </span>
            @endif

            <h1 class="mt-3 text-2xl font-bold text-gray-900">{{ $product->name }}</h1>

            <p class="mt-2 text-xl font-semibold text-gray-900">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p class="mt-4 text-sm text-gray-600 leading-relaxed">
                {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
            </p>

            <dl class="mt-6 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-gray-500">Stok</dt>
                    <dd class="font-medium {{ $product->stock > 0 ? 'text-gray-900' : 'text-red-500' }}">
                        {{ $product->stock }}
                    </dd>
                </div>
                <div>
                    <dt class="text-gray-500">Dilihat</dt>
                    <dd class="font-medium text-gray-900">{{ number_format($product->clicks) }} kali</dd>
                </div>
            </dl>

            <div class="mt-6 flex items-center gap-2">
                <a href="{{ route('products.edit', $product) }}"
                   class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">
                    Edit
                </a>
                <form action="{{ route('products.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Hapus produk ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="rounded-md border border-red-200 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
