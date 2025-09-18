<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resumen de Registro') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        @if (session()->has('adulto_id'))
            <div class="mb-6 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <strong>Modo Edición:</strong> Estás actualizando los datos de un adulto mayor registrado
                </div>
            </div>
            <h1 class="text-center text-2xl font-bold text-essalud-blue mb-8">Confirmar Actualización de Datos</h1>
        @else
            <h1 class="text-center text-2xl font-bold text-essalud-blue mb-8">Resumen de Nuevo Registro</h1>
        @endif

        @php
            $secciones = [
                'paso1' => 'Datos Personales',
                'paso2' => 'Enfermedades que Padece',
                'paso3' => 'Riesgos Identificados',
                'evaluacion' => 'Evaluación Médica',
                'actividad' => 'Asistencia a Actividades',
                'paso6' => 'Adulto Mayor de 75 Años a Más'
            ];

            // Función para generar estilos de estado
            function getEstiloEstado($estado) {
                return match($estado) {
                    'modificado' => ['fondo' => 'bg-yellow-50 border-yellow-200', 'clase' => 'bg-yellow-200 text-yellow-800', 'texto' => '🔄 Se Actualizará'],
                    'nuevo' => ['fondo' => 'bg-green-50 border-green-200', 'clase' => 'bg-green-200 text-green-800', 'texto' => '✨ Nuevo'],
                    default => ['fondo' => 'bg-white border-gray-200', 'clase' => '', 'texto' => '']
                };
            }
        @endphp

        @php
            if (isset($paso5['tratamientos'])) {
                $tratamientos = $paso5['tratamientos'];
                unset($paso5['tratamientos']);
            }

            if (isset($paso5['citas'])) {
                $citas = $paso5['citas'];
                unset($paso5['citas']);
            }
        @endphp

        {{-- Secciones dinámicas --}}
        @foreach ($secciones as $clave => $titulo)
            @php
                $ruta = $clave === 'actividad' || $clave === 'evaluacion' ? 'paso4' : $clave;
                $datos = $$clave ?? [];
                
                // Definir un orden a mostrar
                $ordenes = [
                    'paso2' => [
                        'obesidad', 'dislipidemia', 'hipertension_arterial',
                        'diabetes_mellitus', 'erc', 'osteoartrosis',
                        'asma', 'epoc', 'itg', 'sindrome_metabolico',
                        'visare_numero', 'visare_fecha', 
                        'estadio_1_3a_numero', 'estadio_1_3a_fecha',
                        'estadio_3b_5_numero', 'estadio_3b_5_fecha','otros'
                    ],
                    'evaluacion' => [
                        'peso', 'imc', 'presion_arterial', 'perimetro_abdominal',
                        'glucosa', 'hb_glicosilada', 'evaluacion_pie_dm', 
                        'test_morisky_green','vacuna_neumococo','vacuna_influenza',
                        'microalbuminuria','creatinina', 'tasa_albuminuria_creatinuria',
                        'tasa_filtracion_glomerular', 'control_renal_fecha'
                    ]
                ];
                
                // Función auxiliar para renderizar un campo individual
                $renderizarCampo = function($key, $value, $datosContext = null, $estado = null) {
                    $modoEdicion = session()->has('adulto_id');
                    $campoEditado = false;
                    
                    // Verificar si este campo específico ha sido modificado
                    if ($modoEdicion && $datosContext) {
                        if ($estado === 'modificado' && isset($datosContext['_changed_fields']) && in_array($key, $datosContext['_changed_fields'])) {
                            $campoEditado = true;
                        } elseif (!$estado && isset($datosContext['_changed_fields']) && in_array($key, $datosContext['_changed_fields'])) {
                            $campoEditado = true;
                        }
                    }
                    
                    $estiloCampo = $campoEditado ? 'bg-yellow-100 border border-yellow-300 rounded px-2 py-1' : '';
                    
                    echo '<div class="' . $estiloCampo . '">';
                    echo '<div class="flex items-center gap-2">';
                    echo '<strong>' . ucwords(str_replace('_', ' ', $key)) . ':</strong>';
                    echo '<span>' . (is_bool($value) ? ($value ? 'Sí' : 'No') : ($value ?? '—')) . '</span>';
                    if ($campoEditado) {
                        echo '<span class="text-xs bg-yellow-200 text-yellow-800 px-1 py-0.5 rounded"> </span>';
                    }
                    echo '</div>';
                    echo '</div>';
                };
                
                // Función auxiliar para aplicar ordenamiento
                $aplicarOrden = function($camposFuente, $claveBusqueda) use ($ordenes) {
                    $ordenActual = isset($ordenes[$claveBusqueda]) ? $ordenes[$claveBusqueda] : null;
                    $camposOrdenados = [];
                    
                    // Campos que se muestran por separado en evaluaciones
                    $camposGenerales = ['talla', 'peso_aceptable'];
                    
                    if ($ordenActual) {
                        // Primero agregar los campos en el orden especificado
                        foreach ($ordenActual as $campo) {
                            if (array_key_exists($campo, $camposFuente)) {
                                // Excluir campos generales de los registros individuales si es evaluación
                                if ($claveBusqueda === 'evaluacion' && in_array($campo, $camposGenerales)) {
                                    continue; // Saltar este campo
                                }
                                $camposOrdenados[$campo] = $camposFuente[$campo];
                            }
                        }
                        // Luego agregar cualquier campo restante que no esté en el orden
                        foreach ($camposFuente as $key => $value) {
                            if (!in_array($key, $ordenActual) && $key !== 'id' && !str_ends_with($key, '_id') && !str_starts_with($key, '_')) {
                                // Excluir campos generales también aquí
                                if ($claveBusqueda === 'evaluacion' && in_array($key, $camposGenerales)) {
                                    continue;
                                }
                                $camposOrdenados[$key] = $value;
                            }
                        }
                    } else {
                        $camposOrdenados = $camposFuente;
                    }
                    
                    return $camposOrdenados;
                };
            @endphp

            <div class="mb-8 border border-gray-200 rounded p-4 bg-gray-50">
                @php
                    $modoEdicion = session()->has('adulto_id');
                    $hayCambios = false;
                    
                    // Detectar si esta sección tiene cambios
                    if ($modoEdicion && isset($datos['_modified'])) {
                        $hayCambios = $datos['_modified'];
                    }
                    
                    $fondoEtiqueta = '';
                    $claseEtiqueta = '';
                    $textoEtiqueta = '';
                    
                    if ($hayCambios) {
                        $fondoEtiqueta = 'bg-yellow-50 border-yellow-200';
                        $claseEtiqueta = 'bg-yellow-200 text-yellow-800';
                        $textoEtiqueta = '🔄 Se Actualizará';
                    } else {
                        $fondoEtiqueta = 'bg-gray-50 border-gray-200';
                    }
                @endphp
                <div class="mb-8 border rounded p-4 {{ $fondoEtiqueta }}">
                    <div class="flex justify-between items-center mb-3">
                        <div class="flex items-center gap-3">
                            <h3 class="text-lg font-semibold text-essalud-blue">{{ $titulo }}</h3>
                            @if ($hayCambios)
                                <span class="px-2 py-1 text-xs rounded-full {{ $claseEtiqueta }}">
                                    {{ $textoEtiqueta }}
                                </span>
                            @endif
                        </div>
                        <a href="{{ route('wizard.' . $ruta) }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                    </div>

                @if (is_array($datos))
                    @if (isset($datos[0]) && is_array($datos[0]))
                        {{-- Sección especial para datos generales de evaluación --}}
                        @if ($clave === 'evaluacion' && !empty($datos))
                            @php
                                $datosGenerales = $datos[0]; // Tomar del primer registro
                                $camposGenerales = ['talla', 'peso_aceptable'];
                                $tieneGenerales = false;
                                foreach ($camposGenerales as $campo) {
                                    if (isset($datosGenerales[$campo])) {
                                        $tieneGenerales = true;
                                        break;
                                    }
                                }
                            @endphp
                            
                            @if ($tieneGenerales)
                                <div class="mb-4 p-3 border border-gray-200 rounded bg-white">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                                        @foreach ($camposGenerales as $campo)
                                            @if (isset($datosGenerales[$campo]))
                                                @php
                                                    $renderizarCampo($campo, $datosGenerales[$campo], $datosGenerales);
                                                @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                        
                        {{-- Múltiples registros (evaluaciones, actividades) --}}
                        @foreach ($datos as $index => $item)
                            @php
                                $modoEdicion = session()->has('adulto_id');
                                $estado = null;
                                
                                if ($modoEdicion) {
                                    if (isset($item['_new']) && $item['_new']) {
                                        $estado = 'nuevo';
                                    } elseif (isset($item['_modified']) && $item['_modified']) {
                                        $estado = 'modificado';
                                    } else {
                                        $estado = null; // Sin cambios detectados (registro existente sin modificar)
                                    }
                                } else {
                                    $estado = null; // Modo creación, no mostrar estados
                                }
                                
                                $estilos = getEstiloEstado($estado);
                            @endphp
                            <div class="mb-4 p-3 border rounded {{ $estilos['fondo'] }}">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="text-sm font-semibold text-gray-700">Registro {{ $index + 1 }}</h4>
                                    @if ($estado)
                                        <span class="text-xs px-2 py-1 {{ $estilos['clase'] }} rounded font-medium">{{ $estilos['texto'] }}</span>
                                    @endif
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                                    @php
                                        // Aplicar ordenamiento usando la función auxiliar compartida
                                        $camposOrdenados = $aplicarOrden($item, $clave);
                                    @endphp
                                    
                                    @foreach ($camposOrdenados as $key => $value)
                                        @if ($key !== 'id' && !str_ends_with($key, '_id') && !str_starts_with($key, '_'))
                                            @php
                                                $renderizarCampo($key, $value, $item, $estado);
                                            @endphp
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            @php
                                // Aplicar ordenamiento usando la función auxiliar compartida
                                $camposOrdenados = $aplicarOrden($datos, $clave);
                            @endphp
                            
                            @foreach ($camposOrdenados as $key => $value)
                                @if ($key !== 'id' && !str_ends_with($key, '_id') && !str_starts_with($key, '_'))
                                    @php
                                        $renderizarCampo($key, $value, $datos);
                                    @endphp
                                @endif
                            @endforeach
                        </div>
                    @endif
                @else
                    <p class="text-gray-500">Sin datos registrados.</p>
                @endif
                </div>
            </div>
        @endforeach

        {{-- Tratamientos --}}
        @if (!empty($tratamientos))
            <div class="mb-8 border border-gray-200 rounded p-4 bg-gray-50">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-essalud-blue">Tratamientos</h3>
                    <a href="{{ route('wizard.paso5') }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                </div>

                @foreach ($tratamientos as $i => $tratamiento)
                    @php
                        $modoEdicion = session()->has('adulto_id');
                        $estado = null;
                        
                        if ($modoEdicion) {
                            if (isset($tratamiento['_new']) && $tratamiento['_new']) {
                                $estado = 'nuevo';
                            } elseif (isset($tratamiento['_modified']) && $tratamiento['_modified']) {
                                $estado = 'modificado';
                            } else {
                                $estado = null; // Sin cambios detectados (registro existente sin modificar)
                            }
                        } else {
                            $estado = null; // Modo creación, no mostrar estados
                        }
                        
                        $estilos = getEstiloEstado($estado);
                    @endphp
                    <div class="mb-4 p-3 border rounded {{ $estilos['fondo'] }}">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="text-sm font-semibold text-gray-700">Tratamiento {{ $i + 1 }}</h4>
                            @if ($estado)
                                <span class="text-xs px-2 py-1 {{ $estilos['clase'] }} rounded font-medium">{{ $estilos['texto'] }}</span>
                            @endif
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            @foreach ($tratamiento as $campo => $valor)
                                @if ($campo !== 'id' && !str_ends_with($campo, '_id') && !str_starts_with($campo, '_'))
                                    <div>
                                        <strong>{{ ucwords(str_replace('_', ' ', $campo)) }}:</strong>
                                        {{ $valor }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Citas --}}
        @if (!empty($citas))
            <div class="mb-8 border border-gray-200 rounded p-4 bg-gray-50">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-essalud-blue">Citas</h3>
                    <a href="{{ route('wizard.paso5') }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                </div>

                @foreach ($citas as $i => $cita)
                    @php
                        $modoEdicion = session()->has('adulto_id');
                        $estado = null;
                        
                        if ($modoEdicion) {
                            if (isset($cita['_new']) && $cita['_new']) {
                                $estado = 'nuevo';
                            } elseif (isset($cita['_modified']) && $cita['_modified']) {
                                $estado = 'modificado';
                            } else {
                                $estado = null; // Sin cambios detectados (registro existente sin modificar)
                            }
                        } else {
                            $estado = null; // Modo creación, no mostrar estados
                        }
                        
                        $estilos = getEstiloEstado($estado);
                    @endphp
                    <div class="mb-4 p-3 border rounded {{ $estilos['fondo'] }}">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="text-sm font-semibold text-gray-700">Cita {{ $i + 1 }}</h4>
                            @if ($estado)
                                <span class="text-xs px-2 py-1 {{ $estilos['clase'] }} rounded font-medium">{{ $estilos['texto'] }}</span>
                            @endif
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            @foreach ($cita as $campo => $valor)
                                @if ($campo !== 'id' && !str_ends_with($campo, '_id') && !str_starts_with($campo, '_'))
                                    <div>
                                        <strong>{{ ucwords(str_replace('_', ' ', $campo)) }}:</strong>
                                        {{ $valor }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Botones --}}
        <form action="{{ isset($adulto_id) && $adulto_id ? route('wizard.finalizar', ['adulto_id' => $adulto_id]) : route('wizard.finalizar') }}" method="POST" class="mt-10 flex justify-between">
            @csrf
            <a href="{{ isset($adulto_id) && $adulto_id ? route('wizard.paso6', ['adulto_id' => $adulto_id]) : route('wizard.paso6') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Atrás</a>
            @if (session()->has('adulto_id'))
                <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                    </svg>
                    Actualizar Datos
                </button>
            @else
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Finalizar Registro
                </button>
            @endif
        </form>
    </div>
</x-app-layout>