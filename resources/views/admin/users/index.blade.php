<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div id="success-alert" class="mb-4 p-3 bg-gray-300 text-gray-800 rounded font-semibold">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function () {
                    const alert = document.getElementById('success-alert');
                    if (alert) alert.style.display = 'none';
                }, 3000);
            </script>
        @endif
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-[#0073B6]">Usuarios</h1>
                <x-btn-crear :href="route('users.create')" :text="'Nuevo Usuario'" />
            </div>

            <form method="GET" action="{{ route('users.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-700" for="name">Filtrar por Nombre</label>
                    <input type="text" name="name" id="name" value="{{ request('name') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="flex items-end space-x-2">
                    <x-btn-filtro-aplicar />

                    @if(request()->filled('name'))
                        <x-btn-filtro-quitar :href="route('users.index')" />
                    @endif
                </div>
            </form>

            <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class=" bg-blue-400 text-white uppercase text-xs">
                            <tr>
                                <th class="py-3 px-4 text-left">Nombre</th>
                                <th class="py-3 px-4 text-left">Email</th>
                                <th class="py-3 px-4 text-left">Rol</th>
                                <th class="py-3 px-4 text-center"> Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $user->name }}</td>
                                    <td class="py-3 px-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->is_admin)
                                            <span
                                                class="p-1 inline-flex text-xs font-semibold rounded-lg bg-purple-100 text-purple-800 ">
                                                Administrador
                                            </span>
                                        @else
                                            <span
                                                class="p-1 inline-flex text-xs font-semibold rounded-lg bg-gray-100 text-gray-800 ">
                                                Usuario
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-3">
                                        <div class="flex justify-center space-x-1">
                                            <x-btn-editar :href="route('users.edit', $user->id)" />
                                            @if (auth()->user()->id !== $user->id)
                                                <x-btn-eliminar :action="route('users.destroy', $user->id)" />
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No hay usuarios registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <x-paginacion :pagina="$users" />

                </div>
            </div>
        </div>
    </div>
</x-app-layout>