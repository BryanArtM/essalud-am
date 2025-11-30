<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdultoMayor;
use Illuminate\Support\Facades\DB;


class AdultoMayorWizardController extends Controller
{
    public function paso1($adulto_id = null)
    {
        // Si tenemos adulto_id (modo edición), cargar datos directamente de la base de datos
        if ($adulto_id) {
            // Verificar si ya hay datos en sesión (usuario navegando entre pasos)
            $sessionAdultoMayor = session('adulto_mayor', []);
            $sessionAdultoId = session('adulto_id');

            if (!empty($sessionAdultoMayor) && $sessionAdultoId == $adulto_id) {
                // Ya hay datos de este adulto en sesión, usar esos (preservar cambios)
                $data = $sessionAdultoMayor;
            } else {
                // Primera vez editando o diferente adulto, cargar desde BD
                $adulto = AdultoMayor::findOrFail($adulto_id);
                $data = $adulto->only([
                    'ipress',
                    'numero_ficha',
                    'dni',
                    'apellidos',
                    'nombres',
                    'fecha_nacimiento',
                    'telefono',
                    'direccion',
                    'email',
                    'fecha_ingreso',
                    'alergias',
                    'adulto_mayor_fragil'
                ]);

                // Actualizar la sesión con los datos correctos
                session(['adulto_mayor' => $data]);
                session(['adulto_id' => $adulto_id]);
            }
        } else {
            // Modo nuevo registro, usar datos de sesión
            $data = session('adulto_mayor', []);
        }

        return view('wizard.paso1', compact('data', 'adulto_id'));
    }

    public function guardarPaso1(Request $request, $adulto_id = null)
    {
        $validated = $request->validate([
            'numero_ficha' => 'nullable|string',
            'ipress' => 'nullable|string',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dni' => 'required|digits:8|unique:adultos_mayores,dni' . ($adulto_id ? ',' . $adulto_id : ''),
            'telefono' => 'nullable|digits:9',
            'direccion' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'fecha_ingreso' => 'nullable|date',
            'alergias' => 'nullable|string',
            'adulto_mayor_fragil' => 'nullable|string|regex:/^[0-9]*$/|max:20',
        ]);

        session(['adulto_mayor' => $validated]);

        if ($adulto_id) {
            return redirect()->route('wizard.paso2', ['adulto_id' => $adulto_id]);
        }
        return redirect()->route('wizard.paso2');
    }

    public function paso2($adulto_id = null)
    {
        // Si tenemos adulto_id (modo edición)
        if ($adulto_id) {
            // Verificar si los datos en sesión corresponden al usuario actual
            $sessionData = session('enfermedad', []);
            $sessionAdultoId = session('adulto_id');

            // Cargar desde BD si:
            // 1. No hay datos en sesión, O
            // 2. El adulto_id de sesión no coincide con el actual, O  
            // 3. Los datos en sesión pertenecen a otro usuario
            $shouldLoadFromDB = empty($sessionData) ||
                $sessionAdultoId != $adulto_id ||
                (isset($sessionData['adulto_mayor_id']) && $sessionData['adulto_mayor_id'] != $adulto_id);

            if ($shouldLoadFromDB) {
                $adulto = AdultoMayor::findOrFail($adulto_id);

                // Consulta explícita para asegurar que obtenemos los datos correctos
                $enfermedad = \App\Models\Enfermedad::where('adulto_mayor_id', $adulto_id)->first();
                $data = $enfermedad ? $enfermedad->toArray() : [];

                // Actualizar la sesión con los datos correctos
                session(['enfermedad' => $data]);
                session(['adulto_id' => $adulto_id]);
            } else {
                // Usar datos de sesión existentes (ya modificados por el usuario)
                $data = $sessionData;
            }
        } else {
            // Modo nuevo registro, usar datos de sesión
            $data = session('enfermedad', []);
        }

        return view('wizard.paso2', compact('data', 'adulto_id'));
    }

