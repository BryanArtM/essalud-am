<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Editar Usuario</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            <div>
                <label>Nombre</label>
                <input type="text" name="name" value="{{ $user->name }}" class="border rounded w-full" required>
            </div>
            <div class="mt-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="border rounded w-full" required>
            </div>
            <div class="mt-4">
                <label>Nueva Contraseña (opcional)</label>
                <input type="password" name="password" class="border rounded w-full">
            </div>
            <div class="mt-6">
                <button class="bg-green-600 text-white px-4 py-2 rounded">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
