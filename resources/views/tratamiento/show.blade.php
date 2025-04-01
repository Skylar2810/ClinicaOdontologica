@extends('layouts.app')

@section('template_title')
    Tratamientos de {{ $paciente->nombres }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title" name="busnombre">Paciente: {{ $paciente->nombres }}</span>
                        
                        <!-- Botón para abrir el modal de nuevo tratamiento -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCrearTratamiento">
                            Crear Nuevo Tratamiento
                        </button>
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
                                    <th>Presupuesto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tratamientos as $tratamiento)
                                    <tr>
                                        <td>{{ $tratamiento->fecha }}</td>
                                        <td>{{ $tratamiento->pieza }}</td>
                                        <td>{{ $tratamiento->especialidade->descripcion }}</td>
                                        <td>{{ $tratamiento->presupuesto }}</td>
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
                                        <td>
                                            <!-- Botón para abrir el modal de seguimiento -->
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalSeguimiento{{ $tratamiento->id }}">
                                                Seguimiento
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
<a href="{{ route('reporte.seguimientos', $paciente->id) }}"  target="_blank" class="btn btn-primary">
    Ver Reporte PDF
</a>



                    <div class="d-flex justify-content-center">
                        {{ $tratamientos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear un nuevo tratamiento -->
<div class="modal fade" id="modalCrearTratamiento" tabindex="-1" aria-labelledby="modalCrearTratamientoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Tratamiento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('tratamientos.store') }}">
          @csrf
          <input type="hidden" name="pacientes_id" value="{{ $paciente->id }}">

          <div class="form-group mb-2">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
          </div>

          <div class="form-group mb-2">
            <label for="pieza" class="form-label">Pieza</label>
            <input type="text" name="pieza" class="form-control" required>
          </div>

          <div class="form-group mb-2">
            <label for="especialidades_id" class="form-label">Tratamiento a Realizar</label>
            <select name="especialidades_id" class="form-control" required>
                <option value="">Seleccione el tratamiento</option>
                @foreach($especialidades as $id => $descripcion)
                  <option value="{{ $id }}">{{ $descripcion }}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group mb-2">
            <label for="presupuesto" class="form-label">Presupuesto</label>
            <input type="text" name="presupuesto" class="form-control" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Seguimiento -->
@foreach ($tratamientos as $tratamiento)
<div class="modal fade" id="modalSeguimiento{{ $tratamiento->id }}" tabindex="-1" aria-labelledby="modalSeguimientoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Seguimiento de {{ $tratamiento->especialidade->descripcion }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Mostrar los tres últimos seguimientos -->
        <p><strong>Últimos Seguimientos:</strong></p>

        @if ($tratamiento->seguimiento->isNotEmpty())
          @foreach ($tratamiento->seguimiento->sortByDesc('fecha_seguimiento')->take(1) as $seguimiento)
            <p><strong>Seguimiento:</strong> {{ $seguimiento->seguimiento }}</p>
          @endforeach
        @else
          <p>No hay seguimientos registrados.</p>
        @endif
        
        <!-- Formulario para agregar un nuevo seguimiento -->
        <form method="POST" action="{{ route('seguimientos.store') }}">
          @csrf
          <input type="hidden" name="tratamiento_id" value="{{ $tratamiento->id }}">

          <div class="form-group mb-2">
            <label for="seguimiento" class="form-label">Agregar Seguimiento</label>
            <textarea name="seguimiento" class="form-control" rows="3" required></textarea>
          </div>

          <div class="form-group mb-2">
            <label class="form-label">Actualizar Estado</label><br>
            <input type="radio" name="estado" value="Pendiente" checked> Pendiente
            <input type="radio" name="estado" value="Concluido"> Concluido
            <input type="radio" name="estado" value="Cancelado"> Cancelado
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar Seguimiento</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
