{{-- Pestaña de Configuración --}}
<div class="p-6 bg-gray-50 min-h-screen">
    {{-- Encabezado Principal --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Configuración del Sistema</h2>
        <p class="text-gray-600 mt-1">Administre la configuración general, rendimiento y seguridad de la aplicación</p>
    </div>

    {{-- Sección 1: Rendimiento y Optimización --}}
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="h-8 w-1 bg-indigo-600 rounded mr-3"></div>
            <h3 class="text-lg font-bold text-gray-800 uppercase tracking-wide">Rendimiento y Optimización</h3>
        </div>

        {{-- Gestión de Caché --}}
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-white border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-base font-semibold text-gray-900">Gestión de Caché</h4>
                        <p class="text-sm text-gray-500 mt-0.5">Limpie el caché para mejorar el rendimiento del sistema
                        </p>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                    {{-- Limpiar Caché de Aplicación --}}
                    <form action="{{ route('admin.cache.clear', 'application') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex flex-col items-center justify-center p-4 bg-white hover:bg-gray-50 border border-gray-300 hover:border-blue-400 rounded transition-all duration-150 group">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded flex items-center justify-center mb-2 group-hover:bg-blue-200 transition-colors duration-150">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium text-sm text-gray-900">Caché de Aplicación</span>
                            <span class="text-xs text-gray-500 mt-0.5">cache:clear</span>
                        </button>
                    </form>

                    {{-- Limpiar Configuración --}}
                    <form action="{{ route('admin.cache.clear', 'config') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex flex-col items-center justify-center p-4 bg-white hover:bg-gray-50 border border-gray-300 hover:border-green-400 rounded transition-all duration-150 group">
                            <div
                                class="w-10 h-10 bg-green-100 rounded flex items-center justify-center mb-2 group-hover:bg-green-200 transition-colors duration-150">
                                <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-sm text-gray-900">Configuración</span>
                            <span class="text-xs text-gray-500 mt-0.5">config:clear</span>
                        </button>
                    </form>

                    {{-- Limpiar Rutas --}}
                    <form action="{{ route('admin.cache.clear', 'route') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex flex-col items-center justify-center p-4 bg-white hover:bg-gray-50 border border-gray-300 hover:border-purple-400 rounded transition-all duration-150 group">
                            <div
                                class="w-10 h-10 bg-purple-100 rounded flex items-center justify-center mb-2 group-hover:bg-purple-200 transition-colors duration-150">
                                <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium text-sm text-gray-900">Rutas</span>
                            <span class="text-xs text-gray-500 mt-0.5">route:clear</span>
                        </button>
                    </form>

                    {{-- Limpiar Vistas --}}
                    <form action="{{ route('admin.cache.clear', 'view') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex flex-col items-center justify-center p-4 bg-white hover:bg-gray-50 border border-gray-300 hover:border-orange-400 rounded transition-all duration-150 group">
                            <div
                                class="w-10 h-10 bg-orange-100 rounded flex items-center justify-center mb-2 group-hover:bg-orange-200 transition-colors duration-150">
                                <svg class="w-5 h-5 text-orange-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium text-sm text-gray-900">Vistas</span>
                            <span class="text-xs text-gray-500 mt-0.5">view:clear</span>
                        </button>
                    </form>
                </div>

                {{-- Botón de Optimización Completa --}}
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <form action="{{ route('admin.cache.optimize') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition-colors duration-150 shadow-sm hover:shadow group">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <span class="font-semibold">Optimizar Aplicación</span>
                        </button>
                    </form>
                </div>

                {{-- Mensajes de feedback --}}
                @if (session('cache_success'))
                    <div class="mt-4 p-3 bg-green-50 border-l-4 border-green-500 rounded-r flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-green-800">{{ session('cache_success') }}</span>
                    </div>
                @endif

                @if (session('cache_error'))
                    <div class="mt-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-r flex items-start">
                        <svg class="w-5 h-5 text-red-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-red-800">{{ session('cache_error') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Sección 2: Información del Sistema --}}
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="h-8 w-1 bg-blue-600 rounded mr-3"></div>
            <h3 class="text-lg font-bold text-gray-800 uppercase tracking-wide">Información del Sistema</h3>
        </div>

        {{-- Estadísticas de Base de Datos --}}
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-white border-b border-gray-100">
                <h4 class="text-base font-semibold text-gray-900">Estadísticas de Base de Datos</h4>
                <p class="text-sm text-gray-500 mt-0.5">Resumen de registros almacenados en el sistema</p>
            </div>
            <div class="p-6 bg-white">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-lg p-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-blue-900">Usuarios</span>
                            <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-blue-900 mb-1">{{ \App\Models\User::count() }}</div>
                        <div class="text-xs text-blue-700">registros totales</div>
                    </div>

                    <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-lg p-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-green-900">Adultos Mayores</span>
                            <div class="w-9 h-9 bg-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-green-900 mb-1">{{ \App\Models\AdultoMayor::count() }}
                        </div>
                        <div class="text-xs text-green-700">registros totales</div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-lg p-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-purple-900">Evaluaciones</span>
                            <div class="w-9 h-9 bg-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-purple-900 mb-1">{{ \App\Models\Evaluacion::count() }}
                        </div>
                        <div class="text-xs text-purple-700">registros totales</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección 3: Acceso Rápido --}}
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="h-8 w-1 bg-green-600 rounded mr-3"></div>
            <h3 class="text-lg font-bold text-gray-800 uppercase tracking-wide">Acceso Rápido</h3>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-white border-b border-gray-100">
                <h4 class="text-base font-semibold text-gray-900">Navegación Rápida</h4>
                <p class="text-sm text-gray-500 mt-0.5">Accesos directos a las secciones principales del sistema</p>
            </div>
            <div class="p-6 bg-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <a href="{{ route('users.index') }}"
                        class="flex items-center justify-between p-4 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-300 rounded transition-all duration-150 group">
                        <div class="flex items-center">
                            <div
                                class="w-11 h-11 bg-blue-600 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-700 transition-colors duration-150">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 group-hover:text-blue-900">Gestionar Usuarios
                                </div>
                                <div class="text-xs text-gray-500">Administración de usuarios del sistema</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all duration-150"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>

                    <a href="{{ route('adultos.index') }}"
                        class="flex items-center justify-between p-4 bg-gray-50 hover:bg-green-50 border border-gray-200 hover:border-green-300 rounded transition-all duration-150 group">
                        <div class="flex items-center">
                            <div
                                class="w-11 h-11 bg-green-600 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-700 transition-colors duration-150">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 group-hover:text-green-900">Ver Adultos Mayores
                                </div>
                                <div class="text-xs text-gray-500">Listado completo de adultos mayores</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 group-hover:translate-x-1 transition-all duration-150"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección 4: Seguridad --}}
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="h-8 w-1 bg-red-600 rounded mr-3"></div>
            <h3 class="text-lg font-bold text-gray-800 uppercase tracking-wide">Seguridad</h3>
        </div>

        {{-- Autenticación de Dos Factores --}}
        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden mb-4">
                <div class="px-6 py-4 bg-white border-b border-gray-100">
                    <h4 class="text-base font-semibold text-gray-900">Autenticación de Dos Factores</h4>
                    <p class="text-sm text-gray-500 mt-0.5">Agregue seguridad adicional a su cuenta mediante 2FA</p>
                </div>
                <div class="p-6 bg-white">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            </div>
        @endif

        {{-- Sesiones del Navegador --}}
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden mb-4">
            <div class="px-6 py-4 bg-white border-b border-gray-100">
                <h4 class="text-base font-semibold text-gray-900">Sesiones del Navegador</h4>
                <p class="text-sm text-gray-500 mt-0.5">Administre y cierre sesiones activas en otros dispositivos</p>
            </div>
            <div class="p-6 bg-white">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
        </div>

        {{-- Eliminar Cuenta --}}
        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="bg-white shadow-sm rounded-lg border border-red-200 overflow-hidden">
                <div class="p-6 bg-white">
                    @livewire('profile.delete-user-form')
                </div>
            </div>
        @endif
    </div>
</div>