    public function guardarPaso2(Request $request, $adulto_id = null)
    {
        $validated = $request->validate([
            'otros' => 'nullable|string|max:500',
            'visare_numero' => 'nullable|integer',
            'visare_fecha' => 'nullable|date',
            'estadio_1_3a_numero' => 'nullable|integer',
            'estadio_1_3a_fecha' => 'nullable|date',
            'estadio_3b_5_numero' => 'nullable|integer',
            'estadio_3b_5_fecha' => 'nullable|date',
        ]);

        //Recorrido de los campos booleanos
        foreach ([
            'obesidad',
            'dislipidemia',
            'hipertension_arterial',
            'diabetes_mellitus',
            'erc',
            'osteoartrosis',
            'asma',
            'epoc',
            'itg',
            'sindrome_metabolico'
        ] as $field) {
            $validated[$field] = $request->has($field);
        }

        session(['enfermedad' => $validated]);

        if ($adulto_id) {
            return redirect()->route('wizard.paso3', ['adulto_id' => $adulto_id]);
        }
        return redirect()->route('wizard.paso3');
    }

    public function paso3($adulto_id = null)
    {
        // Si tenemos adulto_id (modo edición)
        if ($adulto_id) {
            // Verificar si los datos en sesión corresponden al usuario actual
            $sessionData = session('riesgo', []);
            $sessionAdultoId = session('adulto_id');

            // Cargar desde BD si:
            // 1. No hay datos en sesión, O
            // 2. El adulto_id de sesión no coincide con el actual, O  
            // 3. Los datos en sesión pertenecen a otro usuario
            $shouldLoadFromDB = empty($sessionData) ||
                $sessionAdultoId != $adulto_id ||
                (isset($sessionData['adulto_mayor_id']) && $sessionData['adulto_mayor_id'] != $adulto_id);

            if ($shouldLoadFromDB) {
                $adulto = AdultoMayor::findOrFail($adulto_id);

                // Consulta explícita para asegurar que obtenemos los datos correctos
                $riesgo = \App\Models\Riesgo::where('adulto_mayor_id', $adulto_id)->first();
                $data = $riesgo ? $riesgo->toArray() : [];

                // Actualizar la sesión con los datos correctos
                session(['riesgo' => $data]);
                session(['adulto_id' => $adulto_id]);
            } else {
                // Usar datos de sesión existentes (ya modificados por el usuario)
                $data = $sessionData;
            }
        } else {
            // Modo nuevo registro, usar datos de sesión
            $data = session('riesgo', []);
        }

        return view('wizard.paso3', compact('data', 'adulto_id'));
    }

    public function guardarPaso3(Request $request, $adulto_id = null)
    {

        $booleanFields = [
            'sobrepeso',
            'alcohol',
            'sedentarismo',
            'estres',
            'tabaco',
            'bajo_peso',
            'perimetro_abdominal_aumentado',
            'hdl_bajo'
        ];
        foreach ($booleanFields as $field) {
            $validated[$field] = $request->has($field);
        }
        session(['riesgo' => $validated]);

        if ($adulto_id) {
            return redirect()->route('wizard.paso4', ['adulto_id' => $adulto_id]);
        }
        return redirect()->route('wizard.paso4');

    }
    public function paso4($adulto_id = null)
    {
        $evaluacion = session('evaluacion', []);
        $actividad = session('actividad', []);
        return view('wizard.paso4', compact('evaluacion', 'actividad', 'adulto_id'));
    }

