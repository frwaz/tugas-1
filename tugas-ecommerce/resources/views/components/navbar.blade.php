{{--
    Komponen Navbar
    Dipakai di layout utama lewat <x-navbar />
--}}
<header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <nav class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ open: false }">
        <div class="flex items-center justify-between h-16">
            {{-- Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl text-indigo-600">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white text-sm">TK</span>
                TokoKita
            </a>

            {{-- Menu desktop --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"
                   class="text-sm font-medium {{ request()->routeIs('home') ? 'text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                    Beranda
                </a>
                <a href="{{ route('products.index') }}"
                   class="text-sm font-medium {{ request()->routeIs('products.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                    Produk
                </a>
                <a href="{{ route('categories.index') }}"
                   class="text-sm font-medium {{ request()->routeIs('categories.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                    Kategori
                </a>
                <a href="{{ route('pages.index') }}"
                   class="text-sm font-medium {{ request()->routeIs('pages.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                    Halaman
                </a>
            </div>

            {{-- Aksi kanan --}}
            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('cart.index') }}"
                   class="relative inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.936-4.79 2.383-7.394a1.125 1.125 0 00-1.11-1.313H5.106M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    Keranjang
                </a>
                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                    + Tambah Produk
                </a>

                {{-- Akun --}}
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">Masuk</a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center rounded-md border border-indigo-600 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50">
                        Daftar
                    </a>
                @else
                    <div class="relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu"
                                class="flex items-center gap-1 text-sm font-medium text-gray-600 hover:text-indigo-600">
                            {{ Auth::user()->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="userMenu" @click.outside="userMenu = false" x-cloak
                             class="absolute right-0 mt-2 w-44 rounded-md bg-white shadow-lg ring-1 ring-black/5 py-1 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- Tombol menu mobile --}}
            <button @click="open = !open" class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-gray-600 hover:bg-gray-100">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Menu mobile --}}
        <div x-show="open" x-cloak class="md:hidden pb-4 space-y-1" style="display: none;">
            <a href="{{ route('home') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">Beranda</a>
            <a href="{{ route('products.index') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">Produk</a>
            <a href="{{ route('categories.index') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('categories.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">Kategori</a>
            <a href="{{ route('pages.index') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('pages.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">Halaman</a>
            <a href="{{ route('cart.index') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('cart.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">Keranjang</a>
            <a href="{{ route('products.create') }}" class="block rounded-md px-3 py-2 text-base font-medium text-indigo-600 hover:bg-indigo-50">+ Tambah Produk</a>

            @guest
                <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-50">Masuk</a>
                <a href="{{ route('register') }}" class="block rounded-md px-3 py-2 text-base font-medium text-indigo-600 hover:bg-indigo-50">Daftar</a>
            @else
                <a href="{{ route('dashboard') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-50">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-50">Profil ({{ Auth::user()->name }})</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left rounded-md px-3 py-2 text-base font-medium text-red-600 hover:bg-red-50">Keluar</button>
                </form>
            @endguest
        </div>
    </nav>
</header>
