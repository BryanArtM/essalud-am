@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">ENFERMEDADES QUE PADEZCO</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('adulto_id'))
        <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded shadow">
            <strong>Modo edición:</strong> Estás modificando los datos de un adulto mayor registrado.
        </div>
    @endif

    <form method="POST" action="{{ route(name: 'wizard.paso2') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ([
                'obesidad', 'dislipidemia', 'hipertension_arterial',
                'diabetes_mellitus', 'erc', 'osteoartrosis',
                'asma', 'epoc', 'itg', 'sindrome_metabolico'
            ] as $enfermedad)
                <div class="flex items-center">
                    <input type="checkbox" id="{{ $enfermedad }}" name="{{ $enfermedad }}"
                        {{ old($enfermedad, $data[$enfermedad] ?? false) ? 'checked' : '' }}
                        class="mr-2">
                    <label for="{{ $enfermedad }}" class="text-gray-700 uppercase">{{ str_replace('_', ' ', $enfermedad) }}</label>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <label for="otros" class="block font-semibold text-gray-700 mb-2">Otros:</label>
            <textarea name="otros" rows="2"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('otros', $data['otros'] ?? '') }}</textarea>
        </div>

        <hr class="my-6">

        <h3 class="text-lg font-semibold mb-2">VISARE</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label>Número:</label>
                <input type="number" name="visare_numero" value="{{ old('visare_numero', $data['visare_numero'] ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label>Fecha:</label>
                <input type="date" name="visare_fecha" value="{{ old('visare_fecha', $data['visare_fecha'] ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <h3 class="text-lg font-semibold mt-6 mb-2">Estadio 1a - 3a</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label>Número:</label>
                <input type="number" name="estadio_1a_3a_numero" value="{{ old('estadio_1a_3a_numero', $data['estadio_1a_3a_numero'] ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label>Fecha:</label>
                <input type="date" name="estadio_1a_3a_fecha" value="{{ old('estadio_1a_3a_fecha', $data['estadio_1a_3a_fecha'] ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <h3 class="text-lg font-semibold mt-6 mb-2">Estadio 3b - 5</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label>Número:</label>
                <input type="number" name="estadio_3b_5_numero" value="{{ old('estadio_3b_5_numero', $data['estadio_3b_5_numero'] ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label>Fecha:</label>
                <input type="date" name="estadio_3b_5_fecha" value="{{ old('estadio_3b_5_fecha', $data['estadio_3b_5_fecha'] ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('wizard.paso1') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Atrás</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Siguiente</button>
        </div>
    </form>
</div>
@endsection
