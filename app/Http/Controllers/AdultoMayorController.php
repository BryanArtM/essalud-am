<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdultoMayor;

class AdultoMayorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $adultos = AdultoMayor::all();
            return view('adultos.index', compact('adultos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adultos.create');

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    
{

    $validated = $request->validate([
        'ipress' => 'required|string|max:100',
        'numero_ficha' => 'required|string|max:50',
        'dni' => 'required|digits:8|unique:adultos,dni',
        'nombres' => 'required|string|max:100',
        'apellidos' => 'required|string|max:100',
        'fecha_ingreso' => 'nullable|date|before:today',
        'alergias' => 'nullable|string|max:200',
        'adulto_mayor_fragil' => 'nullable|string|max:200',
        'fecha_nacimiento' => 'required|date|before:today',
        'telefono' => 'nullable|digits:9',
    ]);

    $nombreCompleto = $validated['nombres'] . ' ' . $validated['apellidos'];

    AdultoMayor::create([
        'ipress' => $validated['ipress'],
        'numero_ficha' => $validated['numero_ficha'],
        'nombre' => $nombreCompleto,
        'dni' => $validated['dni'],
        'telefono' => $validated['telefono'] ?? null,
        'fecha_ingreso' => $validated['fecha_ingreso'] ?? null,
        'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
        'alergias' => $validated['alergias'] ?? null,
        'adulto_mayor_fragil' => $validated['adulto_mayor_fragil'] ?? null,
    ]);


    return redirect()->route('adultos.index')->with('success', 'Adulto mayor registrado correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
