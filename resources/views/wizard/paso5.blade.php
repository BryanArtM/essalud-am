@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-6">CITAS</h2>

    <form action="{{ route('wizard.paso5') }}" method="POST">
        @csrf

        {{-- Cita --}}
        <h3 class="text-lg font-semibold mb-4">Cita Médica</h3>

        <div class="mb-4">
            <label for="cita_fecha" class="block font-semibold mb-2">Fecha de Cita</label>
            <input type="date" name="cita_fecha" value="{{ old('cita_fecha', $data['cita_fecha'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="medico" class="block font-semibold mb-2">Médico</label>
            <input type="text" name="medico" value="{{ old('medico', $data['medico'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="enfermera" class="block font-semibold mb-2">Enfermera</label>
            <input type="text" name="enfermera" value="{{ old('enfermera', $data['enfermera'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        {{-- Tratamiento --}}
        <h3 class="text-lg font-semibold mb-4 mt-6">TRATAMIENTO FARMACOLÓGICO</h3>

        <div class="mb-4">
            <label for="medicacion" class="block font-semibold mb-2">Medicamento</label>
            <input type="text" name="medicacion" value="{{ old('medicacion', $data['medicacion'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="dosis" class="block font-semibold mb-2">Dosis</label>
            <input type="text" name="dosis" value="{{ old('dosis', $data['dosis'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('wizard.paso4') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Atrás</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Siguiente</button>
        </div>
    </form>
</div>
@endsection
