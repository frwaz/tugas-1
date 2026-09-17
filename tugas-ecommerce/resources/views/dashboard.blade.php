<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Anda berhasil masuk sebagai') }} <strong>{{ Auth::user()->name }}</strong>.
                </div>
            </div>

            {{-- Ringkasan statistik toko --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                {{-- Jumlah produk --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center gap-4">
                    <div class="shrink-0 h-12 w-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125h4.5M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375C2.754 3.75 2.25 4.254 2.25 4.875v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Produk</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalProducts) }}</p>
                    </div>
                </div>

                {{-- Jumlah kategori produk --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center gap-4">
                    <div class="shrink-0 h-12 w-12 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Kategori Produk</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalCategories) }}</p>
                    </div>
                </div>

                {{-- Jumlah klik produk --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center gap-4">
                    <div class="shrink-0 h-12 w-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 6.257L6.166 4.666M4.5 10.5H2.25m4.007 4.243l-1.591 1.591" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Klik Produk</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalClicks) }}</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
