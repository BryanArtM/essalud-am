<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resumen de Registro') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-center text-2xl font-bold text-essalud-blue mb-8">Resumen de Registro</h1>

        @php
            $secciones = [
                'paso1' => 'Datos Personales',
                'paso2' => 'Enfermedades que Padece',
                'paso3' => 'Riesgos Identificados',
                'evaluacion' => 'Evaluación Médica',
                'actividad' => 'Asistencia a Actividades',
                'paso6' => 'Adulto Mayor de 75 Años a Más'
            ];
        @endphp

        @php
            if (isset($paso5['tratamientos'])) {
                $tratamientos = $paso5['tratamientos'];
                unset($paso5['tratamientos']);
            }

            if (isset($paso5['citas'])) {
                $citas = $paso5['citas'];
                unset($paso5['citas']);
            }
        @endphp

        {{-- Secciones dinámicas --}}
        @foreach ($secciones as $clave => $titulo)
            @php
                $ruta = $clave === 'actividad' || $clave === 'evaluacion' ? 'paso4' : $clave;
                $datos = $$clave ?? [];
            @endphp

            <div class="mb-8 border border-gray-200 rounded p-4 bg-gray-50">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-essalud-blue">{{ $titulo }}</h3>
                    <a href="{{ route('wizard.' . $ruta) }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                </div>

                @if (is_array($datos))
                    @if (isset($datos[0]) && is_array($datos[0]))
                        {{-- Múltiples registros (evaluaciones, actividades) --}}
                        @foreach ($datos as $index => $item)
                            <div class="mb-4 p-3 border rounded bg-white">
                                <h4 class="text-sm font-semibold mb-2 text-gray-700">Registro {{ $index + 1 }}</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                                    @foreach ($item as $key => $value)
                                        <div>
                                            <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                                            {{ is_bool($value) ? ($value ? 'Sí' : 'No') : ($value ?? '—') }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            @foreach ($datos as $key => $value)
                                <div>
                                    <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                                    {{ is_bool($value) ? ($value ? 'Sí' : 'No') : ($value ?? '—') }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <p class="text-gray-500">Sin datos registrados.</p>
                @endif
            </div>
        @endforeach

        {{-- Tratamientos --}}
        @if (!empty($tratamientos))
            <div class="mb-8 border border-gray-200 rounded p-4 bg-gray-50">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-essalud-blue">Tratamientos</h3>
                    <a href="{{ route('wizard.paso5') }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                </div>

                @foreach ($tratamientos as $i => $tratamiento)
                    <div class="mb-4 p-3 border rounded bg-white">
                        <h4 class="text-sm font-semibold mb-2 text-gray-700">Tratamiento {{ $i + 1 }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            @foreach ($tratamiento as $campo => $valor)
                                <div>
                                    <strong>{{ ucwords(str_replace('_', ' ', $campo)) }}:</strong>
                                    {{ $valor }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Citas --}}
        @if (!empty($citas))
            <div class="mb-8 border border-gray-200 rounded p-4 bg-gray-50">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-essalud-blue">Citas</h3>
                    <a href="{{ route('wizard.paso5') }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                </div>

                @foreach ($citas as $i => $cita)
                    <div class="mb-4 p-3 border rounded bg-white">
                        <h4 class="text-sm font-semibold mb-2 text-gray-700">Cita {{ $i + 1 }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            @foreach ($cita as $campo => $valor)
                                <div>
                                    <strong>{{ ucwords(str_replace('_', ' ', $campo)) }}:</strong>
                                    {{ $valor }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Botones --}}
        <form action="{{ route('wizard.finalizar') }}" method="POST" class="mt-10 flex justify-between">
            @csrf
            <a href="{{ route('wizard.paso6') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Atrás</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-800">Finalizar
                Registro</button>
        </form>
    </div>
</x-app-layout>