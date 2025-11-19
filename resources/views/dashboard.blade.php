<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-4 lg:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{--Estadísticas móviles (solo visible en móvil)--}}
            <div class="lg:hidden mb-6">
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-100">
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">{{ \App\Models\AdultoMayor::count() }}</div>
                            <div class="text-xs text-gray-600">Adultos mayores</div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-100">
                        <div class="text-center">
                            <div class="text-lg font-bold text-green-600">
                                {{ \App\Models\AdultoMayor::whereMonth('created_at', now()->month)->count() }}
                            </div>
                            <div class="text-xs text-gray-600">Este mes</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-4 lg:gap-6">
                {{-- Sidebar --}}


                {{-- Contenido principal --}}
                <main class="flex-1 min-w-0">
                    {{-- Banner de bienvenida --}}
                    <div
                        class="bg-white border border-gray-200 rounded-md lg:rounded-lg shadow-lg p-6 lg:p-8 mb-6 lg:mb-8">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                            <div class="mb-6 lg:mb-0">
                                <!-- Encabezado principal -->
                                <div class="flex items-center mb-3">
                                    <div
                                        class="w-12 h-12 bg-slate-100 rounded-sm flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-slate-800 mb-1">
                                            Bienvenido, {{ Auth::user()->name }}
                                        </h1>
                                        <p class="text-slate-600 text-base lg:text-lg font-medium">
                                            Sistema de Gestión para Adultos Mayores
                                        </p>
                                    </div>
                                </div>

                                <!-- Fecha -->
                                <div class="flex items-center text-slate-500 text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="first-letter:capitalize">
                                        {{ now()->locale('es')->translatedFormat('l, d \d\e F \d\e Y') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Estadística -->
                            <div class="lg:block">
                                <div
                                    class="bg-slate-50 border border-slate-200 rounded-lg p-6 text-center min-w-[200px]">
                                    <div class="text-3xl font-bold text-slate-800 mb-1">
                                        {{ \App\Models\AdultoMayor::count() }}
                                    </div>
                                    <div class="text-sm font-medium text-slate-600 mb-2">
                                        Adultos Mayores Registrados
                                    </div>
                                    <div class="bg-slate-400 h-1 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Acciones rápidas --}}
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
                        {{-- Buscar Adultos mayores --}}
                        <a href="{{ route('adultos.index') }}"
                            class="group bg-white rounded-lg lg:rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 p-4 lg:p-6 border border-gray-100 hover:border-blue-200">
                            <div class="flex items-center justify-between mb-3 lg:mb-4">
                                <div
                                    class="bg-sky-100 group-hover:bg-sky-200 transition-colors p-2 lg:p-3 rounded-lg">
                                    <svg class="w-5 h-5 lg:w-6 lg:h-6 text-sky-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs lg:text-sm text-gray-500">Total</div>
                                    <div class="text-lg lg:text-xl font-bold text-gray-800">
                                        {{ \App\Models\AdultoMayor::count() }}
                                    </div>
                                </div>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-1 text-sm lg:text-base">Buscar Adulto mayor</h3>
                            <p class="text-xs lg:text-sm text-gray-600">Consulta información de adultos mayores</p>
                        </a>

                        {{-- Nuevo Registro --}}
                        <a href="{{ route('adultos.create') }}"
                            class="group bg-white rounded-lg lg:rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 p-4 lg:p-6 border border-gray-100 hover:border-green-200">
                            <div class="flex items-center justify-between mb-3 lg:mb-4">
                                <div
                                    class="bg-emerald-100 group-hover:bg-emerald-200 transition-colors p-2 lg:p-3 rounded-lg">
                                    <svg class="w-5 h-5 lg:w-6 lg:h-6 text-emerald-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs lg:text-sm text-gray-500">Este mes</div>
                                    <div class="text-lg lg:text-xl font-bold text-gray-800">
                                        {{ \App\Models\AdultoMayor::whereMonth('created_at', now()->month)->count() }}
                                    </div>
                                </div>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-1 text-sm lg:text-base">Nuevo Registro</h3>
                            <p class="text-xs lg:text-sm text-gray-600">Registrar nuevo adulto mayor</p>
                        </a>

                        {{-- Gestión de Profesionales (Admin) --}}
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('users.index') }}"
                                class="group bg-white rounded-lg lg:rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 p-4 lg:p-6 border border-gray-100 hover:border-purple-200">
                                <div class="flex items-center justify-between mb-3 lg:mb-4">
                                    <div
                                        class="bg-purple-100 group-hover:bg-purple-200 transition-colors p-2 lg:p-3 rounded-lg">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-purple-700" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>

                                    </div>
                                    <div class="text-right">
                                        <div class="text-xs lg:text-sm text-gray-500">Total</div>
                                        <div class="text-lg lg:text-xl font-bold text-gray-800">
                                            {{ \App\Models\User::count() }}
                                        </div>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-800 mb-1 text-sm lg:text-base">Gestión Profesionales</h3>
                                <p class="text-xs lg:text-sm text-gray-600">Administrar profesionales del sistema</p>
                            </a>
                        @endif
                    </div>

                    {{-- Actividad reciente --}}
                    <div class="bg-white rounded-lg lg:rounded-xl shadow-sm p-4 lg:p-6 border border-gray-100">
                        <h2 class="text-base lg:text-lg font-semibold text-gray-800 mb-3 lg:mb-4">Actividad Reciente
                        </h2>
                        <div class="space-y-2 lg:space-y-3">
                            @php
                                $recentAdultos = \App\Models\AdultoMayor::latest()->take(5)->get();
                            @endphp
                            @forelse($recentAdultos as $adulto)
                                <div
                                    class="flex items-center justify-between py-2 lg:py-3 border-b border-gray-100 last:border-0">
                                    <div class="flex items-center space-x-2 lg:space-x-3 min-w-0 flex-1">
                                        <div
                                            class="w-6 h-6 lg:w-8 lg:h-8 bg-sky-100 group-hover:bg-sky-800 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3 h-3 lg:w-4 lg:h-4 text-sky-700" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-xs lg:text-sm font-medium text-gray-800 truncate capitalize">
                                                {{ $adulto->nombres }} {{ $adulto->apellidos }}
                                            </p>
                                            <p class="text-xs text-gray-500 truncate">
                                                <span class="hidden sm:inline">DNI: {{ $adulto->dni }} - </span>
                                                Registrado {{ $adulto->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('adultos.show', $adulto) }}"
                                        class="text-sky-600 hover:text-sky-800 text-xs lg:text-sm font-medium flex-shrink-0 ml-2">
                                        Ver
                                    </a>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-6 lg:py-4 text-sm">No hay actividad reciente</p>
                            @endforelse
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>