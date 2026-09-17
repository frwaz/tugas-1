<nav class="bg-indigo-600 text-white shadow">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="font-bold text-lg">TokoKita</a>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            <a href="{{ route('categories.index') }}" class="hover:underline">Kategori</a>
            <a href="{{ route('products.index') }}" class="hover:underline">Produk</a>
        </div>
    </div>
</nav>
