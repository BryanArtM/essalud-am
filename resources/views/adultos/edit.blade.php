<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Adulto Mayor') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('adultos.update', $adulto->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <x-label for="dni" value="DNI" />
                            <x-input id="dni" name="dni" type="text" value="{{ old('dni', $adulto->dni) }}"
                                class="block w-full mt-1" />
                        </div>

                        <div>
                            <x-label for="apellidos" value="Apellidos" />
                            <x-input id="apellidos" name="apellidos" type="text"
                                value="{{ old('apellidos', $adulto->apellidos) }}" class="block w-full mt-1" />
                        </div>

                        <div>
                            <x-label for="nombres" value="Nombres" />
                            <x-input id="nombres" name="nombres" type="text"
                                value="{{ old('nombres', $adulto->nombres) }}" class="block w-full mt-1" />
                        </div>

                        <div>
                            <x-label for="fecha_nacimiento" value="Fecha de Nacimiento" />
                            <x-input id="fecha_nacimiento" name="fecha_nacimiento" type="date"
                                value="{{ old('fecha_nacimiento', $adulto->fecha_nacimiento) }}"
                                class="block w-full mt-1" />
                        </div>

                        <div>
                            <x-label for="sexo" value="Sexo" />
                            <select id="sexo" name="sexo"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Seleccione --</option>
                                <option value="Masculino" {{ $adulto->sexo === 'Masculino' ? 'selected' : '' }}>Masculino
                                </option>
                                <option value="Femenino" {{ $adulto->sexo === 'Femenino' ? 'selected' : '' }}>Femenino
                                </option>
                            </select>
                        </div>

                        <div>
                            <x-label for="direccion" value="Dirección" />
                            <x-input id="direccion" name="direccion" type="text"
                                value="{{ old('direccion', $adulto->direccion) }}" class="block w-full mt-1" />
                        </div>

                        <div>
                            <x-label for="telefono" value="Teléfono" />
                            <x-input id="telefono" name="telefono" type="text"
                                value="{{ old('telefono', $adulto->telefono) }}" class="block w-full mt-1" />
                        </div>

                        <div>
                            <x-label for="email" value="Correo Electrónico" />
                            <x-input id="email" name="email" type="email" value="{{ old('email', $adulto->email) }}"
                                class="block w-full mt-1" />
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('adultos.index') }}" class="text-sm text-blue-600 hover:underline">←
                            Cancelar</a>
                        <x-button class="ml-4">
                            {{ __('Guardar Cambios') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>