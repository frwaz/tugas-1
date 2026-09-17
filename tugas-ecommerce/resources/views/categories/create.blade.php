@extends('layouts.app')

@section('title', 'Tambah Kategori - TokoKita')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Kategori Produk</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('product-category.store') }}" method="POST"
          class="bg-white shadow rounded-lg p-6 max-w-lg">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Kategori
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-400"
                   placeholder="Contoh: Elektronik">
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Simpan
            </button>
            <a href="{{ route('categories.index') }}" class="text-gray-600 hover:underline">
                Batal
            </a>
        </div>
    </form>
@endsection
