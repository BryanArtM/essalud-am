@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-6">Paso 6: Valoración Funcional y Servicios</h2>

    <form action="{{ route('wizard.paso6') }}" method="POST">
        @csrf

        <h3 class="text-lg font-semibold mb-4">Evaluación Geriátrica</h3>

        <div class="mb-4">
            <label class="font-semibold">¿Autovalente?</label>
            <select name="autovalente" class="w-full border rounded px-3 py-2">
                <option value="1" {{ old('autovalente', $data['autovalente'] ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('autovalente', $data['autovalente'] ?? '') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="test_barber" class="block font-semibold mb-2">Test Barber</label>
            <input type="text" name="test_barber" value="{{ old('test_barber', $data['test_barber'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="test_barthel" class="block font-semibold mb-2">Test Barthel</label>
            <input type="text" name="test_barthel" value="{{ old('test_barthel', $data['test_barthel'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="font-semibold">¿Frágil?</label>
            <select name="fragil" class="w-full border rounded px-3 py-2">
                <option value="0" {{ old('fragil', $data['fragil'] ?? '') == '0' ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('fragil', $data['fragil'] ?? '') == '1' ? 'selected' : '' }}>Sí</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="test_lawton_brody" class="block font-semibold mb-2">Test Lawton-Brody</label>
            <input type="text" name="test_lawton_brody" value="{{ old('test_lawton_brody', $data['test_lawton_brody'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="test_katz" class="block font-semibold mb-2">Test Katz</label>
            <input type="text" name="test_katz" value="{{ old('test_katz', $data['test_katz'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <h3 class="text-lg font-semibold my-6">Fechas de Valoración por Servicio</h3>

        @foreach ([
            'enfermeria', 'medicina', 'nutricion',
            'psicologia', 'servicio_social', 'visita_domiciliaria'
        ] as $servicio)
        <div class="mb-4">
            <label for="fecha_{{ $servicio }}" class="block font-semibold mb-2">Fecha {{ ucfirst(str_replace('_', ' ', $servicio)) }}</label>
            <input type="date" name="fecha_{{ $servicio }}" value="{{ old('fecha_'.$servicio, $data['fecha_'.$servicio] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>
        @endforeach

        <div class="flex justify-between mt-6">
            <a href="{{ route('wizard.paso5') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Atrás</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Siguiente</button>
        </div>
    </form>
</div>
@endsection
