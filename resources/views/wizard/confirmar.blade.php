@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-6">Resumen de Registro</h2>



    <div class="grid grid-cols-2 gap-6 text-sm">
        @php
            $secciones = [
                'paso1' => 'DATOS PERSONALES',
                'paso2' => 'ENFERMEDADES QUE PADEZCO',
                'paso3' => 'RIESGOS IDENTIFICADOS',
                'evaluacion' => 'EVALUACIÓN MÉDICA',
                'actividad' => 'ASISTENCIA A ACTIVIDADES',
                'paso5' => 'CITAS - TRATAMIENTO FARMACOLÓGICO',
                'paso6' => 'ADULTO MAYOR 75 AÑOS A MÁS'
            ];
        @endphp

        @foreach ($secciones as $clave => $titulo)
            @php
                $ruta = $clave === 'actividad' || $clave === 'evaluacion' ? 'paso4' : $clave;
                $datos = $$clave ?? [];
            @endphp

            <div class="col-span-2 mb-6 border-b pb-4">
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-lg">{{ $titulo }}</h3>
                    <a href="{{ route('wizard.' . $ruta) }}"
                    class="text-blue-600 hover:underline text-sm">Editar</a>
                </div>

                @if (is_array($datos))
                    <ul class="list-disc ml-6 mt-2">
                        @foreach ($datos as $key => $value)
                            <li>
                                <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                                @if (is_bool($value))
                                    {{ $value ? 'Sí' : 'No' }}
                                @elseif (is_null($value) || $value === '')
                                    <span class="text-gray-400 italic">No registrado</span>
                                @else
                                    {{ $value }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="ml-6 text-gray-500">Sin datos registrados.</p>
                @endif
            </div>
        @endforeach




    </div>

    <form action="{{ route('wizard.finalizar') }}" method="POST" class="mt-8 flex justify-between">
        @csrf
        <a href="{{ route('wizard.paso6') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Atrás</a>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Finalizar Registro</button>
    </form>
    
</div>
@endsection
