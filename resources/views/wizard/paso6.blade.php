{{-- resources/views/wizard/paso6.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Valoración Funcional y Servicios') }}
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

                <form action="{{ isset($adulto_id) && $adulto_id ? route('wizard.paso6.post', ['adulto_id' => $adulto_id]) : route('wizard.paso6.post') }}" method="POST">
                    @csrf
                    {{-- Campo hidden para preservar el ID de la valoración --}}
                    @if(isset($data['id']))
                        <input type="hidden" name="id" value="{{ $data['id'] }}">
                    @endif
                    {{-- Evaluación Geriátrica --}}
                    <h2 class="text-center text-xl font-semibold mb-4">ADULTO MAYOR 75 AÑOS A MÁS</h2>

                    <div class="mb-4">
                        <label class="font-semibold">¿Autovalente?</label>
                        <select name="autovalente" class="w-full border rounded px-3 py-2" required>
                            <option value="1" {{ old('autovalente', $data['autovalente'] ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('autovalente', $data['autovalente'] ?? '') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="test_barber" class="block font-semibold mb-2">Test Barber</label>
                        <input type="text" name="test_barber" value="{{ old('test_barber', $data['test_barber'] ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="test_barthel" class="block font-semibold mb-2">Test Barthel</label>
                        <input type="text" name="test_barthel" value="{{ old('test_barthel', $data['test_barthel'] ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold">¿Frágil?</label>
                        <select name="fragil" class="w-full border rounded px-3 py-2" required>
                            <option value="0" {{ old('fragil', $data['fragil'] ?? '') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('fragil', $data['fragil'] ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="test_lawton_brody" class="block font-semibold mb-2">Test Lawton-Brody</label>
                        <input type="text" name="test_lawton_brody" value="{{ old('test_lawton_brody', $data['test_lawton_brody'] ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="test_katz" class="block font-semibold mb-2">Test Katz</label>
                        <input type="text" name="test_katz" value="{{ old('test_katz', $data['test_katz'] ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Fechas por servicio --}}
                    <h2 class="text-center text-xl font-semibold mb-4">VALORACIÓN GERIÁTRICA INTEGRAL</h2>

                    @foreach ([
                        'enfermeria', 'medicina', 'nutricion',
                        'psicologia', 'servicio_social', 'visita_domiciliaria'
                    ] as $servicio)
                        <div class="mb-4">
                            <label for="fecha_{{ $servicio }}" class="block font-semibold mb-2">
                                Fecha {{ ucfirst(str_replace('_', ' ', $servicio)) }}
                            </label>
                            <input type="date" name="fecha_{{ $servicio }}" 
                                value="{{ old('fecha_'.$servicio, $data['fecha_'.$servicio] ?? '') }}"
                                class="w-full border rounded px-3 py-2">
                        </div>
                    @endforeach

                    {{-- Botones --}}
                    <div class="flex justify-between mt-6">
                        <a href="{{ isset($adulto_id) && $adulto_id ? route('wizard.paso5', ['adulto_id' => $adulto_id]) : route('wizard.paso5') }}" 
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
</x-app-layout>
