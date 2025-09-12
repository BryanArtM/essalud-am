<?php

namespace App\Http\Controllers;
use App\Models\Enfermedad;

use Illuminate\Http\Request;
use App\Models\AdultoMayor;

class AdultoMayorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $adultos = AdultoMayor::all();

        $request->validate([
            'dni' => 'nullable|string|regex:/^[0-9]{1,8}$/',
            'apellidos' => 'nullable|string|max:100',
        ], [
            'dni.regex' => 'El DNI debe contener solo números (máximo 8 dígitos).',
        ]);

        $query = AdultoMayor::query();

        if ($request->filled('dni')) {
            $query->where('dni', 'like',$request->dni . '%');
        }
        if ($request->filled('apellidos')) {
            $query->where('apellidos', 'like', '%' . $request->apellidos . '%');
        }
        $adultos = $query->paginate(10)->withQueryString();
        return view('adultos.index', compact('adultos'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        session()->forget([
            'adulto_id',
            'adulto_mayor',
            'enfermedad',
            'riesgo',
            'evaluacion',
            'actividad',
            'citas_tratamientos',
            'valoracion'
        ]);
        return view('wizard.paso1');

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $adulto = AdultoMayor::with([
            'enfermedad',
            'riesgo',
            'evaluaciones',
            'actividadeseducativas',
            'tratamientos',
            'citas',
            'valoraciones'
        ])->findOrFail($id);

        return view('adultos.show', compact('adulto'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdultoMayor $adulto)
    {
        session(['adulto_id' => $adulto->id]);

        session([
            'adulto_mayor' => $adulto->only([
                'ipress',
                'numero_ficha',
                'dni',
                'apellidos',
                'nombres',
                'fecha_nacimiento',
                'telefono',
                'fecha_ingreso',
                'alergias',
                'adulto_mayor_fragil'
            ])
        ]);

        $enfermedad = $adulto->enfermedad->first();
        session(['enfermedad' => $enfermedad ? $enfermedad->toArray() : []]);

        $riesgo = $adulto->riesgo->first();
        session(['riesgo' => $riesgo ? $riesgo->toArray() : []]);

        session(['evaluacion' => $adulto->evaluaciones->toArray()]);
        session(['actividad' => $adulto->actividadesEducativas->toArray()]);

        session([
            'citas_tratamientos' => [
                'tratamientos' => $adulto->tratamientos->toArray(),
                'citas' => $adulto->citas->toArray(),
            ]
        ]);

        $valoracion = $adulto->valoraciones->first();
        session(['valoracion' => $valoracion ? $valoracion->toArray() : []]);

        return redirect()->route('wizard.paso1')->with('success', 'Datos cargados para edición.');
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $adulto = AdultoMayor::findOrFail($id);
        $adulto->delete();
        return redirect()->route('adultos.index')->with('success', 'Adulto mayor eliminado correctamente.');

    }

}
