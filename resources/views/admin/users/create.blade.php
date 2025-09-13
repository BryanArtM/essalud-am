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
                    <x-input id="name" name="name" type="text" class="mt-1 block w-full" required minlength="3"
                        autofocus maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                        title="Solo letras y espacios, mínimo 3 y máximo 50 caracteres" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}"
                        required placeholder="ejemplo@gmail.com" autocomplete="username" title="Solo se permiten correos @gmail.com" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="Contraseña" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" minlength="8"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$"
                        title="Mínimo 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar Contraseña" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required />
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
            const emailInput = document.getElementById('email');

            // Actualizar el texto del botón según el rol seleccionado
            function updateButtonText() {
                if (roleSelect.value === 'admin') {
                    submitBtn.textContent = 'Registrar Administrador';
                } else {
                    submitBtn.textContent = 'Registrar Usuario';
                }
            }
            // Validación en tiempo real del email
            emailInput.addEventListener('input', function () {
                const email = this.value.trim();

                if (email.length > 0) {
                    if (!email.endsWith('@gmail.com')) {
                        this.setCustomValidity('Solo se permiten correos @gmail.com');
                    } else {
                        this.setCustomValidity('');
                    }
                } else {
                    this.setCustomValidity('');
                }
            });
            // Actualizar el texto del botón según el rol seleccionado
            roleSelect.addEventListener('change', updateButtonText);
            updateButtonText();
        });
    </script>
</x-app-layout>