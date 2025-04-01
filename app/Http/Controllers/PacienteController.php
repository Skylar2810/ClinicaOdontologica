<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Sexo;
use App\Models\Estado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PacienteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $busqueda = $request->input('busqueda');

    // Filtrar por nombre, CI o correo
    $pacientes = Paciente::when($busqueda, function ($query, $busqueda) {
        return $query->where('nombres', 'LIKE', "%{$busqueda}%")
                     ->orWhere('ci', 'LIKE', "%{$busqueda}%")
                     ->orWhere('correo', 'LIKE', "%{$busqueda}%");
    })
    ->orderBy('nombres', 'asc')
    ->paginate(10);

    // Si es una petición AJAX, solo devuelve la tabla
    if ($request->ajax()) {
        return view('paciente.tabla', compact('pacientes'))->render();
    }

    return view('paciente.index', compact('pacientes'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $paciente = new Paciente();
        $sexos = Sexo::pluck('descripcion','id');
        $estados = Estado::pluck('descripcion','id');

        return view('paciente.create', compact('paciente','sexos','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PacienteRequest $request): RedirectResponse
    {
        // Crear el paciente
        $paciente = Paciente::create($request->validated());
    
        // Verificar si el usuario ya existe en la tabla 'users'
        $existeUsuario = User::where('name', $paciente->nombres)->exists();
    
        if ($existeUsuario) {
            return back()->with('error', 'El usuario ya ha sido creado.');
        }
    
        // Crear el usuario con el nombre del paciente y su CI como contraseña
        $user = User::create([
            'name' => $paciente->nombres, // Nombre como usuario
            'email' => $paciente->nombres ?? null, // Si el paciente tiene correo, lo guarda
            'password' => Hash::make($paciente->ci), // Encripta la contraseña
        ]);

        $user->assignRole('Paciente');
    
        // Redirigir con éxito
        return Redirect::route('pacientes.index')->with('success', 'Paciente y usuario creados correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $paciente = Paciente::find($id);
        $sexos = Sexo::pluck('descripcion','id');
        $estados = Estado::pluck('descripcion','id');

        return view('paciente.show', compact('paciente','sexos','estados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $paciente = Paciente::find($id);
        $sexos = Sexo::pluck('descripcion','id');
        $estados = Estado::pluck('descripcion','id');

        return view('paciente.edit', compact('paciente','sexos','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PacienteRequest $request, Paciente $paciente): RedirectResponse
    {
        $paciente->update($request->validated());

        return Redirect::route('pacientes.index')
            ->with('success', 'Paciente updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Paciente::find($id)->delete();

        return Redirect::route('pacientes.index')
            ->with('success', 'Paciente deleted successfully');
    }
}
