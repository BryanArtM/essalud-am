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

                <form
                    action="{{ isset($adulto_id) && $adulto_id ? route('wizard.paso5.post', ['adulto_id' => $adulto_id]) : route('wizard.paso5.post') }}"
                    method="POST">
                    @csrf
                    {{-- Citas Médicas --}}
                    <h2 class="mt-4 mb-3 text-center text-xl font-semibold">CITAS MÉDICAS</h2>
                    <div class="mt-4  flex gap-2" id="citas-controls">
                        <button type="button" onclick="agregarCita()"
                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 flex items-center"
                            title="Añadir Cita">

                            <span>Añadir</span>
                        </button>
                        <button type="button" onclick="eliminarCita()"
                            class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 flex items-center"
                            id="eliminar-cita-btn" title="Eliminar Cita" style="display: none;">
                            <span>Eliminar</span>
                        </button>
                    </div>
                    <div class="flex justify-around font-semibold text-gray-800">
                        <label>Fecha</label>
                        <label>Médico</label>
                        <label>Enfermera</label>
                    </div>
                    <div id="citas-wrapper">
                        @if(old('citas', $citas ?? false))
                            @foreach(old('citas', $citas) as $i => $cita)
                                <div class="grid grid-cols-3 gap-4 mb-4">
                                    {{-- Campo hidden para preservar el ID del registro --}}
                                    @if(isset($cita['id']))
                                        <input type="hidden" name="citas[{{ $i }}][id]" value="{{ $cita['id'] }}">
                                    @endif

                                    <input type="date" name="citas[{{ $i }}][fecha]" value="{{ $cita['fecha'] ?? '' }}"
                                        class="w-full border rounded px-3 py-2">

                                    <input type="text" name="citas[{{ $i }}][medico]" value="{{ $cita['medico'] ?? '' }}"
                                        class="w-full border rounded px-3 py-2">

                                    <input type="text" name="citas[{{ $i }}][enfermera]" value="{{ $cita['enfermera'] ?? '' }}"
                                        class="w-full border rounded px-3 py-2">
                                </div>
                            @endforeach
                        @endif
                    </div>

                    {{-- Tratamiento Farmacológico --}}
                    <hr class="border-gray-300 mt-7">
                    <h2 class="mt-7 mb-4 text-center text-xl font-semibold">TRATAMIENTO FARMACOLÓGICO</h2>
                    <div class="mt-4 flex gap-2" id="tratamientos-controls">
                        <button type="button" onclick="agregarTratamiento()"
                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 flex items-center"
                            title="Añadir Tratamiento">

                            <span>Añadir</span>
                        </button>
                        <button type="button" onclick="eliminarTratamiento()"
                            class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 flex items-center"
                            id="eliminar-tratamiento-btn" title="Eliminar Tratamiento" style="display: none;">

                            <span>Eliminar</span>
                        </button>
                    </div>
                    <div class="flex justify-around font-semibold text-gray-800">
                        <label>Medicación</label>
                        <label>Dosis</label>
                    </div>
                    <div id="tratamientos-wrapper">
                        @if(old('tratamientos', $tratamientos ?? false))
                            @foreach(old('tratamientos', $tratamientos) as $i => $tratamiento)
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    {{-- Campo hidden para preservar el ID del registro --}}
                                    @if(isset($tratamiento['id']))
                                        <input type="hidden" name="tratamientos[{{ $i }}][id]" value="{{ $tratamiento['id'] }}">
                                    @endif

                                    <input type="text" name="tratamientos[{{ $i }}][medicacion]"
                                        value="{{ $tratamiento['medicacion'] ?? '' }}" class="w-full border rounded px-3 py-2">

                                    <input type="text" name="tratamientos[{{ $i }}][dosis]"
                                        value="{{ $tratamiento['dosis'] ?? '' }}" class="w-full border rounded px-3 py-2" placeholder="Ej: 5 mg, 10 ml">
                                </div>
                            @endforeach
                        @endif
                    </div>

                    {{-- Botones Navegación --}}
                    <div class="flex justify-between mt-6">
                        <a href="{{ isset($adulto_id) && $adulto_id ? route('wizard.paso4', ['adulto_id' => $adulto_id]) : route('wizard.paso4') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Atrás
                        </a>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Siguiente
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        // Variables para control de registros originales vs nuevos
        const tratamientosOriginales = @if(old('tratamientos', $tratamientos ?? false)) {{ count(old('tratamientos', $tratamientos ?? [])) }} @else 0 @endif;
        const citasOriginales = @if(old('citas', $citas ?? false)) {{ count(old('citas', $citas ?? [])) }} @else 0 @endif;

        // Mostrar/ocultar botón eliminar según registros agregados
        function actualizarBotonEliminarTratamiento() {
            const btn = document.getElementById('eliminar-tratamiento-btn');
            if (!btn) return;
            const wrapper = document.getElementById('tratamientos-wrapper');
            const registros = wrapper.querySelectorAll('.grid');
            btn.style.display = (registros.length > tratamientosOriginales) ? 'flex' : 'none';
        }

        function actualizarBotonEliminarCita() {
            const btn = document.getElementById('eliminar-cita-btn');
            if (!btn) return;
            const wrapper = document.getElementById('citas-wrapper');
            const registros = wrapper.querySelectorAll('.grid');
            btn.style.display = (registros.length > citasOriginales) ? 'flex' : 'none';
        }

        // Llamar al cargar la página
        window.addEventListener('DOMContentLoaded', function () {
            actualizarBotonEliminarTratamiento();
            actualizarBotonEliminarCita();
        });

        let index = tratamientosOriginales;
        function agregarTratamiento() {
            const wrapper = document.getElementById('tratamientos-wrapper');
            const div = document.createElement('div');
            div.className = "grid grid-cols-2 gap-4 mb-4";
            div.innerHTML = `
                <input type="text" name="tratamientos[${index}][medicacion]" class="w-full border rounded px-3 py-2" >
                <input type="text" name="tratamientos[${index}][dosis]" class="w-full border rounded px-3 py-2" placeholder="Ej: 5 mg, 10 ml">
            `;
            wrapper.appendChild(div);
            index++;
            actualizarBotonEliminarTratamiento();
        }

        let citaIndex = citasOriginales;
        function agregarCita() {
            const wrapper = document.getElementById('citas-wrapper');
            const div = document.createElement('div');
            div.className = "grid grid-cols-3 gap-4 mb-4";
            div.innerHTML = `
                <input type="date" name="citas[${citaIndex}][fecha]" class="w-full border rounded px-3 py-2" >
                <input type="text" name="citas[${citaIndex}][medico]" class="w-full border rounded px-3 py-2" >
                <input type="text" name="citas[${citaIndex}][enfermera]" class="w-full border rounded px-3 py-2" >
            `;
            wrapper.appendChild(div);
            citaIndex++;
            actualizarBotonEliminarCita();
        }

        // Funciones para eliminar registros (solo los agregados en esta sesión)
        function eliminarTratamiento() {
            const wrapper = document.getElementById('tratamientos-wrapper');
            const registros = wrapper.querySelectorAll('.grid');

            // Solo se pueden eliminar los registros agregados en esta sesión
            if (registros.length <= tratamientosOriginales) {
                alert('No se pueden eliminar los tratamientos ya registrados. Solo se pueden eliminar los que acabas de agregar en esta sesión.');
                return;
            }

            // Eliminar el último registro
            registros[registros.length - 1].remove();
            index--;
            actualizarBotonEliminarTratamiento();
        }

        function eliminarCita() {
            const wrapper = document.getElementById('citas-wrapper');
            const registros = wrapper.querySelectorAll('.grid');

            // Solo se pueden eliminar los registros agregados en esta sesión
            if (registros.length <= citasOriginales) {
                alert('No se pueden eliminar las citas ya registradas. Solo se pueden eliminar las que acabas de agregar en esta sesión.');
                return;
            }

            // Eliminar el último registro
            registros[registros.length - 1].remove();
            citaIndex--;
            actualizarBotonEliminarCita();
        }
    </script>
</x-app-layout>