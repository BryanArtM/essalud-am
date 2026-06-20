<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo class="w-40 h-40 mx-auto ring-2 ring-blue-500 shadow-lg" />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            {{-- Token de restablecimiento --}}
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full text-gray-600 bg-gray-200" type="email"
                    name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input-password id="password" class="block mt-1 w-full" name="password" required
                    autocomplete="new-password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$"
                    title="Mínimo 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input-password id="password_confirmation" class="block mt-1 w-full" name="password_confirmation"
                    required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-around mt-4">

                <a href="{{ route('login') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                    {{ __('Login') }}
                </a>

                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
