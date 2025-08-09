<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riesgos identificados') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg p-6">

                @if (session()->has('adulto_id'))
                    <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded shadow">
                        <strong>Modo edición:</strong> Estás modificando los datos de un adulto mayor registrado.
                    </div>
                @endif

                <form action="{{ route('wizard.paso3') }}" method="POST">
                    @csrf

                    @foreach ([
                        'sobrepeso' => 'Sobrepeso',
                        'sedentarismo' => 'Sedentarismo',
                        'tabaco' => 'Tabaco',
                        'alcohol' => 'Alcohol',
                        'estres' => 'Estrés',
                        'bajo_peso' => 'Bajo Peso',
                        'perimetro_abdominal_aumentado' => 'Perímetro Abdominal Aumentado: Mujer >= 88 cm, Hombre >= 102 cm',
                        'hdl_bajo' => 'HDL Bajo: Mujer < 50 mg/dL, Hombre < 40 mg/dL'
                    ] as $name => $label)
                        <div class="mb-3">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="{{ $name }}" value="1"
                                    {{ old($name, $data[$name] ?? false) ? 'checked' : '' }}
                                    class="form-checkbox text-blue-600">
                                <span class="ml-2">{{ $label }}</span>
                            </label>
                        </div>
                    @endforeach

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('wizard.paso2') }}" 
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
