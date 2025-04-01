@extends('layouts.app')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {

        let formulario = document.querySelector("form");
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',

          locale:'es',

          headerToolbar:{
            left:'prev,next,today',
            center:'title',
            right:'dayGridMonth,timeGridWeek,listWeek'
          },
        
        events:"http://127.0.0.1:8000/eventos/mostrar",
        dateClick:function(info){
            $("#evento").modal("show");
        }


        });
        calendar.render();

        document.getElementById("btnGuardar").addEventListener("click",function(){
            const datos = new FormData(formulario);

            console.log(datos);
            console.log(formulario.title.value);

            axios.post("http://127.0.0.1:8000/eventos/agregar",datos).
            then (
                (respuesta)=>{
                $("#evento").modal("hide");
            }
            ).catch(
                error=>{
                    if(error.response){
                        console.log(error.response.data);
                    }
                }
            )
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

                            <span id="card_title">
                                {{ __('Calendario') }}
                            </span>
                            </div>
                     <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
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
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $evento?->title) }}" id="title" placeholder="Title">
            {!! $errors->first('title', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora" class="form-label">{{ __('Hora') }}</label>
            <input type="time" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora', $evento?->hora) }}" id="hora" placeholder="Hora">
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
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $evento?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="start" class="form-label">{{ __('Start') }}</label>
            <input type="text" name="start" class="form-control @error('start') is-invalid @enderror" value="{{ old('start', $evento?->start) }}" id="start" placeholder="Start">
            {!! $errors->first('start', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="end" class="form-label">{{ __('End') }}</label>
            <input type="text" name="end" class="form-control @error('end') is-invalid @enderror" value="{{ old('end', $evento?->end) }}" id="end" placeholder="End">
            {!! $errors->first('end', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
</div>



                    </form>
                </div>

                <!-- Pie de página del Modal -->
                <div class="modal-footer">
                <button type="submit" form="createEventoForm" class="btn btn-success" id="btnGuardar">Guardar</button>
                <button type="submit" form="createEventoForm" class="btn btn-warning" id="btnModificar">Modificar</button>
                <button type="submit" form="createEventoForm" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
