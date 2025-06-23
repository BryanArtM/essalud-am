<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdultoMayor;


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
        $data = session('enfermedades', []);
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

            session(['enfermedades' => $validated]);
            return redirect()->route('wizard.paso3');
    }

    public function paso3() {
        $data = session('riesgos', []);
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
        session(['riesgos' => $validated]);
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
            'fecha' => 'required|date',
            'peso' => 'nullable|numeric',
            'presion_arterial' => 'nullable|string|max:20',
            'glucosa' => 'nullable|numeric',
            'hb_glicosilada' => 'nullable|numeric',
            'imc' => 'nullable|numeric',
            'perimetro_abdominal' => 'nullable|numeric',
            'evaluacion_pie_dm' => 'nullable|string|max:100',
            'test_morisky_green' => 'nullable|in:cumple,no cumple',
            'microalbuminuria' => 'nullable|numeric',
            'creatinina' => 'nullable|numeric',
            'tasa_albuminuria_creatinuria' => 'nullable|numeric',
            'tasa_filtracion_glomerular' => 'nullable|numeric',
            'control_renal_fecha' => 'nullable|date',
            'actividad_fecha' => 'nullable|date',
            'numero_sesion' => 'nullable|string|max:50',
        ]);

        $validated['vacuna_influenza'] = $request->has('vacuna_influenza');
        $validated['vacuna_neumococo'] = $request->has('vacuna_neumococo');

        // sesion evaluacion
        $evaluacion = collect($validated)->except(['actividad_fecha', 'numero_sesion'])->toArray();
        //sesion actividad
        $actividad = [
            'fecha' => $request->input('actividad_fecha'),
            'numero_sesion' => $request->input('numero_sesion'),
        ];

        session(['evaluacion' => $evaluacion]);
        session(['actividad' => $actividad]);


        return redirect()->route('wizard.paso5');
    }

    public function paso5()
    {
        $data = session('citas_tratamientos', []);
        return view('wizard.paso5', compact('data'));
    }

    public function guardarPaso5(Request $request)
    {
        $validated = $request->validate([
            // Cita
            'cita_fecha' => 'nullable|date',
            'medico' => 'nullable|string|max:100',
            'enfermera' => 'nullable|string|max:100',
            // Tratamiento
            'medicacion' => 'nullable|string|max:255',
            'dosis' => 'nullable|string|max:100',
        ]);

        session(['citas_tratamientos' => $validated]);

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
            'paso1' => session('adulto_mayor'),
            'paso2' => session('enfermedades'),
            'paso3' => session('riesgos'),
            'evaluacion' => session('evaluacion'),
            'actividad' => session('actividad'),
            'paso5' => session('citas_tratamientos'),
            'paso6' => session('valoracion'),
        ]);
    }

    public function finalizar()
    {
        $adulto = AdultoMayor::create(session('adulto_mayor'));
        $adulto->enfermedad()->create(session('enfermedades'));
        $adulto->riesgo()->create(session('riesgos'));
        $adulto->evaluaciones()->create(session('evaluacion'));
        $adulto->actividadesEducativas()->create(session('actividad'));

        $data = session('citas_tratamientos');
        $citaData = [
            'fecha' => $data['cita_fecha'],
            'medico' => $data['medico'],
            'enfermera' => $data['enfermera'],
        ];
        $tratamientoData = [
            'medicacion' => $data['medicacion'],
            'dosis' => $data['dosis'],
        ];
        $adulto->citas()->create($citaData);
        $adulto->tratamientos()->create($tratamientoData);

        $adulto->valoraciones()->create(session('valoracion'));

        session()->forget([
            'adulto_mayor',
            'enfermedades',
            'riesgos',
            'evaluacion',
            'actividad',
            'citas_tratamientos',
            'valoracion',
        ]);

        return redirect()->route('adultos.index')->with('success', 'Registro completado.');
    }

}

