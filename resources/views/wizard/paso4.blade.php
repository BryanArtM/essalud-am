@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-6">EVALUACIÓN</h2>

    <form method="POST" action="{{ route(name: 'wizard.paso4') }}">
        @csrf

    <div class="mb-4">
        <label for="fecha" class="font-semibold">Fecha</label>
        <input type="date" name="fecha" id="fecha" required
            value="{{ old('fecha', $evaluacion['fecha'] ?? '') }}"
            class="w-full border rounded px-3 py-2 border-gray-300 focus:ring-2 focus:ring-blue-500">
    </div>

        <div class="grid grid-cols-2 gap-4">
            @foreach ([
                'peso' => 'Peso (kg)', 
                'presion_arterial' => 'Presión Arterial',
                'glucosa' => 'Glucosa', 
                'hb_glicosilada' => 'Hb Glicosilada',
                'imc' => 'IMC', 
                'perimetro_abdominal' => 'Perímetro Abdominal',
                'evaluacion_pie_dm' => 'Evaluación Pie DM',
            ] as $name => $label)
            <div class="mb-4">
                <label for="{{ $name }}" class="block font-semibold">{{ $label }}</label>
                <input type="text" name="{{ $name }}" value="{{ old($name, $evaluacion[$name] ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            @endforeach
        </div>

        <div class="mb-4">
            <label for="test_morisky_green" class="font-semibold">Test Morisky-Green</label>
            <select name="test_morisky_green" class="w-full border rounded px-3 py-2">
                <option value="">Seleccione</option>
                <option value="cumple" {{ old('test_morisky_green', $evaluacion['test_morisky_green'] ?? '') === 'cumple' ? 'selected' : '' }}>Cumple</option>
                <option value="no cumple" {{ old('test_morisky_green', $evaluacion['test_morisky_green'] ?? '') === 'no cumple' ? 'selected' : '' }}>No cumple</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="vacuna_influenza" value="1"
                    {{ old('vacuna_influenza', $evaluacion['vacuna_influenza'] ?? false) ? 'checked' : '' }}>
                <span class="ml-2">Vacuna Influenza</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="vacuna_neumococo" value="1"
                    {{ old('vacuna_neumococo', $evaluacion['vacuna_neumococo'] ?? false) ? 'checked' : '' }}>
                <span class="ml-2">Vacuna Neumococo</span>
            </label>
        </div><br>

    <h2 class="text-xl font-semibold mb-6 text-gray-700">PERFIL RENAL</h2>
        
          <div class="grid grid-cols-2 gap-4">
            @foreach ([
                'microalbuminuria' => 'Microalbuminuria', 
                'creatinina' => 'Creatinina',
                'tasa_albuminuria_creatinuria' => 'Tasa Albuminuria/Creatinina',
                'tasa_filtracion_glomerular' => 'Tasa Filtración Glomerular'
            ] as $name => $label)
            <div class="mb-4">
                <label for="{{ $name }}" class="block font-semibold">{{ $label }}</label>
                <input type="text" name="{{ $name }}" value="{{ old($name, $evaluacion[$name] ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            @endforeach
        </div>

        <div class="mb-4">
            <label for="control_renal_fecha" class="font-semibold">Control Renal (Fecha)</label>
            <input type="date" name="control_renal_fecha" value="{{ old('control_renal_fecha', $evaluacion['control_renal_fecha'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <hr class="my-6 border-gray-300">

        <h3 class="text-lg font-semibold mb-4">Actividades Educativas</h3>

        <div class="mb-4">
            <label for="actividad_fecha" class="block font-semibold mb-2">Fecha de Actividad</label>
            <input type="date" name="actividad_fecha" value="{{ old('actividad_fecha', $actividad['fecha'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="numero_sesion" class="block font-semibold mb-2">Número de Sesión</label>
            <input type="text" name="numero_sesion" value="{{ old('numero_sesion', $actividad['numero_sesion'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('wizard.paso3') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Atrás</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Siguiente</button>
        </div>
    </form>
</div>
@endsection
