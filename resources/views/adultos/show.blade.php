@php
    $omitidos = ['id', 'adulto_mayor_id', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    // Opcional: mapa de etiquetas "bonitas"
    function prettyLabel($label)
    {
        $map = [
            'dni' => 'DNI',
            'ipress' => 'IPRESS',
            'numero_ficha' => 'Número de Ficha',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'adulto_mayor_fragil' => 'Adulto Mayor Frágil (N°)',
        ];
        return $map[$label] ?? ucwords(str_replace('_', ' ', $label));
    }

    function renderCard($label, $value)
    {
        // Convierte la etiqueta a un formato más legible
        $labelText = prettyLabel($label);

        // Normaliza booleanos 1/0, '1'/'0' y true/false
        $isBoolLike = is_bool($value) || $value === 1 || $value === 0 || $value === '1' || $value === '0';
        $valorMostrado = $isBoolLike ? ((int) $value === 1 ? 'Sí' : 'No') : $value;
        // Si es nulo o cadena vacía, mostramos "No registrado"
        $contenido =
            $value !== null && $value !== ''
                ? e($valorMostrado)
                : '<span class="text-gray-400 italic">No registrado</span>';
        return '
            <div class="p-2 border rounded-lg bg-white shadow-sm">
                <div class="uppercase text-[11px] text-gray-500">' .
            e($labelText) .
            '</div>
                <p class="text-sm font-medium text-gray-800">' .
            $contenido .
            '</p>
            </div>
        ';
    }

    $paneles = [
        'Enfermedades' => $adulto->enfermedad ? [$adulto->enfermedad] : [],
        'Riesgos Identificados' => $adulto->riesgo ? [$adulto->riesgo] : [],
        'Evaluaciones Médicas' => $adulto->evaluaciones ?? [],
        'Actividades Educativas' => $adulto->actividadeseducativas ?? [],
        'Citas' => $adulto->citas ?? [],
        'Tratamientos' => $adulto->tratamientos ?? [],
        'Adulto Mayor 75 Años a Más' => $adulto->valoracion ? [$adulto->valoracion] : [],
    ];

    $ipressInfo = $adulto->ipressEntidad ? $adulto->ipressEntidad->info_completa : ($adulto->ipress ?? null);
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ficha del Adulto Mayor') }}
        </h2>
    </x-slot>

    <div class="py-4 lg:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <a href="{{ route('adultos.index') }}"
                    class="inline-flex items-center px-2 py-1 sm:px-4 sm:py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 19l-7-7 7-7M19 19l-7-7 7-7"></path>
                    </svg>
                    <span class="hidden sm:inline">Volver a la lista</span>
                    <span class="sm:hidden px-1 py-1">Volver</span>
                </a> <!-- Botones de acción -->
                <div class="flex space-x-2">
                    <a href="{{ route('adultos.edit', $adulto->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:bg-amber-600 active:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('adultos.pdf', $adulto->id) }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-emerald-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-600 focus:bg-emerald-600 active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                        PDF
                    </a>
                </div>
            </div>

            {{-- Datos principales --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {!! renderCard('numero_ficha', $adulto->numero_ficha) !!}
                {!! renderCard('ipress', $ipressInfo) !!}
            </div>

            <x-section-border />
            <h3 class="text-lg font-semibold text-blue-700 mb-4">🧍 Datos Personales</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-lg border shadow-sm capitalize">
                {!! renderCard('dni', $adulto->dni) !!}
                {!! renderCard('Apellidos', $adulto->apellidos) !!}
                {!! renderCard('Nombres', $adulto->nombres) !!}
                {!! renderCard(
                    'fecha_nacimiento',
                    $adulto->fecha_nacimiento ? \Carbon\Carbon::parse($adulto->fecha_nacimiento)->format('d/m/Y') : null,
                ) !!}
                @php
                    $edad = $adulto->fecha_nacimiento ? \Carbon\Carbon::parse($adulto->fecha_nacimiento)->age : null;
                @endphp
                {!! renderCard('Edad', $edad) !!}
                {!! renderCard(
                    'Fecha de Ingreso',
                    $adulto->fecha_ingreso ? \Carbon\Carbon::parse($adulto->fecha_ingreso)->format('d/m/Y') : null,
                ) !!}
                {!! renderCard('Alergias', $adulto->alergias) !!}
                {!! renderCard('Teléfono', $adulto->telefono) !!}
                {!! renderCard('Dirección', $adulto->direccion) !!}
                {!! renderCard('Email', $adulto->email) !!}
                {!! renderCard('adulto_mayor_fragil', $adulto->adulto_mayor_fragil) !!}
            </div>

            <x-section-border />
            @foreach ($paneles as $titulo => $items)
                <div x-data="{ open: true }" class="mb-6 border rounded-lg shadow-sm bg-white">
                    <button @click="open = !open"
                        class="w-full text-left px-4 py-3 bg-blue-50 hover:bg-blue-100 font-semibold text-blue-900 flex justify-between items-center">
                        {{ $titulo }}
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" class="p-4 transition-all duration-300">
                        @forelse ($items as $item)
                            {{-- Solo mostrar "Registro n°" si hay más de uno --}}
                            @if ($loop->count > 1)
                                <h4 class="text-sm font-semibold text-blue-600 mb-2">
                                    Registro {{ $loop->iteration }}
                                </h4>
                            @endif

                            <div
                                class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 bg-gray-50 p-3 rounded-lg border capitalize">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>
