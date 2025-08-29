<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div>
                    <x-label for="name" value="Nombre" />
                    <x-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="Email" />
                    <x-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="Contraseña" />
                    <x-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar Contraseña" />
                    <x-input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full" required />
                </div>

                <div class="mt-4">
                    <x-label for="role" value="Rol" />
                    <select id="role" name="role" class="mt-1 block w-full rounded border-gray-300" required>
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div class="flex justify-center mt-6">
                    <x-button id="submitBtn">Registrar Usuario</x-button>
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
                    submitBtn.textContent = 'Registrar Administrador';
                } else {
                    submitBtn.textContent = 'Registrar Usuario';
                }
            }

            roleSelect.addEventListener('change', updateButtonText);
            updateButtonText();
        });
    </script>
</x-app-layout>