<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reportes y Estadísticas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Contenido de Reportes y Estadísticas --}}
            @php
                // Calcular estadísticas dinámicas
                $totalUsuarios = \App\Models\User::count();
                $usuariosEsteMes = \App\Models\User::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();

                $totalAdultosMayores = \App\Models\AdultoMayor::count();
                $adultosMayoresEsteMes = \App\Models\AdultoMayor::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();

                // Fichas disponibles para generar (cada adulto mayor tiene una ficha)
                $fichasDisponibles = $totalAdultosMayores;
                $fichasNuevasEsteMes = $adultosMayoresEsteMes;

                $actividadHoy = \App\Models\AdultoMayor::whereDate('updated_at', today())->count();

                // Evaluaciones realizadas
                $totalEvaluaciones = \App\Models\Evaluacion::count();
                $evaluacionesEsteMes = \App\Models\Evaluacion::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();

                // Datos para gráfico de registros por mes (últimos 6 meses)
                $registrosPorMes = [];
                $mesesLabels = [];
                for ($i = 12; $i >= 0; $i--) {
                    $fecha = now()->subMonths($i);
                    $count = \App\Models\AdultoMayor::whereYear('created_at', $fecha->year)
                        ->whereMonth('created_at', $fecha->month)
                        ->count();
                    $registrosPorMes[] = $count;
                    $mesesLabels[] = ucfirst($fecha->locale('es')->isoFormat('DD MMM YYYY'));
                }
            @endphp

            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Estadísticas del Sistema</h2>
                    <p class="text-sm text-gray-600 mt-1">Vista general de la actividad y métricas del sistema</p>
                </div>

                {{-- Estadísticas Principales --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    {{-- Total Profesionales --}}
                    <div
                        class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded">Total</span>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalUsuarios }}</div>
                        <div class="text-sm text-gray-600">Total Profesionales</div>
                        <div class="mt-3 flex items-center text-xs">
                            <span class="text-green-600 font-semibold">+{{ $usuariosEsteMes }}</span>
                            <span class="text-gray-500 ml-1">este mes</span>
                        </div>
                    </div>

                    {{-- Total Adultos Mayores --}}
                    <div
                        class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded">Total</span>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalAdultosMayores }}</div>
                        <div class="text-sm text-gray-600">Adultos Mayores</div>
                        <div class="mt-3 flex items-center text-xs">
                            <span class="text-green-600 font-semibold">+{{ $adultosMayoresEsteMes }}</span>
                            <span class="text-gray-500 ml-1">este mes</span>
                        </div>
                    </div>

                    {{-- Actividad Hoy --}}
                    <div
                        class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="text-xs font-semibold text-orange-600 bg-orange-50 px-2 py-1 rounded">Hoy</span>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">
                            {{ $actividadHoy }}
                        </div>
                        <div class="text-sm text-gray-600">Actividad Hoy</div>
                        <div class="mt-3 flex items-center text-xs">
                            <span class="text-gray-500">Actualizaciones del día</span>
                        </div>
                    </div>

                    {{-- Total Evaluaciones --}}
                    <div
                        class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-cyan-600 bg-cyan-50 px-2 py-1 rounded">Eval</span>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalEvaluaciones }}</div>
                        <div class="text-sm text-gray-600">Total Evaluaciones</div>
                        <div class="mt-3 flex items-center text-xs">
                            <span class="text-green-600 font-semibold">+{{ $evaluacionesEsteMes }}</span>
                            <span class="text-gray-500 ml-1">este mes</span>
                        </div>
                    </div>


                </div>


                {{-- Actividad Reciente --}}
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Actividad Reciente
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Últimas actualizaciones de adultos mayores</p>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @php
                            $actividadesRecientes = \App\Models\AdultoMayor::latest('updated_at')->take(5)->get();
                        @endphp

                        @forelse($actividadesRecientes as $adulto)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 flex-1 min-w-0">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate capitalize">
                                                {{ $adulto->nombres }} {{ $adulto->apellidos }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                <span class="font-medium">DNI: {{ $adulto->dni }}</span> •
                                                Hace {{ $adulto->updated_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('adultos.show', $adulto) }}"
                                        class="ml-4 px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded transition-colors duration-150">
                                        Ver detalles →
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                                <p class="text-gray-500 text-sm">No hay actividad reciente registrada</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Sección de Auditoría --}}
                <div id="tabla-auditoria" class="mt-8">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            Registro de Auditoría
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Historial de cambios y actividades en el sistema</p>
                    </div>

                    @php
                        // Obtener los últimos adultos mayores modificados con información del usuario
                        $ultimasModificaciones = \App\Models\AdultoMayor::with(['createdBy', 'updatedBy'])
                            ->orderBy('updated_at', 'desc')
                            ->paginate(10, ['*'], 'auditoria_page')
                            ->appends(['tab' => 'reportes'])
                            ->fragment('tabla-auditoria');

                    @endphp

                    {{-- Tabla de Auditoría --}}
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="flex px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <svg class="w-6 h-6 mr-2 text-gray-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Últimas Modificaciones</h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Adulto Mayor
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Creado Por
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha Creación
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Modificado Por
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Última Modificación
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($ultimasModificaciones as $adulto)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $adulto->apellidos }}, {{ $adulto->nombres }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if ($adulto->createdBy)
                                                        <span
                                                            class="text-sm text-gray-900">{{ $adulto->createdBy->name }}</span>
                                                    @else
                                                        <span class="text-sm text-gray-400 italic">Sistema</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $adulto->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if ($adulto->updatedBy)
                                                        <span
                                                            class="text-sm text-gray-900">{{ $adulto->updatedBy->name }}</span>
                                                    @else
                                                        <span class="text-sm text-gray-400 italic">Sistema</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if ($adulto->updated_at->diffInHours() < 24)
                                                    <span
                                                        class="text-green-600 font-medium">{{ $adulto->updated_at->diffForHumans() }}</span>
                                                @else
                                                    {{ $adulto->updated_at->format('d/m/Y H:i') }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <a href="{{ route('adultos.show', $adulto->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 font-medium">
                                                    Ver detalles
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                                No hay registros disponibles
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <x-paginacion :pagina="$ultimasModificaciones" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
