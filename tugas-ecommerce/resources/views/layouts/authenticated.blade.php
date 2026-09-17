{{--
    Ini adalah layout "app.blade.php" bawaan Breeze, sengaja diberi nama lain
    (authenticated.blade.php) supaya TIDAK bentrok dengan resources/views/layouts/app.blade.php
    milik starter ini (dipakai untuk halaman publik seperti beranda & daftar produk).
    Dipakai lewat <x-app-layout> — lihat app/View/Components/AppLayout.php.
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TokoKita') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        @include('layouts.navigation')

        {{-- Judul halaman (opsional, dikirim lewat <x-slot name="header">) --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Notifikasi status (mis. dari redirect()->with('status', ...)) --}}
        @if (session('status'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        {{-- Konten halaman --}}
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
