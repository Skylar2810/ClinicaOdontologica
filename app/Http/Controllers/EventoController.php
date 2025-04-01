<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Paciente;
use App\Models\Especialidade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EventoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Muestra la vista principal con el formulario y los datos necesarios.
     */
    public function index(Request $request): View
    {
        $evento = new Evento(); // Evento vacío para el formulario
        $pacientes = Paciente::pluck('nombres', 'id');
        $especialidades = Especialidade::pluck('descripcion', 'id');
        $eventos = Evento::all(); // Obtener todos los eventos
    
        return view('evento.index', compact('evento', 'pacientes', 'especialidades', 'eventos'));
    }

    /**
     * Almacena un nuevo evento en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'              => 'required|string|max:255',
            'hora'               => 'required|string|max:5', // Cambiar según el formato de la hora
            'pacientes_id'       => 'required|exists:pacientes,id',
            'especialidades_id'  => 'required|exists:especialidades,id',
            'descripcion'        => 'nullable|string',
            'color'              => 'nullable|string',
            'fecha'              => 'required|date_format:Y-m-d', // Validar el formato de la fecha
        ]);

        // Convertir la fecha al formato correcto (YYYY-MM-DD HH:MM:SS)
        $fechaFormatoCorrecto = date('Y-m-d H:i:s', strtotime($request->fecha . ' ' . $request->hora));

        Evento::create([
            'title'              => $request->title,
            'hora'               => $request->hora,
            'pacientes_id'       => $request->pacientes_id,
            'especialidades_id'  => $request->especialidades_id,
            'descripcion'        => $request->descripcion,
            'color'              => $request->color ?? '#007bff', // Color por defecto si no se da uno
            'fecha'              => $fechaFormatoCorrecto, // Fecha en formato compatible con MySQL
        ]);

        return response()->json(['mensaje' => 'Evento creado exitosamente']);
    }

    /**
     * Retorna los eventos en formato JSON para que FullCalendar los consuma.
     */
  
        public function show()
        {
            // Cargar eventos con la relación del paciente
            $eventos = Evento::with('paciente')->get()->map(function($evento) {
                return [
                    'id'    => $evento->id,
                    'title' => $evento->title . ' - ' . ($evento->paciente->nombres ?? 'Sin paciente'), // Nombre del paciente
                    'start' => $evento->fecha . 'T' . $evento->hora,
                    'fecha' => \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d'), 
                    'hora' => \Carbon\Carbon::parse($evento->hora)->format('H:i'), // Formato hora:minutos
                    'paciente' => $evento->paciente->nombres,
                    'especialidade' => $evento->especialidade->descripcion,
                    'descripcion' => $evento->descripcion,
                    'color' => $evento->color ?? '#007bff', // Si no hay color, usa azul por defecto
                ];
            });
    
            return response()->json($eventos);
        }


    /**
     * Actualiza el evento especificado en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id); // Busca el evento
    
        $evento->update([
            'title'             => $request->title,
            'hora'              => $request->hora,
            'pacientes_id'      => $request->pacientes_id,
            'especialidades_id' => $request->especialidades_id,
            'descripcion'       => $request->descripcion,
            'color'             => $request->color,
            'fecha'             => date('Y-m-d H:i:s', strtotime($request->fecha)), // Convierte la fecha al formato correcto
        ]);
    
        return response()->json(["mensaje" => "Evento actualizado correctamente"]);
    }

    /**
     * Elimina el evento especificado.
     */
    public function eliminar($eventoId)
    {
        $evento = Evento::find($eventoId);

    if ($evento) {
        $evento->delete();
        return response()->json(['success' => 'Evento eliminado correctamente']);
    }

    return response()->json(['error' => 'Evento no encontrado'], 404);
    }

    /**
     * Pospone el evento especificado cambiando su fecha y hora.
     */
    public function posponer(Request $request, $id)
    {
        // Validación de la fecha y la hora
        $request->validate([
            'fecha' => 'required|date_format:Y-m-d', // Formato de la fecha: 'Y-m-d'
            'hora'  => 'required|date_format:H:i',   // Formato de la hora: 'H:i' (24 horas)
        ]);
    
        // Buscar el evento por su ID
        $evento = Evento::findOrFail($id);
    
        // Convertir la fecha y la hora a un formato compatible con MySQL (YYYY-MM-DD HH:MM:SS)
        $fechaFormatoCorrecto = date('Y-m-d H:i:s', strtotime($request->fecha . ' ' . $request->hora));
    
        // Actualizar los campos del evento
        $evento->fecha = $fechaFormatoCorrecto; // Actualizar la fecha y hora combinadas
        $evento->hora = $request->hora; // Solo actualizamos la hora por separado si es necesario
    
        // Guardar los cambios en la base de datos
        $evento->save();
    
        // Retornar una respuesta JSON
        return response()->json(["mensaje" => "Evento pospuesto correctamente"]);
    }

    // EventoController.php

    public function mostrarCitas()
{
    // Si el usuario tiene el rol de Admin
    if (Auth::user()->hasRole('Admin')) {
        // El Admin puede ver todas las citas de todos los pacientes
        $eventos = Evento::with('paciente') // Relación de eventos con pacientes
                         ->orderBy('fecha')  // Ordenar por fecha de la cita
                         ->paginate(10);  // Paginación
    } else {
        // Si es paciente, solo verá sus propias citas
        $eventos = Evento::with('paciente')  // Relación de eventos con pacientes
                         ->whereHas('paciente', function ($query) {
                             // Filtra por el nombre del paciente, que es el nombre de usuario
                             $query->where('nombres', 'LIKE', '%' . Auth::user()->name . '%');
                         })
                         ->orderBy('fecha')  // Cambia fecha_original por fecha
                         ->paginate(10);
    }

    // Retorna la vista con las citas obtenidas
    return view('evento.citas', compact('eventos'));
}


    
}
