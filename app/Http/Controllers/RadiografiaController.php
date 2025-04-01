<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radiografia;
use App\Models\Paciente;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class RadiografiaController extends Controller
{
    // Mostrar todas las radiografías de un paciente
    public function index($paciente_id)
    {
        $paciente = Paciente::findOrFail($paciente_id);
        $radiografias = Radiografia::where('paciente_id', $paciente_id)->get();
        return view('radiografias.index', compact('paciente', 'radiografias'));
    }

    // Subir nuevas radiografías
    public function store(Request $request)
    {
        $request->validate([
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('radiografias', 'public');  // 'public' es el disco que se usa para almacenamiento público
                // Aquí puedes guardar el nombre de la imagen en la base de datos
                Radiografia::create([
                    'paciente_id' => $request->paciente_id,
                    'imagen' => basename($path),  // Guarda solo el nombre del archivo
                    'descripcion' => $request->descripcion
                ]);
            }
            return back()->with('success', 'Radiografía subida correctamente');
        }
    
        return back()->with('error', 'No se ha seleccionado ninguna imagen.');
    }
    


    // Eliminar una radiografía
    public function destroy(Radiografia $radiografia)
    {
        // Eliminar la imagen de almacenamiento
        Storage::disk('public')->delete('radiografias/' . $radiografia->imagen);
        
        // Eliminar el registro de la base de datos
        $radiografia->delete();

        // Redirigir de vuelta con mensaje de éxito
        return redirect()->back()->with('success', 'Radiografía eliminada.');
    }

    // Generar un PDF con las radiografías del paciente
    public function generarPDF($paciente_id)
    {
        // Obtener paciente y sus radiografías
        $paciente = Paciente::findOrFail($paciente_id);
        $radiografias = Radiografia::where('paciente_id', $paciente_id)->get();

        // Generar el PDF usando una vista
        $pdf = Pdf::loadView('radiografias.pdf', compact('paciente', 'radiografias'));
        
        // Devolver el PDF para visualizarlo directamente en el navegador
        return $pdf->stream('radiografias_'.$paciente->nombres.'.pdf');
    }
}
