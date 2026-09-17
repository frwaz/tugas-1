<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoKita')</title>

    {{-- Tailwind CSS lewat CDN — cukup untuk tahap starter, tanpa perlu build tooling --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Alpine.js untuk interaksi kecil seperti menu mobile --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50 text-gray-900">

    <x-navbar />

    {{-- Notifikasi sukses/gagal dari controller (mis. redirect()->with('success', ...)) --}}
    @if (session('success'))
        <div class="max-w-6xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4">
            <div class="rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>

    <x-footer />

</body>
</html>
