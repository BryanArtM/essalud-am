<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paso 4 - Evaluaciones y Actividades') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session()->has('adulto_id'))
                    <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded shadow">
                        <strong>Modo edición:</strong> Estás modificando los datos de un adulto mayor registrado.
                    </div>
                @endif

                <form method="POST" action="{{ route('wizard.paso4') }}">
                    @csrf

                    {{-- Evaluaciones --}}
                    <h2 class="text-xl font-semibold mb-4">Evaluaciones</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Talla (cm)</label>
                            <input type="number" step="0.1" name="talla" required
                                value="{{ old('talla', $evaluacion[0]['talla'] ?? '') }}"
                                class="mt-1 block w-full border rounded px-2 py-1 @error('talla') border-red-500 @enderror">
                            @error('talla')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Peso Aceptable (kg)</label>
                            <input type="number" step="0.1" name="peso_aceptable" required
                                value="{{ old('peso_aceptable', $evaluacion[0]['peso_aceptable'] ?? '') }}"
                                class="mt-1 block w-full border rounded px-2 py-1 @error('peso_aceptable') border-red-500 @enderror">
                            @error('peso_aceptable')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @php
                        $evaluaciones = old('evaluaciones', $evaluacion ?? []);
                        $evaluaciones = is_array($evaluaciones) && isset($evaluaciones[0]) ? $evaluaciones : [$evaluaciones];
                    @endphp

                    <div class="overflow-x-auto">
                        <table id="evaluaciones-table" class="table-auto border-collapse">
                            <thead>
                                <tr>
                                    <th class="w-48"></th>
                                    @foreach ($evaluaciones as $i => $eval)
                                        <th class="px-4 py-2">Evaluación {{ $i + 1 }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $campos = [
                                        'peso' => 'Peso (kg)',
                                        'presion_arterial' => 'Presión Arterial',
                                        'glucosa' => 'Glucosa',
                                        'hb_glicosilada' => 'Hb Glicosilada',
                                        'imc' => 'IMC',
                                        'perimetro_abdominal' => 'Perímetro Abdominal',
                                        'evaluacion_pie_dm' => 'Evaluación Pie DM',
                                        'test_morisky_green' => 'Test Morisky-Green',
                                        'vacuna_influenza' => 'Vacuna Influenza',
                                        'vacuna_neumococo' => 'Vacuna Neumococo',
                                        'microalbuminuria' => 'Microalbuminuria',
                                        'creatinina' => 'Creatinina',
                                        'tasa_albuminuria_creatinuria' => 'Tasa Alb/Creat',
                                        'tasa_filtracion_glomerular' => 'Tasa Filtración Glomerular',
                                        'control_renal_fecha' => 'Control Renal (Fecha)',
                                    ];
                                @endphp

                                @foreach ($campos as $key => $label)
                                    <tr>
                                        <td class="font-semibold px-2 py-2 border">{{ $label }}</td>
                                        @foreach ($evaluaciones as $i => $eval)
                                            <td class="px-2 py-2 border">
                                                @if (in_array($key, ['vacuna_influenza', 'vacuna_neumococo']))
                                                    <input type="checkbox" name="evaluaciones[{{ $i }}][{{ $key }}]" value="1"
                                                        {{ !empty($eval[$key]) ? 'checked' : '' }}>
                                                @elseif ($key === 'test_morisky_green')
                                                    <select name="evaluaciones[{{ $i }}][test_morisky_green]" class="w-full">
                                                        <option value="">Seleccione</option>
                                                        <option value="cumple" {{ ($eval[$key] ?? '') === 'cumple' ? 'selected' : '' }}>Cumple</option>
                                                        <option value="no cumple" {{ ($eval[$key] ?? '') === 'no cumple' ? 'selected' : '' }}>No cumple</option>
                                                    </select>
                                                @else
                                                    <input
                                                        type="{{ in_array($key, ['fecha', 'control_renal_fecha']) ? 'date' : (in_array($key, ['presion_arterial', 'evaluacion_pie_dm']) ? 'text' : 'number') }}"
                                                        name="evaluaciones[{{ $i }}][{{ $key }}]"
                                                        value="{{ $eval[$key] ?? '' }}"
                                                        class="w-full border rounded px-2 py-1">
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="button" onclick="agregarEvaluacion()"
                        class="my-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Añadir Evaluación</button>

                    {{-- Actividades --}}
                    <h2 class="text-xl font-semibold my-6">Asistencias a Actividades Educativas</h2>
                    @php
                        $actividades = old('actividades', $actividad ?? []);
                        $actividades = is_array($actividades) && isset($actividades[0]) ? $actividades : [$actividades];
                    @endphp

                    <div class="overflow-x-auto">
                        <table id="actividades-table" class="table-auto border-collapse">
                            <thead>
                                <tr>
                                    <th class="w-48"></th>
                                    @foreach ($actividades as $i => $act)
                                        <th class="px-4 py-2">Actividad {{ $i + 1 }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (['fecha' => 'Fecha de Actividad', 'numero_sesion' => 'N° Sesión'] as $key => $label)
                                    <tr>
                                        <td class="font-semibold px-2 py-2 border">{{ $label }}</td>
                                        @foreach ($actividades as $i => $act)
                                            <td class="px-2 py-2 border">
                                                <input type="{{ $key === 'fecha' ? 'date' : 'text' }}"
                                                    name="actividades[{{ $i }}][{{ $key }}]"
                                                    value="{{ $act[$key] ?? '' }}"
                                                    class="w-full border rounded px-2 py-1">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="button" onclick="agregarActividad()"
                        class="my-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Añadir Actividad</button>

                    {{-- Navegación --}}
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('wizard.paso3') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Atrás</a>
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Siguiente</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


{{-- Scripts --}}
<script>
    let evaluacionIndex = {{ count($evaluaciones) }};

    function agregarEvaluacion() {
        const table = document.getElementById('evaluaciones-table');
        const tbodyRows = table.querySelectorAll('tbody tr');

        // Agrega cabecera en thead
        const theadRow = table.querySelector('thead tr');
        const th = document.createElement('th');
        th.className = "px-4 py-2";
        th.innerText = `Evaluación ${evaluacionIndex + 1}`;
        theadRow.appendChild(th);

        // Diccionario de campos para coincidir con la fila actual
        const campos = {
            'Fecha': 'fecha',
            'Peso (kg)': 'peso',
            'Presión Arterial': 'presion_arterial',
            'Glucosa': 'glucosa',
            'Hb Glicosilada': 'hb_glicosilada',
            'IMC': 'imc',
            'Perímetro Abdominal': 'perimetro_abdominal',
            'Evaluación Pie DM': 'evaluacion_pie_dm',
            'Test Morisky-Green': 'test_morisky_green',
            'Vacuna Influenza': 'vacuna_influenza',
            'Vacuna Neumococo': 'vacuna_neumococo',
            'Microalbuminuria': 'microalbuminuria',
            'Creatinina': 'creatinina',
            'Tasa Alb/Creat': 'tasa_albuminuria_creatinuria',
            'Tasa Filtración Glomerular': 'tasa_filtracion_glomerular',
            'Control Renal (Fecha)': 'control_renal_fecha'
        };

        tbodyRows.forEach(row => {
            const label = row.children[0].innerText.trim();
            const name = campos[label];
            const td = document.createElement('td');

            if (name === 'vacuna_influenza' || name === 'vacuna_neumococo') {
                td.innerHTML = `<input type="checkbox" name="evaluaciones[${evaluacionIndex}][${name}]" value="1">`;
            } else if (name === 'test_morisky_green') {
                td.innerHTML = `
                    <select name="evaluaciones[${evaluacionIndex}][${name}]" class="w-full">
                        <option value="">Seleccione</option>
                        <option value="cumple">Cumple</option>
                        <option value="no cumple">No cumple</option>
                    </select>`;
            } else {
                const type = name.includes('fecha') ? 'date' :
                            ['presion_arterial', 'evaluacion_pie_dm'].includes(name) ? 'text' : 'number';
                td.innerHTML = `<input type="${type}" name="evaluaciones[${evaluacionIndex}][${name}]" class="w-full border rounded px-2 py-1">`;
            }

            row.appendChild(td);
        });

        evaluacionIndex++;
    }


    let actividadIndex = {{ count($actividades) }};
    function agregarActividad() {
        const table = document.getElementById('actividades-table');
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const label = row.children[0].innerText.trim();
            const name = label === 'Fecha de Actividad' ? 'fecha' : 'numero_sesion';
            const type = name === 'fecha' ? 'date' : 'text';
            const td = document.createElement('td');
            td.innerHTML = `<input type="${type}" name="actividades[${actividadIndex}][${name}]" class="w-full border rounded px-2 py-1">`;
            row.appendChild(td);
        });

        const header = table.querySelector('thead tr');
        const th = document.createElement('th');
        th.className = "px-4 py-2";
        th.innerText = `Actividad ${actividadIndex + 1}`;
        header.appendChild(th);

        actividadIndex++;
    }
</script>
</x-app-layout>






