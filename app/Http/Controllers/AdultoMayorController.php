<?php

namespace App\Http\Controllers;
use App\Models\Enfermedad;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use App\Models\AdultoMayor;

class AdultoMayorController extends Controller
{
    public function index(Request $request)
    {
        $adultos = AdultoMayor::all();
        //Validación de los campos de búsqueda
        $request->  validate([
            'dni' => 'nullable|string|regex:/^[0-9]{1,8}$/',
            'apellidos' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
        ], [
            'dni.regex' => 'El DNI debe contener solo números (máximo 8 dígitos).',
            'email.email' => 'El email debe tener un formato válido.',
        ]);

        //Filtrado
        $query = AdultoMayor::query();
        if ($request->filled('dni')) {
            $query->where('dni', 'like', $request->dni . '%');
        }
        if ($request->filled('apellidos')) {
            $query->where('apellidos', 'like', '%' . $request->apellidos . '%');
        }
        //Paginación
        $adultos = $query->paginate(10)->withQueryString();
        return view('adultos.index', compact('adultos'));
    }
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


    public function store(Request $request)
    {
    }
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

    public function edit(AdultoMayor $adulto)
    {
        // Limpiar la sesión de datos previos antes de cargar los nuevos
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
                'direccion',
                'email',
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

        return redirect()->route('wizard.paso1', ['adulto_id' => $adulto->id])->with('success', 'Datos cargados para edición.');
    }
    public function update(Request $request, string $id)
    {

    }

    public function destroy($id)
    {
        $adulto = AdultoMayor::findOrFail($id);
        $adulto->delete();
        return redirect()->route('adultos.index')->with('success', 'Adulto mayor eliminado correctamente.');

    }

    public function generatePDF($id)
    {
        // Obtener el adulto mayor con todas sus relaciones
        $adulto = AdultoMayor::with([
            'enfermedad',
            'riesgo',
            'evaluaciones' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(15);
            },
            'actividadesEducativas' => function ($query) {
                $query->orderBy('fecha', 'desc')->limit(15);
            },
            'tratamientos' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(10);
            },
            'citas' => function ($query) {
                $query->orderBy('fecha', 'desc')->limit(10);
            },
            'valoraciones' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }
        ])->findOrFail($id);


        // Reordenar las colecciones para mostrar de izquierda a derecha (más antiguo al más reciente)
        $adulto->evaluaciones = $adulto->evaluaciones->sortBy('created_at')->values();
        $adulto->actividadesEducativas = $adulto->actividadesEducativas->sortBy('fecha')->values();
        $adulto->tratamientos = $adulto->tratamientos->sortBy('created_at')->values();
        $adulto->citas = $adulto->citas->sortBy('fecha')->values();

        $fechaNacimiento = \Carbon\Carbon::parse($adulto->fecha_nacimiento);
        $edad = $fechaNacimiento->age;

        // Datos para la vista
        $data = [
            'adulto' => $adulto,
            'edad' => $edad,
            'fecha_generacion' => now()->timezone('America/Lima')->format('d/m/Y H:i:s')
        ];

        // Generar PDF
        $pdf = Pdf::loadView('adultos.pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        // Nombre del archivo
        $filename = 'Ficha_' . str_replace(' ', '_', $adulto->nombres . '_' . $adulto->apellidos) . '_' . now()->format('Y-m-d') . '.pdf';

        // Siempre mostrar en el navegador para imprimir
        return $pdf->stream($filename);
    }

}
