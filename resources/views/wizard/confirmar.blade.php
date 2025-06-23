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
          <div class="col-span-2">
              <h3 class="font-semibold text-lg mb-2">{{ $titulo }}</h3>
              <ul class="list-disc ml-6">
                  @foreach ($$clave as $key => $value)
                      <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ is_bool($value) ? ($value ? 'Sí' : 'No') : $value }}</li>
                  @endforeach
              </ul>
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
