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
        $request->validate([
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
        return redirect()->route('wizard.paso1');
    }


    public function store(Request $request) {}
    public function show($id)
    {
        $adulto = AdultoMayor::with([
            'ipressEntidad',
            'enfermedad',
            'riesgo',
            'evaluaciones',
            'actividadesEducativas',
            'tratamientos',
            'citas',
            'valoracion',
            'createdBy',
            'updatedBy'
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
                'ipress_id',
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
        if ($enfermedad) {
            $enfermedadData = $enfermedad->toArray();
            unset($enfermedadData['created_by'], $enfermedadData['updated_by'], $enfermedadData['id'], $enfermedadData['adulto_mayor_id']);
            session(['enfermedad' => $enfermedadData]);
        } else {
            session(['enfermedad' => []]);
        }

        $riesgo = $adulto->riesgo->first();
        if ($riesgo) {
            $riesgoData = $riesgo->toArray();
            unset($riesgoData['created_by'], $riesgoData['updated_by'], $riesgoData['id'], $riesgoData['adulto_mayor_id']);
            session(['riesgo' => $riesgoData]);
        } else {
            session(['riesgo' => []]);
        }

        // Limpiar campos de auditoría de evaluaciones
        $evaluacionesData = $adulto->evaluaciones->map(function ($eval) {
            $data = $eval->toArray();
            unset($data['created_by'], $data['updated_by'], $data['adulto_mayor_id']);
            return $data;
        })->toArray();
        session(['evaluacion' => $evaluacionesData]);

        // Limpiar campos de auditoría de actividades
        $actividadesData = $adulto->actividadesEducativas->map(function ($act) {
            $data = $act->toArray();
            unset($data['created_by'], $data['updated_by'], $data['adulto_mayor_id']);
            return $data;
        })->toArray();
        session(['actividad' => $actividadesData]);

        // Limpiar campos de auditoría de citas y tratamientos
        $tratamientosData = $adulto->tratamientos->map(function ($trat) {
            $data = $trat->toArray();
            unset($data['created_by'], $data['updated_by'], $data['adulto_mayor_id']);
            return $data;
        })->toArray();

        $citasData = $adulto->citas->map(function ($cita) {
            $data = $cita->toArray();
            unset($data['created_by'], $data['updated_by'], $data['adulto_mayor_id']);
            return $data;
        })->toArray();

        session([
            'citas_tratamientos' => [
                'tratamientos' => $tratamientosData,
                'citas' => $citasData,
            ]
        ]);

        $valoracion = $adulto->valoracion;
        if ($valoracion) {
            $valoracionData = $valoracion->toArray();
            unset($valoracionData['created_by'], $valoracionData['updated_by'], $valoracionData['id'], $valoracionData['adulto_mayor_id']);
            session(['valoracion' => $valoracionData]);
        } else {
            session(['valoracion' => []]);
        }

        return redirect()->route('wizard.paso1', ['adulto_id' => $adulto->id])->with('success', 'Datos cargados para edición.');
    }
    public function update(Request $request, string $id) {}

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
            'ipressEntidad',
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
            'valoracion'
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
