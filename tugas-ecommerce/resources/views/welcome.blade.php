@extends('layouts.app')

@section('title', 'TokoKita — Belanja Online Terpercaya')

@section('content')

    {{-- Hero --}}
    <section class="bg-indigo-600">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div>
                <h1 class="text-4xl sm:text-5xl font-bold text-white leading-tight">
                    Belanja apa saja,<br> lebih mudah di <span class="text-indigo-200">TokoKita</span>
                </h1>
                <p class="mt-4 text-lg text-indigo-100">
                    Ribuan produk pilihan dengan harga bersahabat, siap dikirim ke depan pintumu.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center rounded-md bg-white px-6 py-3 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50">
                        Lihat Produk
                    </a>
                    <a href="{{ route('products.create') }}"
                       class="inline-flex items-center rounded-md border border-white px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-500">
                        Jual Produkmu
                    </a>
                </div>
            </div>
            <div class="hidden md:flex justify-center">
                <div class="h-64 w-64 rounded-full bg-indigo-500/40 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori singkat --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold text-gray-900">Kenapa belanja di TokoKita?</h2>
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div class="rounded-xl border border-gray-200 p-6">
                <div class="h-10 w-10 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 0h-12" />
                    </svg>
                </div>
                <h3 class="mt-4 font-semibold text-gray-900">Pengiriman Cepat</h3>
                <p class="mt-2 text-sm text-gray-500">Pesanan diproses dan dikirim dalam hitungan jam.</p>
            </div>
            <div class="rounded-xl border border-gray-200 p-6">
                <div class="h-10 w-10 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <h3 class="mt-4 font-semibold text-gray-900">Transaksi Aman</h3>
                <p class="mt-2 text-sm text-gray-500">Setiap pesanan tercatat dengan rapi dan aman.</p>
            </div>
            <div class="rounded-xl border border-gray-200 p-6">
                <div class="h-10 w-10 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                </div>
                <h3 class="mt-4 font-semibold text-gray-900">Harga Bersahabat</h3>
                <p class="mt-2 text-sm text-gray-500">Ratusan produk dengan harga terjangkau setiap hari.</p>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="rounded-2xl bg-gray-900 px-8 py-12 text-center">
            <h2 class="text-2xl font-bold text-white">Siap mulai belanja?</h2>
            <p class="mt-2 text-gray-400">Jelajahi katalog produk kami dan temukan yang kamu butuhkan.</p>
            <a href="{{ route('products.index') }}"
               class="mt-6 inline-flex items-center rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-500">
                Mulai Belanja
            </a>
        </div>
    </section>

@endsection
