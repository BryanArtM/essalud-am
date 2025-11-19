<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
class UserController extends Controller
{
    public function __construct()
    {
        // Solo el administrador puede entrar
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->is_admin == 1) {
                return $next($request);
            }
            abort(403, 'Acceso denegado');
        });
    }

    public function index(Request $request)
    {
        // Validación básica para filtros
        $request->validate([
            'name' => 'nullable|string|max:100',
        ]);

        //Filtrado
        $query = User::where('id', '!=', 1); 

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        //Paginación   
        $users = $query->paginate(10)->appends($request->all());
        return view('admin.partials.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.partials.users.create');
    }
    public function store(Request $request)
    {
        //Validación de datos
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[\w\.-]+@gmail\.com$/'
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
            'role' => [
                'required',
                'in:user,admin',
            ],
        ]);

        //Convertir el rol a valor booleano para is_admin
        $is_admin = $request->role === 'admin' ? 1 : 0;

        //Crear el profesional en la base de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $is_admin,
        ]);

        return redirect()->route('users.index')->with('success', 'Profesional creado correctamente');
    }

    public function show(User $user)
    {
        return view('admin.partials.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.partials.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ],
            'email' => [
                'required',
                'email',
                "unique:users,email,{$user->id}",
                'regex:/^[\w\.-]+@gmail\.com$/'
            ],
            'password' => [
                'nullable',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
            'role' => [
                'required',
                'in:user,admin',
            ],
        ]);

        //Convertir el rol a valor booleano para is_admin
        $is_admin = $request->role === 'admin' ? 1 : 0;

        //Actualizar el profesional en la base de datos
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'is_admin' => $is_admin,
        ]);

        return redirect()->route('users.index')->with('success', 'Profesional actualizado correctamente');
    }

    public function destroy(User $user)
    {
        //El profesional no puede eliminar su propia cuenta desde el listado
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propio perfil');
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Profesional eliminado correctamente');
    }

    /**
     * Limpiar diferentes tipos de caché
     */
    public function clearCache($type)
    {
        try {
            $message = '';
            
            switch ($type) {
                case 'application':
                    Artisan::call('cache:clear');
                    $message = 'Caché de aplicación limpiado correctamente';
                    break;
                    
                case 'config':
                    Artisan::call('config:clear');
                    $message = 'Caché de configuración limpiado correctamente';
                    break;
                    
                case 'route':
                    Artisan::call('route:clear');
                    $message = 'Caché de rutas limpiado correctamente';
                    break;
                    
                case 'view':
                    Artisan::call('view:clear');
                    $message = 'Caché de vistas limpiado correctamente';
                    break;
                    
                default:
                    return redirect()->route('admin.index', ['tab' => 'configuracion'])
                        ->with('cache_error', 'Tipo de caché no válido');
            }
            
            return redirect()->route('admin.index', ['tab' => 'configuracion'])
                ->with('cache_success', $message);
                
        } catch (\Exception $e) {
            return redirect()->route('admin.index', ['tab' => 'configuracion'])
                ->with('cache_error', 'Error al limpiar caché: ' . $e->getMessage());
        }
    }

    /**
     * Optimizar la aplicación
     */
    public function optimizeApp()
    {
        try {
            if (config('app.env') === 'production') {
                // En producción: limpiar y luego optimizar (cachear todo)
                Artisan::call('optimize:clear'); // Limpia todo
                Artisan::call('optimize'); // Cachea config, routes, views, events
                
                $message = 'Aplicación optimizada para producción. Se limpiaron y cachearon config, rutas, vistas y eventos.';
            } else {
                // En desarrollo: solo limpiar (no cachear para evitar problemas con closures)
                Artisan::call('cache:clear');
                Artisan::call('view:clear');
                
                $message = 'Caché limpiado correctamente (cache + vistas).';
            }
            
            return redirect()->route('admin.index', ['tab' => 'configuracion'])
                ->with('cache_success', $message);
                
        } catch (\Exception $e) {
            return redirect()->route('admin.index', ['tab' => 'configuracion'])
                ->with('cache_error', 'Error al optimizar aplicación: ' . $e->getMessage());
        }
    }
}