    public function guardarPaso4(Request $request, $adulto_id = null)
    {
        $validated = $request->validate([
            'talla' => 'nullable|numeric',
            'peso_aceptable' => 'nullable|numeric',
            //Validación de registros de evaluaciones
            'evaluaciones' => 'nullable|array',
            'evaluaciones.*.peso' => 'nullable|numeric',
            'evaluaciones.*.presion_arterial' => 'nullable|string|max:20',
            'evaluaciones.*.glucosa' => 'nullable|numeric',
            'evaluaciones.*.hb_glicosilada' => 'nullable|numeric',
            'evaluaciones.*.imc' => 'nullable|numeric',
            'evaluaciones.*.perimetro_abdominal' => 'nullable|numeric',
            'evaluaciones.*.evaluacion_pie_dm' => 'nullable|string|max:100',
            'evaluaciones.*.test_morisky_green' => 'nullable|in:cumple,no cumple',
            'evaluaciones.*.microalbuminuria' => 'nullable|numeric',
            'evaluaciones.*.creatinina' => 'nullable|numeric',
            'evaluaciones.*.tasa_albuminuria_creatinuria' => 'nullable|numeric',
            'evaluaciones.*.tasa_filtracion_glomerular' => 'nullable|numeric',
            'evaluaciones.*.control_renal_fecha' => 'nullable|date',
            'evaluaciones.*.vacuna_influenza' => 'nullable|boolean',
            'evaluaciones.*.vacuna_neumococo' => 'nullable|boolean',
            //Validación de registros de actividades
            'actividades' => 'nullable|array',
            'actividades.*.fecha' => 'nullable|date',
            'actividades.*.numero_sesion' => 'nullable|string|max:50',
        ]);

        // Procesar campos booleanos (checkboxes) en evaluaciones
        $evaluaciones = $request->input('evaluaciones', []);
        foreach ($evaluaciones as &$eval) {
            $eval['vacuna_influenza'] = !empty($eval['vacuna_influenza']);
            $eval['vacuna_neumococo'] = !empty($eval['vacuna_neumococo']);
            $eval['peso_aceptable'] = $request->input('peso_aceptable');
            $eval['talla'] = $request->input('talla');
        }

        $actividades = $request->input('actividades', []);

        session(['evaluacion' => $evaluaciones]);
        session(['actividad' => $request->input('actividades', [])]);

        if ($adulto_id) {
            return redirect()->route('wizard.paso5', ['adulto_id' => $adulto_id]);
        }
        return redirect()->route('wizard.paso5');
    }


    public function paso5($adulto_id = null)
    {
        $citas = session('citas_tratamientos.citas', []);
        $tratamientos = session('citas_tratamientos.tratamientos', []);
        return view('wizard.paso5', compact('citas', 'tratamientos', 'adulto_id'));

    }

    public function guardarPaso5(Request $request, $adulto_id = null)
    {
        $validated = $request->validate([
            //Validación de registros de citas
            'citas' => 'nullable|array',
            'citas.*.id' => 'nullable|integer|exists:citas,id',
            'citas.*.fecha' => 'nullable|date',
            'citas.*.medico' => 'nullable|string|max:100',
            'citas.*.enfermera' => 'nullable|string|max:100',

            //Validación de registros de tratamientos
            'tratamientos' => 'nullable|array',
            'tratamientos.*.id' => 'nullable|integer|exists:tratamientos,id',
            'tratamientos.*.medicacion' => 'nullable|string|max:100',
            'tratamientos.*.dosis' => 'nullable|string|max:100',
        ]);

        session([
            'citas_tratamientos' => [
                'citas' => $validated['citas'] ?? [],
                'tratamientos' => $validated['tratamientos'] ?? [],
            ]
        ]);

        if ($adulto_id) {
            return redirect()->route('wizard.paso6', ['adulto_id' => $adulto_id]);
        }
        return redirect()->route('wizard.paso6');
    }


    public function paso6($adulto_id = null)
    {
        $data = session('valoracion', []);
        return view('wizard.paso6', compact('data', 'adulto_id'));
    }

    public function guardarPaso6(Request $request, $adulto_id = null)
    {
        $validated = $request->validate([
            'autovalente' => 'required|in:0,1',
            'test_barber' => 'nullable|string|max:100',
            'test_barthel' => 'nullable|string|max:100',
            'fragil' => 'required|in:0,1',
            'test_lawton_brody' => 'nullable|string|max:100',
            'test_katz' => 'nullable|string|max:100',
            'fecha_enfermeria' => 'nullable|date',
            'fecha_medicina' => 'nullable|date',
            'fecha_nutricion' => 'nullable|date',
            'fecha_psicologia' => 'nullable|date',
            'fecha_servicio_social' => 'nullable|date',
            'fecha_visita_domiciliaria' => 'nullable|date',
        ]);

        session(['valoracion' => $validated]);

        if ($adulto_id) {
            return redirect()->route('wizard.confirmar', ['adulto_id' => $adulto_id]);
        }
        return redirect()->route('wizard.confirmar');
    }


