@extends('layouts.app')

@section('template_title')
    
@endsection

@section('content')
    <h1>Detalles de Deuda para {{ $paciente->nombre }}</h1>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tratamiento</th>
                <th>Presupuesto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paciente->tratamientos as $tratamiento)
                <tr>
                    <td>{{ $tratamiento->fecha }}</td>
                    <td>{{ $tratamiento->pieza }}</td>
                    <td>{{ $tratamiento->presupuesto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total de Tratamientos: {{ $totalTratamientos }}</p>
    <p>Saldo: {{ $saldo }}</p>

    <a href="{{ route('pagos.create', $paciente->id) }}" class="btn btn-success">Pagar</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
@endsection
