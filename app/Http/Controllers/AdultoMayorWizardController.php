<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdultoMayor;
use Illuminate\Support\Facades\DB;


class AdultoMayorWizardController extends Controller
{
    public function paso1() {
        $data = session('adulto_mayor', []);
        return view('wizard.paso1',compact('data'));
    }

    public function guardarPaso1(Request $request) {
        $validated = $request->validate([
            'numero_ficha' => 'required|string',
            'ipress' => 'required|string',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dni' => 'required|digits:8',
            'telefono' => 'nullable|digits:9',
            'fecha_nacimiento' => 'required|date|before:today',
            'fecha_ingreso' => 'required|date',
            'alergias' => 'nullable|string',
            'adulto_mayor_fragil' => 'nullable|string|max:200',
            ]);
            
            session(['adulto_mayor' => $validated]);
            //dd(session('adulto_mayor'));  --> para ver la sesión actual
            return redirect()->route('wizard.paso2');
    }

    public function paso2() {
        $data = session('enfermedad', []);
        return view('wizard.paso2', compact('data'));
    }

    public function guardarPaso2(Request $request) {
        $validated = $request->validate([
            'otros' => 'nullable|string|max:500',
            'visare_numero' => 'nullable|integer',
            'visare_fecha' => 'nullable|date',
            'estadio_1a_3a_numero' => 'nullable|integer',
            'estadio_1a_3a_fecha' => 'nullable|date',
            'estadio_3b_5_numero' => 'nullable|integer',
            'estadio_3b_5_fecha' => 'nullable|date',
        ]);

        foreach ([
            'obesidad', 'dislipidemia', 'hipertension_arterial',
            'diabetes_mellitus', 'erc', 'osteoartrosis',
            'asma', 'epoc', 'itg', 'sindrome_metabolico'
        ] as $field) {
            $validated[$field] = $request->has($field);
        }

            session(['enfermedad' => $validated]);
            return redirect()->route('wizard.paso3');
    }

    public function paso3() {
        $data = session('riesgo', []);
        return view('wizard.paso3',compact('data'));
    }

    public function guardarPaso3(Request $request) {

            $booleanFields = [
            'sobrepeso', 'alcohol', 'sedentarismo',
            'estres', 'tabaco', 'bajo_peso',
            'perimetro_abdominal_aumentado', 'hdl_bajo'
        ];
        foreach ($booleanFields as $field) {
            $validated[$field] = $request->has($field);
        }
        session(['riesgo' => $validated]);
        return redirect()->route('wizard.paso4');

    }
    public function paso4()
    {
        $evaluacion = session('evaluacion', []);
        $actividad = session('actividad', []);
        return view('wizard.paso4', compact('evaluacion', 'actividad'));
    }

    public function guardarPaso4(Request $request)
    {
        $validated = $request->validate([
            'talla' => 'required|numeric',
            'peso_aceptable' => 'required|numeric',

            'evaluaciones' => 'required|array',

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


        return redirect()->route('wizard.paso5');
    }


    public function paso5()
    {
        $citas = session('citas_tratamientos.citas', []);
        $tratamientos = session('citas_tratamientos.tratamientos', []);
        return view('wizard.paso5', compact('citas', 'tratamientos'));

    }

    public function guardarPaso5(Request $request)
    {
        $validated = $request->validate([
            // Validación de múltiples citas
            'citas' => 'array',
            'citas.*.fecha' => 'nullable|date',
            'citas.*.medico' => 'nullable|string|max:100',
            'citas.*.enfermera' => 'nullable|string|max:100',

            // Validación de múltiples tratamientos
            'tratamientos' => 'array',
            'tratamientos.*.medicacion' => 'nullable|string|max:100',
            'tratamientos.*.dosis' => 'nullable|numeric|min:0',
        ]);

        session([
            'citas_tratamientos' => [
                'citas' => $validated['citas'] ?? [],
                'tratamientos' => $validated['tratamientos'] ?? [],
            ]
        ]);
        return redirect()->route('wizard.paso6');
    }


    public function paso6()
    {
        $data = session('valoracion', []);
        return view('wizard.paso6', compact('data'));
    }

    public function guardarPaso6(Request $request)
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

        return redirect()->route('wizard.confirmar');
    }


    public function confirmar()
    {
        return view('wizard.confirmar', [
            'paso1' => session('adulto_mayor', []),
            'paso2' => session('enfermedad', []),
            'paso3' => session('riesgo', []),
            'evaluacion' => session('evaluacion', []),
            'actividad' => session('actividad', []),
            'paso5' => session('citas_tratamientos', []),
            'paso6' => session('valoracion', []),
        ]);
    }


    public function finalizar()
    {
        if (!session()->has('adulto_mayor')) {
            return redirect()->route('wizard.paso1')->with('error', 'Sesión expirada. Inicia el registro nuevamente.');
        }

        DB::transaction(function () {
            $data = session('adulto_mayor');
            $enfermedad = session('enfermedad', []);
            $riesgo = session('riesgo', []);
            $evaluaciones = session('evaluacion', []);
            $actividades = session('actividad', []);
            $citasTratamientos = session('citas_tratamientos', ['citas' => [], 'tratamientos' => []]);
            $valoracion = session('valoracion');

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

            // Re-crear relaciones
            $adulto->enfermedad()->create($enfermedad);
            $adulto->riesgo()->create($riesgo);

            foreach ($evaluaciones as $eval) {
                $adulto->evaluaciones()->create($eval);
            }

            foreach ($actividades as $actividad) {
                $adulto->actividadesEducativas()->create($actividad);
            }

            foreach ($citasTratamientos['citas'] as $cita) {
                $adulto->citas()->create($cita);
            }

            foreach ($citasTratamientos['tratamientos'] as $tratamiento) {
                $adulto->tratamientos()->create($tratamiento);
            }

            $adulto->valoraciones()->create($valoracion);
        });

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

