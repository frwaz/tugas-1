<x-guest-layout>
    <h1 class="text-lg font-semibold text-gray-900 mb-4">Konfirmasi Kata Sandi</h1>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Ini adalah area aman pada aplikasi. Mohon konfirmasi kata sandimu sebelum melanjutkan.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
