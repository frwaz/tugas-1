@extends('layouts.app')

@section('title', 'Keranjang Belanja — TokoKita')

{{--
    Catatan: logika keranjang (simpan item, hitung total, dsb.) belum
    diimplementasikan — route ini untuk sekarang hanya menampilkan halaman.
    Nanti tinggal kirim variabel $cartItems dari controller/session dan
    ganti blok "keranjang kosong" di bawah dengan tabel isi keranjang.
--}}

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <h1 class="text-2xl font-bold text-gray-900">Keranjang Belanja</h1>

    @php $cartItems = $cartItems ?? []; @endphp

    @if (empty($cartItems))
        {{-- Keadaan kosong --}}
        <div class="mt-12 flex flex-col items-center text-center">
            <div class="h-20 w-20 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.936-4.79 2.383-7.394a1.125 1.125 0 00-1.11-1.313H5.106M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
            </div>
            <h2 class="mt-6 text-lg font-semibold text-gray-900">Keranjangmu masih kosong</h2>
            <p class="mt-2 text-sm text-gray-500">Yuk, jelajahi produk kami dan mulai belanja.</p>
            <a href="{{ route('products.index') }}"
               class="mt-6 inline-flex items-center rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-500">
                Jelajahi Produk
            </a>
        </div>
    @else
        {{-- Daftar item keranjang --}}
        <div class="mt-8 divide-y divide-gray-200 border-y border-gray-200">
            @foreach ($cartItems as $item)
                <div class="flex items-center gap-4 py-4">
                    <div class="h-16 w-16 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden">
                        @if (!empty($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-500">Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>
                    <div class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</div>
                    <div class="font-semibold text-gray-900">
                        Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('checkout.index') }}"
               class="inline-flex items-center rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-500">
                Lanjut ke Checkout
            </a>
        </div>
    @endif

</div>
@endsection
