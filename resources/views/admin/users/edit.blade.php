<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <x-label for="name" value="Nombre" />
                    <x-input id="name" name="name" type="text" value="{{ $user->name }}" class="mt-1 block w-full"
                        required />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="Email" />
                    <x-input id="email" name="email" type="email" value="{{ $user->email }}" class="mt-1 block w-full"
                        required />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="Contraseña (dejar vacío para no cambiar)" />
                    <x-input id="password" name="password" type="password" class="mt-1 block w-full" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar Contraseña" />
                    <x-input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full" />
                </div>

                <div class="mt-4">
                    <x-label for="role" value="Rol" />
                    <select id="role" name="role" class="mt-1 block w-full rounded border-gray-300">
                        <option value="user" @if($user->role === 'user') selected @endif>Usuario</option>
                        <option value="admin" @if($user->role === 'admin') selected @endif>Administrador</option>
                    </select>
                </div>

                <div class="flex justify-center mt-6">
                    <x-button id="submitBtn">Actualizar Usuario</x-button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const submitBtn = document.getElementById('submitBtn');

            function updateButtonText() {
                if (roleSelect.value === 'admin') {
                    submitBtn.textContent = 'Actualizar Administrador';
                } else {
                    submitBtn.textContent = 'Crear Usuario';
                }
            }
            roleSelect.addEventListener('change', updateButtonText);
            updateButtonText();
        });

    </script>
</x-app-layout>