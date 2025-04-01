@extends('layouts.app')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',

          locale:'es',

          headerToolbar:{
            left:'prev,next,today',
            center:'title',
            right:'dayGridMonth,timeGridWeek,listWeek'
          },

        dateClick:function(info){
            $("#evento").modal("show");
        }


        });
        calendar.render();
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
    <div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    
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
                      <option value="{{ $id }}" {{ old('pacientes_id', $calendario?->pacientes_id) == $id ? 'selected' : '' }}>
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
                      <option value="{{ $id }}" {{ old('especialidades_id', $calendario?->especialidades_id) == $id ? 'selected' : '' }}>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    
@stop