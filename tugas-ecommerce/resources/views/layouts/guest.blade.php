<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TokoKita') }}</title>

    {{-- Tailwind & Alpine lewat CDN, konsisten dengan layouts/app.blade.php
         di starter ini — tidak perlu setup Vite/npm untuk halaman auth. --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-4 py-10">

        <a href="{{ route('home') }}" class="mb-6">
            <x-application-logo />
        </a>

        <div class="w-full sm:max-w-md bg-white shadow-md rounded-xl px-6 py-8">
            {{ $slot }}
        </div>

        <a href="{{ route('home') }}" class="mt-6 text-sm text-gray-500 hover:text-indigo-600">
            &larr; Kembali ke Beranda
        </a>
    </div>
</body>
</html>
