@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

    <form action="{{ route('wizard.paso5') }}" method="POST">
        @csrf

        {{-- Cita --}}
        {{-- Citas Médicas --}}
        <h3 class="text-lg font-semibold mb-4">Citas Médicas</h3>

        <div id="citas-wrapper">
            @if(old('citas', $citas))
                @foreach(old('citas', $citas) as $i => $cita)
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <input type="date" name="citas[{{ $i }}][fecha]" placeholder="Fecha"
                        value="{{ $cita['fecha'] ?? '' }}" class="w-full border rounded px-3 py-2" required>

                    <input type="text" name="citas[{{ $i }}][medico]" placeholder="Médico"
                        value="{{ $cita['medico'] ?? '' }}" class="w-full border rounded px-3 py-2" required>

                    <input type="text" name="citas[{{ $i }}][enfermera]" placeholder="Enfermera"
                        value="{{ $cita['enfermera'] ?? '' }}" class="w-full border rounded px-3 py-2" required>
                </div>
                @endforeach
            @else
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <input type="date" name="citas[0][fecha]" placeholder="Fecha"
                        class="w-full border rounded px-3 py-2" required>

                    <input type="text" name="citas[0][medico]" placeholder="Médico"
                        class="w-full border rounded px-3 py-2" required>

                    <input type="text" name="citas[0][enfermera]" placeholder="Enfermera"
                        class="w-full border rounded px-3 py-2" required>
                </div>  
            @endif
        </div>

        <button type="button" onclick="agregarCita()"
            class="mb-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Añadir Cita</button>


        {{-- Tratamiento --}}
        <h3 class="text-lg font-semibold mb-4 mt-6">TRATAMIENTO FARMACOLÓGICO</h3>

        <div id="tratamientos-wrapper">
            @if(old('tratamientos', $tratamientos))
                @foreach(old('tratamientos', $tratamientos) as $i => $tratamiento)
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input type="text" name="tratamientos[{{ $i }}][medicacion]" placeholder="Medicamento"
                        value="{{ $tratamiento['medicacion'] ?? '' }}"
                        class="w-full border rounded px-3 py-2" required>

                    <input type="number" name="tratamientos[{{ $i }}][dosis]" placeholder="Dosis"
                        value="{{ $tratamiento['dosis'] ?? '' }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
                @endforeach
            @else
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input type="text" name="tratamientos[0][medicacion]" placeholder="Medicamento"
                        class="w-full border rounded px-3 py-2" >

                    <input type="number" name="tratamientos[0][dosis]" placeholder="Dosis"
                        class="w-full border rounded px-3 py-2" >
                </div>
            @endif
        </div>

        <button type="button" onclick="agregarTratamiento()"
            class="mb-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Añadir Tratamiento</button>

        <div class="flex justify-between mt-6">
            <a href="{{ route('wizard.paso4') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Atrás</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Siguiente</button>
        </div>
    </form>
</div>

<script>
    let index = {{ old('tratamientos', $tratamientos ?? []) ? count(old('tratamientos', $tratamientos ?? [])) : 1 }};

    function agregarTratamiento() {
        const wrapper = document.getElementById('tratamientos-wrapper');
        const div = document.createElement('div');
        div.className = "grid grid-cols-2 gap-4 mb-4";
        div.innerHTML = `
            <input type="text" name="tratamientos[${index}][medicacion]" placeholder="Medicamento"
                class="w-full border rounded px-3 py-2" required>

            <input type="number" name="tratamientos[${index}][dosis]" placeholder="Dosis"
                class="w-full border rounded px-3 py-2" required>
        `;
        wrapper.appendChild(div);
        index++;
    }
</script>

<script>
    let citaIndex = {{ old('citas', $citas ?? []) ? count(old('citas', $citas ?? [])) : 1 }};

    function agregarCita() {
        const wrapper = document.getElementById('citas-wrapper');
        const div = document.createElement('div');
        div.className = "grid grid-cols-3 gap-4 mb-4";
        div.innerHTML = `
            <input type="date" name="citas[${citaIndex}][fecha]" placeholder="Fecha"
                class="w-full border rounded px-3 py-2" required>

            <input type="text" name="citas[${citaIndex}][medico]" placeholder="Médico"
                class="w-full border rounded px-3 py-2" required>

            <input type="text" name="citas[${citaIndex}][enfermera]" placeholder="Enfermera"
                class="w-full border rounded px-3 py-2" required>
        `;
        wrapper.appendChild(div);
        citaIndex++;
    }
</script>

@endsection
