{{-- Pestaña de Reportes y Estadísticas --}}
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        {{-- Total Profesionales --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded">Total</span>
            </div>
            <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalAdultosMayores }}</div>
            <div class="text-sm text-gray-600">Adultos Mayores</div>
            <div class="mt-3 flex items-center text-xs">
                <span class="text-green-600 font-semibold">+{{ $adultosMayoresEsteMes }}</span>
                <span class="text-gray-500 ml-1">este mes</span>
            </div>
        </div>

        {{-- Actividad Hoy --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-2 py-1 rounded">Hoy</span>
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
        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    {{-- Gráfico de Registros por Mes --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z">
                        </path>
                    </svg>
                    Registro de Adultos Mayores (Último año)
                </h3>
                <p class="text-sm text-gray-600 mt-1">Tendencia de registros mensuales</p>
            </div>
        </div>

        <div class="relative" style="height: 300px;">
            <canvas id="registrosChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('registrosChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($mesesLabels) !!},
                datasets: [{
                    label: 'Adultos Mayores Registrados',
                    data: {!! json_encode($registrosPorMes) !!},
                    borderColor: 'rgb(98, 98, 111)',
                    backgroundColor: 'rgba(98, 98, 111, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: 'rgb(98, 98, 111)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgb(98, 98, 111)',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>

    {{-- Actividad Reciente --}}
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-sm">No hay actividad reciente registrada</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
