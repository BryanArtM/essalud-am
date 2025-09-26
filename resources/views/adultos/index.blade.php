<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adultos Mayores') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-sky-800 text-xl font-bold">Adultos Mayores</h1>

                    <x-btn-crear :href="route('adultos.create')" />
                </div>

                <form method="GET" action="{{ route('adultos.index') }}"
                    class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700" for="dni">Filtrar por DNI</label>
                        <input type="text" name="dni" id="dni" pattern="[0-9]{1,8}" maxlength="8"
                            title="Ingrese hasta 8 números" value="{{ request('dni') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8)">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700" for="apellidos">Filtrar por
                            Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" value="{{ request('apellidos') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div class="flex items-end space-x-2">
                        <x-btn-filtro-aplicar />
                        @if(request()->filled('dni') || request()->filled('apellidos'))
                            <x-btn-filtro-quitar :href="route('adultos.index')" />
                        @endif
                    </div>
                </form>

                <div class="overflow-x-auto border rounded-lg shadow-sm">
                    <table class="min-w-full table-auto text-sm">
                        <thead class=" bg-sky-700 text-white uppercase text-xs">
                            <tr>
                                <th class="py-3 px-4 text-left">DNI</th>
                                <th class="py-3 px-4 text-left">Apellidos</th>
                                <th class="py-3 px-4 text-left">Nombres</th>
                                <th class="py-3 px-4 text-left">Teléfono</th>
                                <th class="py-3 px-4 text-left">Email</th>
                                <th class="py-3 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-800">
                            @forelse ($adultos as $adulto)
                                <tr class="hover:bg-[#F0F4F8] transition">
                                    <td class="py-3 px-4">{{ $adulto->dni }}</td>
                                    <td class="py-3 px-4 uppercase">{{ $adulto->apellidos }}</td>
                                    <td class="py-3 px-4 uppercase">{{ $adulto->nombres }}</td>
                                    <td class="py-3 px-4">{{ $adulto->telefono ?? 'N/A' }}</td>
                                    <td class="py-3 px-4">{{ $adulto->email ?? 'N/A' }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-1">
                                            <x-btn-ver :href="route('adultos.show', $adulto->id)" />
                                            <x-btn-editar :href="route('adultos.edit', $adulto->id)" />
                                            <x-btn-eliminar :action="route('adultos.destroy', $adulto->id)" />
                                            <x-btn-pdf :href="route('adultos.pdf', $adulto->id)" />
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-gray-500 italic">
                                        No hay registros disponibles.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <x-paginacion :pagina="$adultos" />
                </div>

            </div>
        </div>
    </div>
</x-app-layout>