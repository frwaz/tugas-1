<x-guest-layout>
    <h1 class="text-lg font-semibold text-gray-900 mb-4">Lupa Kata Sandi</h1>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa kata sandimu? Tidak masalah. Masukkan alamat email, dan kami akan mengirimkan link untuk membuat kata sandi baru.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Kirim Link Reset Kata Sandi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
