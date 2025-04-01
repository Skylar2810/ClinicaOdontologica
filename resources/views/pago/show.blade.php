@extends('layouts.app')

@section('template_title')
    Tratamientos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title" name="busnombre">Paciente: {{ $paciente->nombres }}</span>
                    </div>
                </div>

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Pieza</th>
                                    <th>Especialidad</th>
                                    <th>Estado</th>
                                    <th>Presupuesto</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tratamientos as $tratamiento)
                                    <tr>
                                        <td>{{ $tratamiento->fecha }}</td>
                                        <td>{{ $tratamiento->pieza }}</td>
                                        <td>{{ $tratamiento->especialidade->descripcion }}</td>
                                       
                                         <td>
                                         @if ($tratamiento->seguimiento->isNotEmpty())
                                            @php
                                                $ultimoSeguimiento = $tratamiento->seguimiento->sortByDesc('fecha_seguimiento')->first();
                                                $estado = trim($ultimoSeguimiento->estado); // Asegurarse de que no tenga espacios extra
                                            @endphp

                                            <span class="badge 
                                                {{ $estado === 'concluido' ? 'bg-success' : 
                                                  ($estado === 'pendiente' ? 'bg-primary' : 
                                                  ($estado === 'cancelado' ? 'bg-danger' : 'bg-secondary')) }}">
                                                {{ $estado }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">Sin seguimiento</span>
                                        @endif

                                        </td>
                                         <td>{{ $tratamiento->presupuesto }}</td>
                                        
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <p>Total tratamientos: {{ $totalTratamientos }}</p>
            <p>Total pagos: {{ $totalPagos }}</p>
            <p>Saldo: {{ $saldo }}</p>

            <!-- Botón para abrir el modal -->
             @if (Auth::user()->hasRole('Admin'))
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">
                    Registrar Pago 
                </button>
             @endif

             <a href="{{ route('pagos.pdf', $paciente->id) }}" target="_blank" class="btn btn-danger">
                Ver Factura PDF
            </a>
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Pagar Deuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form method="POST" action="{{ route('pagos.store') }}">
                @csrf
                <div class="modal-body">
                    <!-- Campo oculto para enviar el ID del paciente -->
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                    
                    <div class="form-group">
                        <label for="paciente">Paciente</label>
                        <input type="text" class="form-control" value="{{ $paciente->nombres }}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="fecha_pago">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="monto">Monto</label>
                        <input type="number" name="monto" class="form-control" min="1" required>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
