<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
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

        //Crear el usuario en la base de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $is_admin,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
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

        //Actualizar el usuario en la base de datos
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'is_admin' => $is_admin,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        //El usuario no puede eliminar su propia cuenta desde el listado
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propio usuario');
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
