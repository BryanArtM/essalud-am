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
        <div class="flex justify-end">
            <a href="{{ route('users.create') }}"
                class="inline-block px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition">
                + Nuevo Usuario
            </a>
        </div>

        <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rol</th>
                            <th
                                class="flex justify-center px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if($user->is_admin)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                            Administrador
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Usuario
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center space-x-3">
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                                    @if (auth()->user()->id !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block"
                                            onsubmit="return confirm('¿Eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif
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
            </div>
        </div>
</x-app-layout>