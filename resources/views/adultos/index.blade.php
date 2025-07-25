@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-[#0073B6] ">Adultos Mayores</h1>
        <a href="{{ route('wizard.paso1') }}"
            class="bg-blue-400 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded shadow">
            + Registrar Nuevo
        </a>
    </div>

    {{-- Filtros --}}
<form method="GET" action="{{ route('adultos.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-semibold mb-1 text-gray-700" for="dni">Filtrar por DNI</label>
        <input type="text" name="dni" id="dni" value="{{ request('dni') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label class="block text-sm font-semibold mb-1 text-gray-700" for="apellidos">Filtrar por Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value="{{ request('apellidos') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>

    <div class="flex items-end space-x-2">
        <button type="submit"
                class="bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 rounded shadow text-sm">
            Aplicar Filtros
        </button>

        {{-- Mostrar solo si hay filtros aplicados --}}
        @if(request()->filled('dni') || request()->filled('apellidos'))
            <a href="{{ route('adultos.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow text-sm">
                Quitar Filtros
            </a>
        @endif
    </div>
</form>



    {{-- Tabla --}}
    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-blue-400 text-white uppercase text-xs">
                <tr>
                    <th class="py-3 px-4 text-left">DNI</th>
                    <th class="py-3 px-4 text-left">Apellidos</th>
                    <th class="py-3 px-4 text-left">Nombres</th>
                    <th class="py-3 px-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-800">
                @forelse ($adultos as $adulto)
                    <tr class="hover:bg-[#F0F4F8] transition">
                        <td class="py-3 px-4">{{ $adulto->dni }}</td>
                        <td class="py-3 px-4 uppercase">{{ $adulto->apellidos }}</td>
                        <td class="py-3 px-4 uppercase">{{ $adulto->nombres }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('adultos.show', $adulto->id) }}"
                                    class="bg-blue-400 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs shadow">
                                    Ver
                                </a>
                                <a href="{{ route('adultos.edit', $adulto->id) }}"
                                    class="bg-yellow-400 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs shadow">
                                    Editar
                                </a>
                                <form action="{{ route('adultos.destroy', $adulto->id) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('¿Está seguro de eliminar este registro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-400 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500 italic">
                            No hay registros disponibles.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <x-paginacion :pagina="$adultos" />

    </div>
</div>




@endsection