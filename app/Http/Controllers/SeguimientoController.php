<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimiento;
use App\Models\Tratamiento;
use App\Models\Paciente;
use App\Models\Especialidade;
use Barryvdh\DomPDF\Facade\Pdf;

class SeguimientoController extends Controller
{
    // Mostrar los tratamientos con los 3 últimos seguimientos
    public function index()
    {
        // Obtener los tratamientos con los tres últimos seguimientos ordenados por fecha descendente
        $tratamientos = Tratamiento::with(['seguimiento' => function($query) {
            $query->latest('fecha_seguimiento')->limit(3); // Solo traer los 3 últimos
        }])->get();
    
        return view('tratamientos.index', compact('tratamientos'));
    }
    

    // Guardar un nuevo seguimiento
    public function store(Request $request)
    {
        $request->validate([
            'tratamiento_id' => 'required|exists:tratamientos,id',
            'seguimiento' => 'required|string',
            'estado' => 'required|in:Pendiente,Concluido,Cancelado',
        ]);

        // Crear un nuevo seguimiento
        Seguimiento::create([
            'tratamiento_id' => $request->tratamiento_id,
            'seguimiento' => $request->seguimiento,
            'estado' => $request->estado,
            'fecha_seguimiento' => now(), // Fecha actual
        ]);

        // Redirigir hacia la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Seguimiento agregado correctamente.');
    }

    // Si deseas editar un seguimiento (opcional)
    public function edit($id)
    {
        $seguimiento = Seguimiento::findOrFail($id);
        return view('seguimientos.edit', compact('seguimiento'));
    }

    // Actualizar un seguimiento
    public function update(Request $request, $id)
    {
        $request->validate([
            'seguimiento' => 'required|string',
            'estado' => 'required|in:Pendiente,Concluido,Cancelado',
        ]);

        $seguimiento = Seguimiento::findOrFail($id);
        $seguimiento->update([
            'seguimiento' => $request->seguimiento,
            'estado' => $request->estado,
            'fecha_seguimiento' => now(), // Actualizamos la fecha de seguimiento
        ]);

        return redirect()->back()->with('success', 'Seguimiento actualizado correctamente.');
    }

    // Eliminar un seguimiento (opcional)
    public function destroy($id)
    {
        $seguimiento = Seguimiento::findOrFail($id);
        $seguimiento->delete();

        return redirect()->back()->with('success', 'Seguimiento eliminado correctamente.');
    }



   
    public function generarReporte($pacientes_id)
{
    // Obtener el paciente
    $paciente = Paciente::findOrFail($pacientes_id);

    $especialidade = Especialidade::pluck('descripcion','id');


    // Obtener los tratamientos del paciente con sus seguimientos y especialidades (si es necesario)
    $tratamientos = Tratamiento::with(['seguimiento', 'especialidade']) // Asegúrate de que la relación 'especialidad' esté definida
        ->where('pacientes_id', $pacientes_id) // Asegúrate de usar el nombre correcto de la columna
        ->get()
        ->map(function ($tratamiento) {
            $tratamiento->seguimiento = $tratamiento->seguimiento->sortBy('fecha_seguimiento');
            return $tratamiento;
        });

    // Verificar si hay tratamientos
    if ($tratamientos->isEmpty()) {
        // Si no se encuentran tratamientos, podrías manejarlo de otra forma
        return back()->with('error', 'No se encontraron tratamientos para este paciente');
    }

    // Generar el PDF pasando los datos a la vista
    $pdf = PDF::loadView('reportes.seguimientos', compact('paciente', 'tratamientos'))
        ->setPaper('a4', 'portrait'); // Puedes ajustar el tamaño de la página si lo necesitas

    // Descargar el PDF
    return $pdf->stream('reporte_seguimientos.pdf'); 
    
    // Si deseas redirigir a otra página después de generar el PDF:
    // return redirect()->route('nombre.de.la.ruta'); 
}

    
    

}
