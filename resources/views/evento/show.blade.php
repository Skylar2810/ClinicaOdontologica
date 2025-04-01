@extends('layouts.app')

@section('template_title')
    {{ $evento->name ?? __('Show') . " " . __('Evento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Evento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('eventos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Title:</strong>
                                    {{ $evento->title }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Hora:</strong>
                                    {{ $evento->hora }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Pacientes Id:</strong>
                                    {{ $evento->pacientes_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Especialidades Id:</strong>
                                    {{ $evento->especialidades_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion:</strong>
                                    {{ $evento->descripcion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Start:</strong>
                                    {{ $evento->start }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>End:</strong>
                                    {{ $evento->end }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
