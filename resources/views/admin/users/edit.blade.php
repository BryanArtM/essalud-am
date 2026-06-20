<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Profesional') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <x-label for="name" value="Nombre" />
                    <x-input id="name" name="name" type="text" class="mt-1 block w-full"
                        value="{{ $user->name }}" required minlength="3" maxlength="50"
                        pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                        title="Solo letras y espacios, mínimo 3 y máximo 50 caracteres" />
                </div>


                <div class="mt-4">
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                        placeholder="ejemplo@gmail.com" value="{{ old('email', $user->email) }}" required
                        title="Solo se permiten correos @gmail.com" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="Contraseña (dejar vacío para no cambiar)" />
                    <x-input-password id="password" class="block mt-1 w-full" name="password"
                        autocomplete="new-password" minlength="8"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$"
                        title="Mínimo 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar Contraseña" />
                    <x-input-password id="password_confirmation" name="password_confirmation"
                        class="mt-1 block w-full" />
                </div>



                <div class="mt-4">
                    <x-label for="role" value="Rol" />
                    <select id="role" name="role" class="mt-1 block w-full rounded border-gray-300">
                        <option value="user" @if ($user->role === 'user') selected @endif>Profesional</option>
                        <option value="admin" @if ($user->role === 'admin') selected @endif>Administrador</option>
                    </select>
                </div>

                <div class="flex justify-center mt-6">
                    <x-button id="submitBtn">Actualizar Profesional</x-button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const submitBtn = document.getElementById('submitBtn');
            const emailInput = document.getElementById('email');
            // Actualizar el texto del botón según el rol seleccionado
            function updateButtonText() {
                if (roleSelect.value === 'admin') {
                    submitBtn.textContent = 'Actualizar Administrador';
                } else {
                    submitBtn.textContent = 'Actualizar Profesional';
                }
            }
            // Validación en tiempo real del email
            emailInput.addEventListener('input', function() {
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