    public function confirmar($adulto_id = null)
    {
        $data = [
            'paso1' => session('adulto_mayor', []),
            'paso2' => session('enfermedad', []),
            'paso3' => session('riesgo', []),
            'evaluacion' => session('evaluacion', []),
            'actividad' => session('actividad', []),
            'paso5' => session('citas_tratamientos', []),
            'paso6' => session('valoracion', []),
        ];

        // Si estamos en modo edición, detectar cambios
        if (session()->has('adulto_id')) {
            $adultoId = session('adulto_id');
            $adulto = AdultoMayor::findOrFail($adultoId);

            // Detectar cambios en datos personales (Paso 1)
            $datosPersonales = session('adulto_mayor', []);
            $datosActuales = $adulto->only(array_keys($datosPersonales));
            $tieneCambios = false;
            $camposModificados = [];

            foreach ($datosPersonales as $field => $value) {
                if ($datosActuales[$field] != $value) {
                    $tieneCambios = true;
                    $camposModificados[] = $field;
                }
            }

            $data['paso1']['_modified'] = $tieneCambios;
            $data['paso1']['_changed_fields'] = $camposModificados;

            // Detectar cambios en enfermedad (Paso 2)
            $enfermedad = session('enfermedad', []);
            if (!empty($enfermedad)) {
                // Usar consulta explícita en lugar de relación problemática
                $existingEnfermedad = \App\Models\Enfermedad::where('adulto_mayor_id', $adultoId)->first();
                if ($existingEnfermedad) {
                    $tieneCambios = false;
                    $camposModificados = [];
                    $camposAComparar = array_diff_key($enfermedad, ['id' => '', 'created_at' => '', 'updated_at' => '', 'adulto_mayor_id' => '']);

                    foreach ($camposAComparar as $field => $value) {
                        if ($existingEnfermedad->$field != $value) {
                            $tieneCambios = true;
                            $camposModificados[] = $field;
                        }
                    }

                    $data['paso2']['_modified'] = $tieneCambios;
                    $data['paso2']['_changed_fields'] = $camposModificados;
                } else {
                    $data['paso2']['_modified'] = true; // Es nuevo
                    $data['paso2']['_changed_fields'] = [];
                }
            }

            // Detectar cambios en riesgo (Paso 3)
            $riesgo = session('riesgo', []);
            if (!empty($riesgo)) {
                // Usar consulta explícita en lugar de relación problemática
                $existingRiesgo = \App\Models\Riesgo::where('adulto_mayor_id', $adultoId)->first();
                if ($existingRiesgo) {
                    $tieneCambios = false;
                    $camposModificados = [];
                    $camposAComparar = array_diff_key($riesgo, ['id' => '', 'created_at' => '', 'updated_at' => '', 'adulto_mayor_id' => '']);

                    foreach ($camposAComparar as $field => $value) {
                        if ($existingRiesgo->$field != $value) {
                            $tieneCambios = true;
                            $camposModificados[] = $field;
                        }
                    }

                    $data['paso3']['_modified'] = $tieneCambios;
                    $data['paso3']['_changed_fields'] = $camposModificados;
                } else {
                    $data['paso3']['_modified'] = true; // Es nuevo
                    $data['paso3']['_changed_fields'] = [];
                }
            }

            // Detectar cambios en valoración (Paso 6)
            $valoracion = session('valoracion', []);
            if (!empty($valoracion)) {
                $existingValoracion = $adulto->valoraciones->first();
                if ($existingValoracion) {
                    $tieneCambios = false;
                    $camposModificados = [];
                    $camposAComparar = array_diff_key($valoracion, ['id' => '', 'created_at' => '', 'updated_at' => '', 'adulto_mayor_id' => '']);

                    foreach ($camposAComparar as $field => $value) {
                        if ($existingValoracion->$field != $value) {
                            $tieneCambios = true;
                            $camposModificados[] = $field;
                        }
                    }

                    $data['paso6']['_modified'] = $tieneCambios;
                    $data['paso6']['_changed_fields'] = $camposModificados;
                } else {
                    $data['paso6']['_modified'] = true; // Es nuevo
                    $data['paso6']['_changed_fields'] = [];
                }
            }

            // Detectar cambios en evaluaciones
            $evaluaciones = session('evaluacion', []);
            foreach ($evaluaciones as $index => $eval) {
                if (isset($eval['id']) && !empty($eval['id'])) {
                    // Registro existente, verificar si ha cambiado
                    $existingEval = $adulto->evaluaciones()->find($eval['id']);
                    if ($existingEval) {
                        $tieneCambios = false;
                        $camposModificados = [];
                        $camposAComparar = array_diff_key($eval, ['id' => '', 'created_at' => '', 'updated_at' => '', 'adulto_mayor_id' => '']);

                        foreach ($camposAComparar as $field => $value) {
                            if ($existingEval->$field != $value) {
                                $tieneCambios = true;
                                $camposModificados[] = $field;
                            }
                        }

                        $data['evaluacion'][$index]['_modified'] = $tieneCambios;
                        $data['evaluacion'][$index]['_changed_fields'] = $camposModificados;
                    } else {
                        // ID proporcionado pero registro no encontrado
                        $data['evaluacion'][$index]['_modified'] = false;
                        $data['evaluacion'][$index]['_changed_fields'] = [];
                    }
                } else {
                    // Sin ID, es un registro completamente nuevo
                    $data['evaluacion'][$index]['_new'] = true;
                    $data['evaluacion'][$index]['_changed_fields'] = [];
                }
            }

            // Detectar cambios en actividades
            $actividades = session('actividad', []);
            foreach ($actividades as $index => $actividad) {
                if (isset($actividad['id']) && !empty($actividad['id'])) {
                    // Registro existente, verificar si ha cambiado
                    $existingActividad = $adulto->actividadesEducativas()->find($actividad['id']);
                    if ($existingActividad) {
                        $tieneCambios = false;
                        $camposAComparar = array_diff_key($actividad, ['id' => '', 'created_at' => '', 'updated_at' => '', 'adulto_mayor_id' => '']);
                        foreach ($camposAComparar as $field => $value) {
                            if ($existingActividad->$field != $value) {
                                $tieneCambios = true;
                                break;
                            }
                        }
                        $data['actividad'][$index]['_modified'] = $tieneCambios;
                    } else {
                        // ID proporcionado pero registro no encontrado
                        $data['actividad'][$index]['_modified'] = false;
                    }
                } else {
                    // Sin ID, es un registro completamente nuevo
                    $data['actividad'][$index]['_new'] = true;
                }
            }

            // Detectar cambios en citas y tratamientos
            $citasTratamientos = session('citas_tratamientos', ['citas' => [], 'tratamientos' => []]);

            // Asegurar que las estructuras existan en $data
            if (!isset($data['paso5'])) {
                $data['paso5'] = ['citas' => [], 'tratamientos' => []];
            }
            if (!isset($data['paso5']['citas'])) {
                $data['paso5']['citas'] = [];
            }
            if (!isset($data['paso5']['tratamientos'])) {
                $data['paso5']['tratamientos'] = [];
            }

            // Detectar cambios en citas
            if (isset($citasTratamientos['citas'])) {
                foreach ($citasTratamientos['citas'] as $index => $cita) {
                    $data['paso5']['citas'][$index] = $cita; // Asegurar datos


                    if (isset($cita['id']) && !empty($cita['id'])) {
                        // Registro existente, verificar si ha cambiado
                        $existingCita = $adulto->citas()->find($cita['id']);

                        if ($existingCita) {
                            $tieneCambios = false;
                            $camposAComparar = array_diff_key($cita, ['id' => '', 'created_at' => '', 'updated_at' => '', 'adulto_mayor_id' => '']);
                            foreach ($camposAComparar as $field => $value) {
                                if ($existingCita->$field != $value) {
                                    $tieneCambios = true;
                                    break;
                                }
                            }
                            $data['paso5']['citas'][$index]['_modified'] = $tieneCambios;
                        } else {
                            // ID proporcionado pero registro no encontrado, probablemente eliminado
                            $data['paso5']['citas'][$index]['_modified'] = false;
                        }
                    } else {
                        // Sin ID, es un registro completamente nuevo
                        $data['paso5']['citas'][$index]['_new'] = true;
                    }
                }
            }

            // Detectar cambios en tratamientos
            if (isset($citasTratamientos['tratamientos'])) {
                foreach ($citasTratamientos['tratamientos'] as $index => $tratamiento) {
                    $data['paso5']['tratamientos'][$index] = $tratamiento; // Asegurar datos



                    if (isset($tratamiento['id']) && !empty($tratamiento['id'])) {
                        // Registro existente, verificar si ha cambiado
                        $existingTratamiento = $adulto->tratamientos()->find($tratamiento['id']);

                        if ($existingTratamiento) {
                            $tieneCambios = false;
                            $camposAComparar = array_diff_key($tratamiento, ['id' => '', 'created_at' => '', 'updated_at' => '', 'adulto_mayor_id' => '']);
                            foreach ($camposAComparar as $field => $value) {
                                if ($existingTratamiento->$field != $value) {
                                    $tieneCambios = true;
                                    break;
                                }
                            }
                            $data['paso5']['tratamientos'][$index]['_modified'] = $tieneCambios;
                        } else {
                            // ID proporcionado pero registro no encontrado, probablemente eliminado
                            $data['paso5']['tratamientos'][$index]['_modified'] = false;
                        }
                    } else {
                        // Sin ID, es un registro completamente nuevo
                        $data['paso5']['tratamientos'][$index]['_new'] = true;
                    }
                }
            }
        }

        $data['adulto_id'] = $adulto_id;
        return view('wizard.confirmar', $data);
    }


