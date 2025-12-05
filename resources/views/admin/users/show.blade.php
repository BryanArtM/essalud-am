<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Profesional') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Encabezado con acciones -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detalles del Profesional</h1>
                        <p class="text-sm text-gray-600 mt-1">Información completa del profesional</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Editar
                        </a>
                        <a href="{{ route('users.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-lg transition-colors duration-200">
                            Volver
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de perfil del profesional -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <!-- Banner superior con información principal -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-8">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg flex-shrink-0">
                            <span class="text-3xl font-bold text-blue-600">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-white mb-1">{{ $user->name }}</h2>
                            <p class="text-blue-100 mb-2">{{ $user->email }}</p>
                            @if ($user->is_admin)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white text-blue-600">
                                    Administrador
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-400 text-white">
                                    Profesional
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Información detallada -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre completo -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre completo</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg text-gray-900">
                                {{ $user->name }}
                            </div>
                        </div>

                        <!-- Correo electrónico -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg text-gray-900">
                                {{ $user->email }}
                            </div>
                        </div>

                        <!-- Rol -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Rol</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg">
                                @if ($user->is_admin)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                        Administrador
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-800">
                                        Profesional
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Estado -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Activo
                                </span>
                            </div>
                        </div>

                        <!-- Fecha de creación -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de creación</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg text-gray-900">
                                {{ $user->created_at->locale('es')->isoFormat('D [de] MMMM [de] YYYY, HH:mm') }}
                            </div>
                        </div>

                        <!-- Última actualización -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Última actualización</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg text-gray-900">
                                {{ $user->updated_at->locale('es')->isoFormat('D [de] MMMM [de] YYYY, HH:mm') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
