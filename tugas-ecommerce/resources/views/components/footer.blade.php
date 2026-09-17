{{--
    Komponen Footer
    Dipakai di layout utama lewat <x-footer />
--}}
<footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            {{-- Brand & deskripsi --}}
            <div class="col-span-1 sm:col-span-2 md:col-span-1">
                <div class="flex items-center gap-2 font-bold text-lg text-white">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white text-sm">TK</span>
                    TokoKita
                </div>
                <p class="mt-3 text-sm text-gray-400">
                    Belanja kebutuhanmu dengan mudah dan cepat, langsung dari satu tempat.
                </p>
            </div>

            {{-- Tautan belanja --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wide">Belanja</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('products.index') }}" class="hover:text-white">Semua Produk</a></li>
                    <li><a href="{{ route('cart.index') }}" class="hover:text-white">Keranjang</a></li>
                    <li><a href="{{ route('checkout.index') }}" class="hover:text-white">Checkout</a></li>
                </ul>
            </div>

            {{-- Tautan halaman informasi --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wide">Informasi</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('pages.index') }}" class="hover:text-white">Semua Halaman</a></li>
                    <li><a href="{{ route('products.create') }}" class="hover:text-white">Tambah Produk</a></li>
                    <li><a href="{{ route('pages.create') }}" class="hover:text-white">Tambah Halaman</a></li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wide">Hubungi Kami</h3>
                <ul class="mt-4 space-y-2 text-sm text-gray-400">
                    <li>halo@tokokita.test</li>
                    <li>+62 812-0000-0000</li>
                    <li>Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>

        <div class="mt-10 border-t border-gray-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} TokoKita. Seluruh hak cipta dilindungi.
            </p>
            <p class="text-sm text-gray-500">
                Dibuat dengan Laravel.
            </p>
        </div>
    </div>
</footer>
