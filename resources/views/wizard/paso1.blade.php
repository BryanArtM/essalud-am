@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4"> DATOS PERSONALES</h2>
    
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

    
    <form method="POST" action="{{ route('wizard.paso1.post') }}">
        @csrf

        <div class="mb-4">
            <label for="ipress" class="block text-gray-700 font-semibold mb-2">IPRESS</label>
            <input type="text" name="ipress" id="ipress" required
                value="{{ old('ipress', $data['ipress'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="numero_ficha" class="block text-gray-700 font-semibold mb-2">N° Ficha</label>
            <input type="text" name="numero_ficha" id="numero_ficha" required
                value="{{ old('numero_ficha', $data['numero_ficha'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="nombres" class="block text-gray-700 font-semibold mb-2">Nombres</label>
            <input type="text" name="nombres" required maxlength="100"
                value="{{ old('nombres', $data['nombres'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="apellidos" class="block text-gray-700 font-semibold mb-2">Apellidos</label>
            <input type="text" name="apellidos" required maxlength="100"
                value="{{ old('apellidos', $data['apellidos'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="telefono" class="block text-gray-700 font-semibold mb-2">Teléfono</label>
            <input type="text" name="telefono" required pattern="\d{9}" title="Debe tener 9 dígitos"
                value="{{ old('telefono', $data['telefono'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="dni" class="block text-gray-700 font-semibold mb-2">DNI</label>
            <input type="text" name="dni" required pattern="\d{8}" title="Debe tener 8 dígitos"
                value="{{ old('dni', $data['dni'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="fecha_ingreso" class="block text-gray-700 font-semibold mb-2">Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" required
                value="{{ old('fecha_ingreso', $data['fecha_ingreso'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="fecha_nacimiento" class="block text-gray-700 font-semibold mb-2">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" required
                max="{{ date('Y-m-d') }}"
                value="{{ old('fecha_nacimiento', $data['fecha_nacimiento'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="alergias" class="block text-gray-700 font-semibold mb-2">Alergias</label>
            <input type="text" name="alergias" maxlength="200"
                value="{{ old('alergias', $data['alergias'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label for="adulto_mayor_fragil" class="block text-gray-700 font-semibold mb-2">Adulto Mayor Frágil</label>
            <input type="text" name="adulto_mayor_fragil" required maxlength="100"
                value="{{ old('adulto_mayor_fragil', $data['adulto_mayor_fragil'] ?? '') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        </div>

        <div class="flex justify-between">
            <a href="{{ route('adultos.index') }}"
                class="bg-gray-500 text-white font-semibold px-6 py-2 rounded hover:bg-gray-600">
                Cancelar
            </a>

            <button type="submit"
                class="bg-green-600 text-white font-semibold px-6 py-2 rounded hover:bg-green-700">
                Siguiente
            </button>
        </div>
    </form>
</div>
@endsection

