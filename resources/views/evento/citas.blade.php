@extends('adminlte::page')

@section('title', 'Mis Citas')

@section('content_header')
    <h1>Mis Citas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-teal text-black">
            <h3 class="card-title">CITAS PROGRAMADAS</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        
                       
                        <th>Fecha </th>
                        <th>Hora </th>
                        <th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>
    
                           
                            <td>{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($evento->hora)->format('H:i') }}</td>
                            <td>{{ $evento->especialidade->descripcion }}</td>
                            <td>
                                @if($evento->estado === 'Pospuesta')
                                    <span class="badge bg-danger">Cita Pospuesta</span>
                                @else
                                    <span class="badge bg-success">Cita Agendada</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
