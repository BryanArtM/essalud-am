<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $tab = request('tab', 'usuarios');
            @endphp

            <!-- Encabezado -->
            <div class="flex items-center justify-between py-6 pb-12 mx-9">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Panel de Administración</h1>
                    <p class="text-gray-600 mt-1">Gestiona profesionales y configuraciones del sistema</p>
                </div>
                <div class="hidden lg:flex items-center space-x-3">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrador</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>

            <!-- Navegación por pestañas -->

            <div class="border-b border-gray-200 mx-10">
                <nav class="flex -mb-px overflow-x-auto">
                    <a href="?tab=usuarios"
                        class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors duration-200
                                {{ $tab === 'usuarios' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <span>Gestión de Profesionales</span>
                        </div>
                    </a>

                    <a href="?tab=reportes"
                        class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors duration-200
                                {{ $tab === 'reportes' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            <span>Reportes</span>
                        </div>
                    </a>

                    <a href="?tab=configuracion"
                        class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors duration-200
                                {{ $tab === 'configuracion' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Configuración</span>
                        </div>
                    </a>
                </nav>
            </div>

            <!-- Contenido de las pestañas -->
            @if ($tab === 'usuarios')
                @include('admin.partials.usuarios')
            @elseif ($tab === 'reportes')
                @include('admin.partials.reportes')
            @elseif ($tab === 'configuracion')
                @include('admin.partials.configuracion')
            @endif
        </div>
    </div>
</x-app-layout>
