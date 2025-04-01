@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Evento
@endsection

@section('content')
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateEventoModal">
        Editar Evento
    </button>

    <!-- Modal -->
    <div class="modal fade" id="updateEventoModal" tabindex="-1" aria-labelledby="updateEventoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEventoModalLabel">{{ __('Update') }} Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- Cuerpo del Modal -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('eventos.update', $evento->id) }}" role="form" enctype="multipart/form-data" id="updateEventoForm">
                        {{ method_field('PATCH') }}
                        @csrf

                        <!-- Incluye el formulario de evento aquí -->
                        @include('evento.form')
                    </form>
                </div>

                <!-- Pie de página del Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="updateEventoForm" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
@endsection
