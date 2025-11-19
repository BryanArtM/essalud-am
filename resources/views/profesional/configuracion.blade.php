<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuración') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            {{-- Título y descripción --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Configuración de Cuenta</h1>
                <p class="text-sm text-gray-600 mt-1">Administra tu información personal y configuraciones de seguridad
                </p>
            </div>

            {{-- Autenticación de Dos Factores --}}
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            {{-- Sesiones de Navegador --}}
            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

        </div>
    </div>
</x-app-layout>
