@php
    $omitidos = ['id', 'adulto_mayor_id', 'created_at', 'updated_at'];

    function renderCard($label, $value) {
        $valorMostrado = $value;
        if ($value === 1 || $value === 0) {
            $valorMostrado = $value === 1 ? 'Sí' : 'No';
        }

        return '
            <div class="p-2 border rounded-lg bg-white shadow-sm">
                <x-label value="'.ucwords(str_replace('_', ' ', $label)).'" class="uppercase text-xs text-gray-500" />
                <p class="text-sm font-medium text-gray-800">' .
                    ($value !== null && $value !== '' 
                        ? e($valorMostrado) 
                        : '<span class="text-gray-400 italic">No registrado</span>'
                    ) .
                '</p>
            </div>
        ';
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ficha del Adulto Mayor') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

        {{-- Botón volver --}}
        <div class="mb-4">
            <a href="{{ route('adultos.index') }}" class="text-blue-600 hover:underline text-sm">
                ← Volver a la lista
            </a>
        </div>

        {{-- Datos principales --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            {!! renderCard('Número de ficha', $adulto->numero_ficha) !!}
            {!! renderCard('IPRESS', $adulto->ipress) !!}
        </div>

        {{-- Datos Personales --}}
        <x-section-border />
        <h3 class="text-lg font-semibold text-blue-700 mb-4">🧍 Datos Personales</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-lg border shadow-sm capitalize">
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

        {{-- Paneles dinámicos --}}
        <x-section-border />
        @foreach ($paneles as $titulo => $items)
            <div x-data="{ open: true }" class="mb-6 border rounded-lg shadow-sm bg-white">
                <button @click="open = !open"
                        class="w-full text-left px-4 py-3 bg-blue-50 hover:bg-blue-100 font-semibold text-blue-900 flex justify-between items-center">
                    {{ $titulo }}
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" class="p-4 transition-all duration-300">
                    @forelse ($items as $item)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 bg-gray-50 p-3 rounded-lg border capitalize">
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
</x-app-layout>
