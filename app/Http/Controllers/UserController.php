<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');
        
        // Si el usuario es Admin, podemos mostrar todos los usuarios, si no, solo el que corresponde.
        if (Auth::user()->hasRole('Admin')) {
            $usuarios = User::with('roles')
                ->when($busqueda, function ($query, $busqueda) {
                    return $query->where('name', 'LIKE', '%' . $busqueda . '%')
                                 ->orWhere('email', 'LIKE', '%' . $busqueda . '%');
                })
                ->paginate(10);
        } else {
            // Si el usuario no es Admin, mostramos su propio perfil.
            $usuarios = User::with('roles')
                ->where('id', Auth::user()->id)
                ->paginate(10);
        }

        return view('usuarios.index', compact('usuarios'));
    }

  


        public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
           
        ]);

        // Retornar el usuario creado como JSON para actualizar la vista
        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Show the details of the specified user.
     */
    public function show($id)
    {
        return redirect()->route('usuarios.index');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        
        // Obtenemos todos los roles disponibles
        $roles = \Spatie\Permission\Models\Role::all(); 
    
        // Pasamos los roles y el usuario a la vista
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        // Encontrar al usuario por ID
        $usuario = User::findOrFail($id);
    
        // Validar la entrada para asegurarnos de que se ha seleccionado un rol válido
        $request->validate([
            'role' => 'required|in:Admin,Paciente', // Asegurarse de que el rol sea válido
        ]);
    
        // Actualizar el rol del usuario usando syncRoles()
        $usuario->syncRoles($request->input('role')); // Aquí actualizas el rol seleccionado
    
        // Actualizar otros datos del usuario (si es necesario)
        $usuario->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    
        // Redirigir con mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
{
    $usuario = User::findOrFail($id);

    // Asegurar que no se elimine un administrador si no se quiere
    if ($usuario->hasRole('admin')) {
        return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar un administrador.');
    }

    $usuario->delete();

    return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
}
}
