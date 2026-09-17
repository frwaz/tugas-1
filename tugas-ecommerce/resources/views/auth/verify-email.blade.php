<x-guest-layout>
    <h1 class="text-lg font-semibold text-gray-900 mb-4">Verifikasi Email</h1>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Terima kasih sudah mendaftar! Sebelum memulai, mohon verifikasi alamat emailmu dengan mengklik link yang baru saja kami kirimkan. Belum menerima email tersebut? Kami akan dengan senang hati mengirimkan yang baru.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ __('Link verifikasi baru telah dikirim ke alamat email yang kamu daftarkan.') }}
        </div>
    @endif

    <div class="flex items-center justify-between mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 underline hover:text-indigo-600">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>
