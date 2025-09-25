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

                <form method="POST" action="{{ isset($adulto_id) && $adulto_id ? route('wizard.paso4.post', ['adulto_id' => $adulto_id]) : route('wizard.paso4.post') }}">
                    @csrf

                    {{-- Evaluaciones --}}
                        <h2 class="mb-4 text-center text-xl font-semibold">EVALUACIONES</h2>

                    <div class="flex justify-center gap-4 mb-6">
                        <div>
                            <div class="flex justify-center">
                                <label class="block text-sm font-medium text-gray-700">Talla (cm)</label>
                            </div>
                            
                            <input type="number" step="0.01" min="0" name="talla"
                                value="{{ old('talla', $evaluacion[0]['talla'] ?? '') }}"
                                class="mt-1 block w-full border rounded px-2 py-1 @error('talla') border-red-500 @enderror">
                            @error('talla')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <div class="flex justify-center">
                                <label class="block text-sm font-medium text-gray-700">Peso Aceptable (kg)</label>
                            </div>
                            <input type="number" step="0.01" min="0" name="peso_aceptable"
                                value="{{ old('peso_aceptable', $evaluacion[0]['peso_aceptable'] ?? '') }}"
                                class="mt-1 block w-full border rounded px-2 py-1 @error('peso_aceptable') border-red-500 @enderror">
                            @error('peso_aceptable')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <div class="mt-3 mb-4 flex gap-2" id="evaluaciones-controls">
                            <button type="button" onclick="agregarEvaluacion()" 
                                class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 flex items-center" 
                                title="Añadir Evaluación">
                                <span>Añadir</span>

                            </button>
                            <button type="button" onclick="eliminarEvaluacion()" 
                                class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 flex items-center" 
                                id="eliminar-evaluacion-btn"
                                title="Eliminar Evaluación"
                                style="display: none;">
                                <span>Eliminar</span>
                            </button>
                        </div>
                        <table id="evaluaciones-table" class="border-collapse border border-gray-300 " style="width: auto;">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="w-48 px-4 py-2 border border-gray-300 text-center text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-10"></th>
                                    @if(old('evaluaciones', $evaluaciones ?? false))
                                        @foreach(old('evaluaciones', $evaluaciones ?? []) as $i => $eval)
                                            <th class="w-48 px-4 py-2 border border-gray-300 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Evaluación {{ $i + 1 }}</th>
                                            {{-- Campo hidden para preservar el ID de la evaluación --}}
                                            @if(isset($eval['id']))
                                                <input type="hidden" name="evaluaciones[{{ $i }}][id]" value="{{ $eval['id'] }}">
                                            @endif
                                        @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="evaluaciones-body">
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
                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold px-2 py-2 border border-gray-300 bg-gray-50 sticky left-0 z-10 w-48">{{ $label }}</td>
                                        @if(old('evaluaciones', $evaluaciones ?? false))
                                            @foreach(old('evaluaciones', $evaluaciones ?? []) as $i => $eval)
                                                <td class="w-48 px-2 py-2 border border-gray-300">
                                                    @if (in_array($key, ['vacuna_influenza', 'vacuna_neumococo']))
                                                        <input type="checkbox" name="evaluaciones[{{ $i }}][{{ $key }}]" value="1"{{ !empty($eval[$key]) ? 'checked' : '' }}>
                                                    @elseif ($key === 'test_morisky_green')
                                                        <select name="evaluaciones[{{ $i }}][test_morisky_green]" class="w-full">
                                                            <option value="">Seleccione</option>
                                                            <option value="cumple" {{ ($eval[$key] ?? '') === 'cumple' ? 'selected' : '' }}>Cumple</option>
                                                            <option value="no cumple" {{ ($eval[$key] ?? '') === 'no cumple' ? 'selected' : '' }}>No cumple</option>
                                                        </select>
                                                    @else
                                                        @php
                                                            $inputType = in_array($key, ['fecha', 'control_renal_fecha']) ? 'date' : (in_array($key, ['presion_arterial', 'evaluacion_pie_dm']) ? 'text' : 'number');
                                                            $isNumericField = in_array($key, ['peso', 'glucosa', 'hb_glicosilada', 'imc', 'perimetro_abdominal', 'microalbuminuria', 'creatinina', 'tasa_albuminuria_creatinuria', 'tasa_filtracion_glomerular']);
                                                        @endphp
                                                        <input
                                                            type="{{ $inputType }}"
                                                            name="evaluaciones[{{ $i }}][{{ $key }}]"
                                                            value="{{ $eval[$key] ?? '' }}"
                                                            @if($isNumericField) step="0.01" min="0" @endif
                                                            class="w-full border rounded px-2 py-1">
                                                    @endif
                                                </td>
                                            @endforeach
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr class="border-gray-300 mt-7">
                    {{-- Actividades --}}
                        <h2 class="text-center text-xl font-semibold mt-4 mb-2">ASISTENCIAS A ACTIVIDADES EDUCATIVAS</h2>


                    <div class="overflow-x-auto">
                        <div class="mt-3 mb-4 flex gap-2" id="actividades-controls">
                            <button type="button" onclick="agregarActividad()" 
                                class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 flex items-center" 
                                title="Añadir Actividad">
                                <span>Añadir</span>
                            </button>
                            <button type="button" onclick="eliminarActividad()" 
                                class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 flex items-center" 
                                id="eliminar-actividad-btn"
                                title="Eliminar Actividad"
                                style="display: none;">
                                <span>Eliminar</span>

                            </button>
                        </div>
                        <table id="actividades-table" class="border-collapse border border-gray-300" style="width: auto;">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="w-48 px-4 py-2 border border-gray-300 text-center text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-10"></th>
                                    @if(old('actividades', $actividades ?? false))
                                        @foreach(old('actividades', $actividades ?? []) as $i => $act)
                                            <th class="w-48 px-4 py-2 border border-gray-300 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actividad {{ $i + 1 }}</th>
                                            {{-- Campo hidden para preservar el ID de la actividad --}}
                                            @if(isset($act['id']))
                                                <input type="hidden" name="actividades[{{ $i }}][id]" value="{{ $act['id'] }}">
                                            @endif
                                        @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (['fecha' => 'Fecha de Actividad', 'numero_sesion' => 'N° Sesión'] as $key => $label)
                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold px-2 py-2 border border-gray-300 bg-gray-50 sticky left-0 z-10 w-48">{{ $label }}</td>
                                        @if(old('actividades', $actividades ?? false))
                                            @foreach(old('actividades', $actividades ?? []) as $i => $act)
                                                <td class="w-48 px-2 py-2 border border-gray-300">
                                                    <input type="{{ $key === 'fecha' ? 'date' : 'text' }}"
                                                        name="actividades[{{ $i }}][{{ $key }}]"
                                                        value="{{ old('actividades.' . $i . '.' . $key, $act[$key] ?? '') }}"
                                                        class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                </td>
                                            @endforeach
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- Navegación --}}
                    <div class="flex justify-between mt-6">
                        <a href="{{ isset($adulto_id) && $adulto_id ? route('wizard.paso3', ['adulto_id' => $adulto_id]) : route('wizard.paso3') }}"
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
    // Variables para control de columnas originales vs nuevas
    const evaluacionesOriginales = @if(old('evaluaciones', $evaluaciones ?? false)) {{ count(old('evaluaciones', $evaluaciones ?? [])) }} @else 0 @endif;
    const actividadesOriginales = @if(old('actividades', $actividades ?? false)) {{ count(old('actividades', $actividades ?? [])) }} @else 0 @endif;
    
    let evaluacionIndex = evaluacionesOriginales;

    function agregarEvaluacion() {
        const table = document.getElementById('evaluaciones-table');
        const tbodyRows = table.querySelectorAll('tbody tr');

        // Agrega cabecera en thead
        const theadRow = table.querySelector('thead tr');
        const th = document.createElement('th');
        th.className = "text-center min-w-[200px] px-4 py-2 border border-gray-300 text-xs font-medium text-gray-500 uppercase tracking-wider";
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
            td.className = "w-48 px-2 py-2 border border-gray-300";

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
                const stepAttr = ['peso', 'glucosa', 'hb_glicosilada', 'imc', 'perimetro_abdominal', 'microalbuminuria', 'creatinina', 'tasa_albuminuria_creatinuria', 'tasa_filtracion_glomerular'].includes(name) ? ' step="0.01" min="0"' : '';

                td.innerHTML = `<input type="${type}" name="evaluaciones[${evaluacionIndex}][${name}]" class="w-full border rounded px-2 py-1"${stepAttr}>`;
            }

            row.appendChild(td);
        });

        evaluacionIndex++;
        actualizarBotonEliminarEvaluacion();
    }


    let actividadIndex = actividadesOriginales;
    function agregarActividad() {
        const table = document.getElementById('actividades-table');
        
        // Add header column
        const header = table.querySelector('thead tr');
        const th = document.createElement('th');
        th.className = "w-48 px-4 py-2 border border-gray-300 text-center text-xs font-medium text-gray-500 uppercase tracking-wider";
        th.innerText = `Actividad ${actividadIndex + 1}`;
        header.appendChild(th);
        
        // Add data columns
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const label = row.children[0].innerText.trim();
            const name = label === 'Fecha de Actividad' ? 'fecha' : 'numero_sesion';
            const type = name === 'fecha' ? 'date' : 'text';
            const td = document.createElement('td');
            td.className = "w-48 px-2 py-2 border border-gray-300";
            td.innerHTML = `<input type="${type}" name="actividades[${actividadIndex}][${name}]" class="w-full border rounded px-2 py-1">`;
            row.appendChild(td);
        });

        actividadIndex++;
        actualizarBotonEliminarActividad();
    }

    // Mostrar/ocultar botón eliminar según columnas agregadas
    function actualizarBotonEliminarEvaluacion() {
        const btn = document.getElementById('eliminar-evaluacion-btn');
        if (!btn) return;
        const table = document.getElementById('evaluaciones-table');
        const headerCells = table.querySelectorAll('thead th');
        const totalColumnas = headerCells.length - 1;
        btn.style.display = (totalColumnas > evaluacionesOriginales) ? 'flex' : 'none';
    }

    function actualizarBotonEliminarActividad() {
        const btn = document.getElementById('eliminar-actividad-btn');
        if (!btn) return;
        const table = document.getElementById('actividades-table');
        const headerCells = table.querySelectorAll('thead th');
        const totalColumnas = headerCells.length - 1;
        btn.style.display = (totalColumnas > actividadesOriginales) ? 'flex' : 'none';
    }

    // Llamar al cargar la página
    window.addEventListener('DOMContentLoaded', function() {
        actualizarBotonEliminarEvaluacion();
        actualizarBotonEliminarActividad();
    });

    // Al agregar o eliminar, actualizar visibilidad del botón
    function eliminarEvaluacion() {
        const table = document.getElementById('evaluaciones-table');
        const headerCells = table.querySelectorAll('thead th');
        const bodyRows = table.querySelectorAll('tbody tr');
        
        // Calcular columnas totales (excluyendo la primera que es de labels)
        const totalColumnas = headerCells.length - 1;
        
        // Solo se pueden eliminar las columnas agregadas en esta sesión
        if (totalColumnas <= evaluacionesOriginales) {
            alert('No se pueden eliminar las evaluaciones ya registradas. Solo se pueden eliminar las que acabas de agregar en esta sesión.');
            return;
        }
        
        // Eliminar la última columna del header
        headerCells[headerCells.length - 1].remove();
        
        // Eliminar la última celda de cada fila del body
        bodyRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 1) {
                cells[cells.length - 1].remove();
            }
        });
        
        evaluacionIndex--;
        actualizarBotonEliminarEvaluacion();
    }

    function eliminarActividad() {
        const table = document.getElementById('actividades-table');
        const headerCells = table.querySelectorAll('thead th');
        const bodyRows = table.querySelectorAll('tbody tr');
        
        // Calcular columnas totales (excluyendo la primera que es de labels)
        const totalColumnas = headerCells.length - 1;
        
        // Solo se pueden eliminar las columnas agregadas en esta sesión
        if (totalColumnas <= actividadesOriginales) {
            alert('No se pueden eliminar las actividades ya registradas. Solo se pueden eliminar las que acabas de agregar en esta sesión.');
            return;
        }
        
        // Eliminar la última columna del header
        headerCells[headerCells.length - 1].remove();
        
        // Eliminar la última celda de cada fila del body
        bodyRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 1) {
                cells[cells.length - 1].remove();
            }
        });
        
        actividadIndex--;
        actualizarBotonEliminarActividad();
    }
</script>
</x-app-layout>






