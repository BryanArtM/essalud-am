@php
    $omitidos = ['id', 'adulto_mayor_id', 'created_at', 'updated_at'];

    function renderCard($label, $value) {
        $valorMostrado = $value;

        if ($value === 1 || $value === 0) {
            $valorMostrado = $value === 1 ? 'Sí' : 'No';
        }

        return "
            <div class='p-2'>
                <p class='text-sm text-gray-500 uppercase tracking-wide'>" . ucwords(str_replace('_', ' ', $label)) . "</p>
                <p class='text-sm font-medium text-gray-800'>" .
                    ($value !== null && $value !== '' ? e($valorMostrado) : "<span class='text-gray-400 italic'>No registrado</span>") .
                "</p>
            </div>";
    }


    $paneles = [
        '🦠 Enfermedades' => $adulto->enfermedad ? [$adulto->enfermedad] : [],
        '⚠️ Riesgos Identificados' => $adulto->riesgo ? [$adulto->riesgo] : [],
        '🩺 Evaluaciones Médicas' => $adulto->evaluaciones ?? [],
        '📚 Actividades Educativas' => $adulto->actividadeseducativas ?? [],
        '📆 Citas' => $adulto->citas ?? [],
        '💊 Tratamientos' => $adulto->tratamientos ?? [],
        '👵 Adulto Mayor 75 Años a Más' => $adulto->valoraciones ?? [], 
    ];
@endphp

@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <h1 class=" flex justify-center text-3xl font-bold mb-6 text-[#0073B6]">Ficha del Adulto Mayor</h1>

    <a href="{{ route('adultos.index') }}"
        class="mb-4 inline-block text-blue-600 hover:underline text-sm">← Volver a la lista</a>

    <div class="flex max-w-6xl mx-auto p-6 bg-white rounded shadow">
        <div class="w-1/2 flex justify-end pr-20 ">
            {!! renderCard('Número de ficha', $adulto->numero_ficha) !!}
        </div>
        <div class="w-1/2 flex justify-start pl-20">
            {!! renderCard('IPRESS', $adulto->ipress) !!}
        </div>
    </div>



    {{-- Datos Personales --}}
    <div class="mb-10">
        <h2 class="text-xl pt-6 font-semibold text-blue-700 mb-4">🧍 Datos Personales</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded border shadow-sm capitalize">
            {!! renderCard('DNI', $adulto->dni) !!}
            {!! renderCard('Apellidos', $adulto->apellidos) !!}
            {!! renderCard('Nombres', $adulto->nombres) !!}
            {!! renderCard('Fecha de nacimiento', $adulto->fecha_nacimiento) !!}
            @php
                $edad = $adulto->fecha_nacimiento
                    ? \Carbon\Carbon::parse($adulto->fecha_nacimiento)->age
                    : null;
            @endphp
            {!! renderCard('Edad', $edad) !!}
            {!! renderCard('Fecha de Ingreso', $adulto->fecha_ingreso) !!}
            {!! renderCard('Alergias', $adulto->alergias) !!}
            {!! renderCard('Teléfono', $adulto->telefono) !!}
            {!! renderCard('¿Adulto mayor frágil?', $adulto->adulto_mayor_fragil) !!}
        </div>
    </div>

    @foreach ($paneles as $titulo => $items)
        <div x-data="{ open: true }" class="mb-6 border rounded shadow-sm">
            <button @click="open = !open"
                    class="w-full text-left px-4 py-3 bg-blue-100 hover:bg-blue-200 font-semibold text-blue-900 flex justify-between items-center">
                {{ $titulo }}
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="open" class="p-4 bg-white transition-all duration-300">
                @forelse ($items as $item)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 bg-gray-50 p-3 rounded border capitalize">
                        @foreach ($item->toArray() as $campo => $valor)
                            @continue(in_array($campo, $omitidos))
                            {!! renderCard($campo, $valor) !!}
                        @endforeach
                    </div>
                @empty
                    <p class="text-gray-500 italic">No se registraron datos.</p>
                @endforelse
            </div>
        </div>
    @endforeach



</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection