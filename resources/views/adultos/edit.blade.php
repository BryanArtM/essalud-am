@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-[#0073B6]">Editar Adulto Mayor</h1>

    <form action="{{ route('adultos.update', $adulto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-medium text-sm text-gray-700">DNI</label>
                <input type="text" name="dni" value="{{ old('dni', $adulto->dni) }}" class="form-input w-full">
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Apellidos</label>
                <input type="text" name="apellidos" value="{{ old('apellidos', $adulto->apellidos) }}" class="form-input w-full">
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Nombres</label>
                <input type="text" name="nombres" value="{{ old('nombres', $adulto->nombres) }}" class="form-input w-full">
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $adulto->fecha_nacimiento) }}" class="form-input w-full">
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Sexo</label>
                <select name="sexo" class="form-select w-full">
                    <option value="">-- Seleccione --</option>
                    <option value="Masculino" {{ $adulto->sexo === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ $adulto->sexo === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $adulto->direccion) }}" class="form-input w-full">
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $adulto->telefono) }}" class="form-input w-full">
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email', $adulto->email) }}" class="form-input w-full">
            </div>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('adultos.index') }}" class="text-sm text-blue-600 hover:underline">← Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
