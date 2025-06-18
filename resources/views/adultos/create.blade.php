
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-center">Registrar Adulto Mayor</h1>

    <form action="{{ route('adultos.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="ipress" class="block text-gray-700 font-semibold mb-2">IPRESS</label>
            <input type="text" name="ipress" id="ipress" required
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="numero_ficha" class="block text-gray-700 font-semibold mb-2">Número de Ficha</label>
            <input type="text" name="numero_ficha" id="numero_ficha" required
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="nombres" class="block text-gray-700 font-semibold mb-2">Nombres</label>
            <input type="text" name="nombres" required maxlength="100"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="apellidos" class="block text-gray-700 font-semibold mb-2">Apellidos</label>
            <input type="text" name="apellidos" required maxlength="100"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="telefono" class="block text-gray-700 font-semibold mb-2">Teléfono</label>
            <input type="text" name="telefono" required pattern="\d{9}" title="Debe tener 9 dígitos"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="dni" class="block text-gray-700 font-semibold mb-2">DNI</label>
            <input type="text" name="dni" required pattern="\d{8}" title="Debe tener 8 dígitos"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="fecha_ingreso" class="block text-gray-700 font-semibold mb-2">Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" required
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="fecha_nacimiento" class="block text-gray-700 font-semibold mb-2">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" required max="{{ date('Y-m-d') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="alergias" class="block text-gray-700 font-semibold mb-2">Alergias</label>
            <input type="text" name="alergias" required maxlength="200"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label for="adulto_mayor_fragil" class="block text-gray-700 font-semibold mb-2">Adulto Mayor Frágil</label>
            <input type="text" name="adulto_mayor_fragil" required maxlength="200"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-around ">
          
          <a href="{{ route('adultos.index') }}"
          class="bg-gray-500 text-white font-semibold px-6 py-2 rounded hover:bg-gray-600">
          Cancelar
        </a>

        <button type="submit"
            class="bg-green-600 text-white font-semibold px-6 py-2 rounded hover:bg-green-700">
            Guardar
        </button>

      </div>
    </form>
</div>
@endsection




