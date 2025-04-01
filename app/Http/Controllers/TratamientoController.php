<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TratamientoRequest;
use App\Models\Especialidade;
use App\Models\Paciente;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $busqueda = $request->input('busqueda');

    // Filtrar por nombre, CI o correo
    $pacientes = Paciente::when($busqueda, function ($query, $busqueda) {
        return $query->where('nombres', 'LIKE', "%{$busqueda}%");
    })
    ->orderBy('nombres', 'asc')
    ->paginate(10);

    // Si es una petición AJAX, solo devuelve la tabla
    if ($request->ajax()) {
        return view('tratamiento.table', compact('pacientes'))->render();
    }

    return view('tratamiento.index', compact('pacientes'));
}


    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tratamiento = new Tratamiento();
        $pacientes = Paciente::orderBy('nombres', 'asc')->pluck('nombres','id');
        $especialidades = Especialidade::pluck('descripcion','id');

        return view('tratamiento.create', compact('tratamiento','pacientes','especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'fecha' => 'required|date',
        'pieza' => 'required|string|max:255',
        'especialidades_id' => 'required|exists:especialidades,id',
        'presupuesto' => 'required|numeric',
        'pacientes_id' => 'required|exists:pacientes,id',
    ]);

    Tratamiento::create([
        'fecha' => $request->fecha,
        'pieza' => $request->pieza,
        'especialidades_id' => $request->especialidades_id,
        'presupuesto' => $request->presupuesto,
        'pacientes_id' => $request->pacientes_id,
    ]);

    return redirect()->route('tratamientos.show', $request->pacientes_id)->with('success', 'Tratamiento creado con éxito');
}
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id): View
    {
        
        // Obtener el valor del parámetro 'busnombre' para filtrar tratamientos (búsqueda exacta)
        $busnombre = $request->input('busnombre');

        // 1. Obtener el paciente
        $paciente = Paciente::findOrFail($id);
        $tratamientos = $paciente->tratamientos; // Obtener tratamientos del paciente
        $especialidades = Especialidade::all()->pluck('descripcion', 'id'); // Obtener todas las especialidades

        // 2. Consultar los tratamientos asociados al paciente
        $tratamientosQuery = Tratamiento::where('pacientes_id', $id);
        
        if (!empty($busnombre)) {
            // Si hay un nombre, filtrar los tratamientos por nombre
            $tratamientosQuery->where('pieza', 'like', '%' . $busnombre . '%'); // Filtrar por "pieza" o el campo que necesites
        }

        // Paginación de los tratamientos (10 por página)
        $tratamientos = $tratamientosQuery->paginate(10);

        // 3. Retornar la vista con los datos
        return view('tratamiento.show', compact('paciente', 'tratamientos', 'especialidades'))
            ->with('i', ($request->input('page', 1) - 1) * $tratamientos->perPage());
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tratamiento = Tratamiento::find($id);

        return view('tratamiento.edit', compact('tratamiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TratamientoRequest $request, Tratamiento $tratamiento): RedirectResponse
    {
        $tratamiento->update($request->validated());

        return Redirect::route('tratamientos.index')
            ->with('success', 'Tratamiento updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Tratamiento::find($id)->delete();

        return Redirect::route('tratamientos.index')
            ->with('success', 'Tratamiento deleted successfully');
    }
}
