<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paso 5 - Tratamientos y Citas Médicas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if (session()->has('adulto_id'))
                    <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded shadow">
                        <strong>Modo edición:</strong> Estás modificando los datos de un adulto mayor registrado.
                    </div>
                @endif

                <form action="{{ route('wizard.paso5') }}" method="POST">
                    @csrf

                    {{-- Citas Médicas --}}
                    <h3 class="text-lg font-semibold mb-4">Citas Médicas</h3>

                    <div id="citas-wrapper">
                        @if(old('citas', $citas))
                            @foreach(old('citas', $citas) as $i => $cita)
                                <div class="grid grid-cols-3 gap-4 mb-4">
                                    <input type="date" name="citas[{{ $i }}][fecha]"
                                           value="{{ $cita['fecha'] ?? '' }}"
                                           class="w-full border rounded px-3 py-2" required>

                                    <input type="text" name="citas[{{ $i }}][medico]"
                                           value="{{ $cita['medico'] ?? '' }}"
                                           class="w-full border rounded px-3 py-2" required>

                                    <input type="text" name="citas[{{ $i }}][enfermera]"
                                           value="{{ $cita['enfermera'] ?? '' }}"
                                           class="w-full border rounded px-3 py-2" required>
                                </div>
                            @endforeach
                        @else
                            <div class="grid grid-cols-3 gap-4 mb-4">
                                <input type="date" name="citas[0][fecha]" class="w-full border rounded px-3 py-2" required>
                                <input type="text" name="citas[0][medico]" class="w-full border rounded px-3 py-2" required>
                                <input type="text" name="citas[0][enfermera]" class="w-full border rounded px-3 py-2" required>
                            </div>
                        @endif
                    </div>

                    <button type="button" onclick="agregarCita()"
                            class="mb-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Añadir Cita
                    </button>

                    {{-- Tratamiento Farmacológico --}}
                    <h3 class="text-lg font-semibold mb-4 mt-6">Tratamiento Farmacológico</h3>

                    <div id="tratamientos-wrapper">
                        @if(old('tratamientos', $tratamientos))
                            @foreach(old('tratamientos', $tratamientos) as $i => $tratamiento)
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <input type="text" name="tratamientos[{{ $i }}][medicacion]"
                                           value="{{ $tratamiento['medicacion'] ?? '' }}"
                                           class="w-full border rounded px-3 py-2" required>

                                    <input type="number" name="tratamientos[{{ $i }}][dosis]"
                                           value="{{ $tratamiento['dosis'] ?? '' }}"
                                           class="w-full border rounded px-3 py-2" required>
                                </div>
                            @endforeach
                        @else
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <input type="text" name="tratamientos[0][medicacion]" class="w-full border rounded px-3 py-2">
                                <input type="number" name="tratamientos[0][dosis]" class="w-full border rounded px-3 py-2">
                            </div>
                        @endif
                    </div>

                    <button type="button" onclick="agregarTratamiento()"
                            class="mb-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Añadir Tratamiento
                    </button>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('wizard.paso4') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Atrás
                        </a>
                        <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Siguiente
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        let index = {{ old('tratamientos', $tratamientos ?? []) ? count(old('tratamientos', $tratamientos ?? [])) : 1 }};
        function agregarTratamiento() {
            const wrapper = document.getElementById('tratamientos-wrapper');
            const div = document.createElement('div');
            div.className = "grid grid-cols-2 gap-4 mb-4";
            div.innerHTML = `
                <input type="text" name="tratamientos[${index}][medicacion]" class="w-full border rounded px-3 py-2" required>
                <input type="number" name="tratamientos[${index}][dosis]" class="w-full border rounded px-3 py-2" required>
            `;
            wrapper.appendChild(div);
            index++;
        }

        let citaIndex = {{ old('citas', $citas ?? []) ? count(old('citas', $citas ?? [])) : 1 }};
        function agregarCita() {
            const wrapper = document.getElementById('citas-wrapper');
            const div = document.createElement('div');
            div.className = "grid grid-cols-3 gap-4 mb-4";
            div.innerHTML = `
                <input type="date" name="citas[${citaIndex}][fecha]" class="w-full border rounded px-3 py-2" required>
                <input type="text" name="citas[${citaIndex}][medico]" class="w-full border rounded px-3 py-2" required>
                <input type="text" name="citas[${citaIndex}][enfermera]" class="w-full border rounded px-3 py-2" required>
            `;
            wrapper.appendChild(div);
            citaIndex++;
        }
    </script>
</x-app-layout>