    public function finalizar($adulto_id = null)
    {
        if (!session()->has('adulto_mayor')) {
            return redirect()->route('wizard.paso1')->with('error', 'Sesión expirada. Inicia el registro nuevamente.');
        }
        //Transacción para evitar enviar datos incompletos
        DB::transaction(function () {
            $data = session('adulto_mayor');
            $enfermedad = session('enfermedad', []);
            $riesgo = session('riesgo', []);
            $evaluaciones = session('evaluacion', []);
            $actividades = session('actividad', []);
            $citasTratamientos = session('citas_tratamientos', ['citas' => [], 'tratamientos' => []]);
            $valoracion = session('valoracion');

            // Eliminar campos de auditoría de los datos (para que el boot() los maneje automáticamente)
            unset($data['created_by'], $data['updated_by']);
            unset($enfermedad['created_by'], $enfermedad['updated_by']);
            unset($riesgo['created_by'], $riesgo['updated_by']);
            unset($valoracion['created_by'], $valoracion['updated_by']);

            // Verifica si es edición o nuevo registro
            if (session()->has('adulto_id')) {
                $adulto = AdultoMayor::findOrFail(session('adulto_id'));
                $adulto->update($data);

                // Eliminar lo anterior
                $adulto->enfermedad()->delete();
                $adulto->riesgo()->delete();
                $adulto->evaluaciones()->delete();
                $adulto->actividadesEducativas()->delete();
                $adulto->tratamientos()->delete();
                $adulto->citas()->delete();
                $adulto->valoraciones()->delete();
            } else {
                $adulto = AdultoMayor::create($data);
            }

            // Re-crear relaciones (sin campos de auditoría para que boot() los maneje)
            $adulto->enfermedad()->create($enfermedad);
            $adulto->riesgo()->create($riesgo);
            
            foreach ($evaluaciones as $eval) {
                unset($eval['created_by'], $eval['updated_by']);
                $adulto->evaluaciones()->create($eval);
            }
            
            foreach ($actividades as $actividad) {
                unset($actividad['created_by'], $actividad['updated_by']);
                $adulto->actividadesEducativas()->create($actividad);
            }
            
            foreach ($citasTratamientos['citas'] as $cita) {
                unset($cita['created_by'], $cita['updated_by']);
                $adulto->citas()->create($cita);
            }
            
            foreach ($citasTratamientos['tratamientos'] as $tratamiento) {
                unset($tratamiento['created_by'], $tratamiento['updated_by']);
                $adulto->tratamientos()->create($tratamiento);
            }
            
            $adulto->valoraciones()->create($valoracion);
        });

        // Limpiar la sesión
        session()->forget([
            'adulto_mayor',
            'enfermedad',
            'riesgo',
            'evaluacion',
            'actividad',
            'citas_tratamientos',
            'valoracion',
            'adulto_id',
        ]);

        return redirect()->route('adultos.index')->with('success', 'Registro completado.');
    }
}

