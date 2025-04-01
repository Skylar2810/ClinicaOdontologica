@extends('layouts.app')

<!-- Incluimos FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let formulario = document.querySelector("#createEventoForm");
    let calendarEl = document.getElementById('calendar');

    let btnGuardar = document.getElementById("btnGuardar");
    let btnEliminar = document.getElementById("btnEliminar");
    let btnPosponer = document.getElementById("btnPosponer");
    let guardarPosponer = document.getElementById("guardarPosponer");

    let eventoId = null; // Variable para almacenar el ID del evento seleccionado

    if (!calendarEl) {
        console.error("Elemento del calendario no encontrado.");
        return;
    }

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        selectable: true, // Permitir selección de fechas
        editable: false,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: "http://127.0.0.1:8000/eventos/mostrar",  // Asegúrate de que esta URL sea correcta

        eventDidMount: function(info) {
            if (info.event.backgroundColor) {
                info.el.style.backgroundColor = info.event.backgroundColor; // Aplicar color de fondo
            }
            info.el.style.color = "black"; // Establecer texto negro
            info.el.style.padding = "10px";
            info.el.style.borderRadius = "5px"; // Opcional: bordes redondeados
        },

        dateClick: function(info) {
            eventoId = null; // Reiniciar eventoId para nuevos eventos
            document.getElementById("fecha").value = info.dateStr;
            formulario.reset();
            let modalCrear = new bootstrap.Modal(document.getElementById('evento'));
            modalCrear.show();
        },

        eventClick: function(info) {
            let evento = info.event;
            eventoId = evento.id; // Guardar el ID del evento seleccionado

            // Llenar los datos en el modal de ver cita
            document.getElementById("verTitulo").innerText = evento.title;
            document.getElementById("verHora").innerText = evento.extendedProps.hora;
            document.getElementById("verPaciente").innerText = evento.extendedProps.paciente;
            document.getElementById("verEspecialidad").innerText = evento.extendedProps.especialidade;
            document.getElementById("verDescripcion").innerText = evento.extendedProps.descripcion;
            document.getElementById("verFecha").innerText = evento.extendedProps.fecha;

            let modalVer = new bootstrap.Modal(document.getElementById('modalVerCita'));
            modalVer.show();
        }
    });

    calendar.render();

    // Guardar nuevo evento
    btnGuardar.addEventListener("click", function() {
        let datos = new FormData(formulario);

        // Evitar que se recargue la página si el formulario tiene un comportamiento por defecto
        event.preventDefault();

        fetch("http://127.0.0.1:8000/eventos/agregar", {
            method: "POST",
            body: datos,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
        .then(response => response.json()) // Obtener la respuesta en formato JSON
        .then(data => {
            console.log(data);  // Verificar la respuesta en la consola
            alert(data.mensaje);  // Mostrar el mensaje de éxito

            // Cerrar el modal
            $("#evento").modal("hide");

            // Refrescar los eventos en el calendario
            calendar.refetchEvents();
        })
        .catch(error => {
            console.error("Error al guardar evento:", error);
            alert("Hubo un error al guardar el evento.");
        });
    });

    // Eliminar evento
    btnEliminar.addEventListener("click", function() {
        if (!eventoId) {
            alert("No hay evento seleccionado para eliminar.");
            return;
        }

        if (!confirm("¿Estás seguro de eliminar este evento?")) return;

        fetch(`http://127.0.0.1:8000/eventos/eliminar/${eventoId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
        .then(response => response.json())
        .then(() => {
            $("#modalVerCita").modal("hide");
            calendar.refetchEvents();
        })
        .catch(error => console.error("Error al eliminar evento:", error));
    });

    // Abrir el modal de posponer cita
    btnPosponer.addEventListener("click", function() {
        let modalPosponer = new bootstrap.Modal(document.getElementById('modalPosponer'));
        modalPosponer.show();
    });

    // Guardar el evento pospuesto con nueva fecha y hora
    guardarPosponer.addEventListener("click", function() {
        let nuevaFecha = document.getElementById("nuevaFecha").value; // Capturar la nueva fecha
        let nuevaHora = document.getElementById("nuevaHora").value; // Capturar la nueva hora

        if (!nuevaFecha || !nuevaHora) {
            alert("Por favor, seleccione una nueva fecha y hora.");
            return;
        }

        // Realizar la solicitud PATCH para posponer el evento
        fetch(`/eventos/posponer/${eventoId}`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                fecha: nuevaFecha, // Enviar nueva fecha
                hora: nuevaHora    // Enviar nueva hora
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.mensaje) {
                // Mostrar mensaje si la respuesta es exitosa
                alert(data.mensaje);
                $("#modalPosponer").modal("hide"); // Cerrar el modal
                $("#modalVerCita").modal("hide");
                calendar.refetchEvents(); // Refrescar el calendario
            }
        })
        .catch(error => {
            console.error("Error al posponer evento:", error);
            alert("Hubo un error al intentar posponer el evento. Intente de nuevo.");
        });
    });
});


</script>


  


@section('template_title')
  Especialidades
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <span id="card_title">{{ __('Calendario') }}</span>
            </div>
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para crear/modificar/eliminar evento -->
  <div class="modal fade" id="evento" tabindex="-1" aria-labelledby="createEventoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Encabezado del Modal -->
        <div class="modal-header">
          <h5 class="modal-title" id="createEventoModalLabel">{{ __('Create') }} Evento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <!-- Cuerpo del Modal -->
        <div class="modal-body">
          <form method="POST" action="{{ route('eventos.store') }}" role="form" enctype="multipart/form-data" id="createEventoForm">
            {!! csrf_field() !!}
            <div class="row padding-1 p-1">
              <div class="col-md-12">
                <div class="form-group mb-2 mb20">
                  <label for="title" class="form-label">{{ __('Title') }}</label>
                  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                         value="{{ old('title', $evento?->title) }}" id="title" placeholder="Title">
                  {!! $errors->first('title', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="form-group mb-2 mb20">
                  <label for="hora" class="form-label">{{ __('Hora') }}</label>
                  <input type="time" name="hora" class="form-control @error('hora') is-invalid @enderror" 
                         value="{{ old('hora', $evento?->hora) }}" id="hora" placeholder="Hora">
                  {!! $errors->first('hora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="form-group mb-2 mb20">
                  <label for="pacientes_id" class="form-label">{{ __('Pacientes Id') }}</label>
                  <select name="pacientes_id" class="form-control @error('pacientes_id') is-invalid @enderror" id="pacientes_id">
                    <option value="">{{ __('Seleccione al Paciente') }}</option>
                    @foreach($pacientes as $id => $nombres)
                      <option value="{{ $id }}" {{ old('pacientes_id', $evento->pacientes_id) == $id ? 'selected' : '' }}>
                        {{ $nombres }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-2 mb20">
                  <label for="especialidades_id" class="form-label">{{ __('Especialidades Id') }}</label>
                  <select name="especialidades_id" class="form-control @error('especialidades_id') is-invalid @enderror" id="especialidades_id">
                    <option value="">{{ __('Seleccione la Especialidad') }}</option>
                    @foreach($especialidades as $id => $descripcion)
                      <option value="{{ $id }}" {{ old('especialidades_id', $evento->especialidades_id) == $id ? 'selected' : '' }}>
                        {{ $descripcion }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-2 mb20">
                  <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
                  <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" 
                         value="{{ old('descripcion', $evento?->descripcion) }}" id="descripcion" placeholder="Descripcion">
                  {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="form-group mb-2 mb20">
                  <label for="color" class="form-label">{{ __('Color') }}</label>
                  <input type="color" name="color" class="form-control @error('color') is-invalid @enderror" 
                         value="{{ old('color', $evento?->color ?? '#ff0000') }}" id="color">
                  {!! $errors->first('color', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <!-- Campo oculto para la fecha seleccionado desde el calendario -->
                <input type="hidden" name="fecha" id="fecha" value="{{ old('fecha', $evento?->fecha) }}">
              </div>
            </div>
          </form>
        </div>

        <!-- Pie del Modal -->
        <div class="modal-footer">
          <button form="createEventoForm" class="btn btn-success" id="btnGuardar">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal para Ver Citas -->
<div class="modal fade" id="modalVerCita" tabindex="-1" aria-labelledby="verCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verCitaLabel">Detalles de la Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <strong>Título:</strong> <span id="verTitulo"></span>
                <br><strong>Fecha:</strong> <span id="verFecha"></span>
                <br><strong>Hora:</strong> <span id="verHora"></span>
                <br><strong>Paciente:</strong> <span id="verPaciente"></span>
                <br><strong>Especialidad:</strong> <span id="verEspecialidad"></span>
                <br><strong>Descripción:</strong> <span id="verDescripcion"></span>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" id="btnPosponer">Posponer</button>
                <button class="btn btn-danger" id="btnEliminar">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>





 <!-- Modal para posponer la cita -->
<div class="modal fade" id="modalPosponer" tabindex="-1" aria-labelledby="modalPosponerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPosponerLabel">Posponer Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para seleccionar la nueva fecha y hora -->
                <div class="form-group">
                    <label for="nuevaFecha">Fecha</label>
                    <input type="date" class="form-control" id="nuevaFecha" name="fecha" required>
                </div>
                <div class="form-group">
                    <label for="nuevaHora">Hora</label>
                    <input type="time" class="form-control" id="nuevaHora" name="hora" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarPosponer">Guardar</button>
            </div>
        </div>
    </div>
</div>



@endsection





 