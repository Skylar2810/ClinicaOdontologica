@extends('layouts.app')

@section('template_title')
    Radiografías de {{ $paciente->nombres }}
@endsection

@section('content')
<div class="container mt-4">
    <!-- TÍTULO -->
    <h2 class="text-center mb-3">Radiografías</h2>

    <!-- INFORMACIÓN DEL PACIENTE -->
    <div class="text-center mb-3">
        <p>Paciente: {{ $paciente->nombres }}</p>
    </div>

    <!-- BOTONES: SUBIR RADIOGRAFÍA & VISUALIZAR PDF -->
    <div class="d-flex justify-content-center gap-3 mb-4">
        <!-- Botón para subir radiografía -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSubirRadiografia">
            <i class="fa fa-upload"></i> Subir Radiografía
        </button>

        <!-- Botón para ver PDF -->
        <a href="{{ route('radiografias.pdf', $paciente->id) }}" target="_blank" class="btn btn-danger">
            <i class="fa fa-file-pdf"></i> Visualizar PDF
        </a>
    </div>

    <!-- CARRUSEL DE RADIOGRAFÍAS -->
    @if ($radiografias->count() > 0)
    <div id="carouselRadiografias" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($radiografias as $index => $radiografia)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <!-- Contenedor con la descripción debajo de la imagen -->
                    <div class="d-flex flex-column align-items-center">
                        <div class="text-center p-1" style="background-color: rgba(0, 0, 0, 0.5); width: 70%;">
                            <p class="text-white">{{ $radiografia->descripcion }}</p>
                        </div>
                        <img src="{{ asset('storage/radiografias/' . $radiografia->imagen) }}" class="d-block mx-auto img-fluid" style="height: 300px;">
                        
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Botones de navegación del carrusel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselRadiografias" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselRadiografias" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
@else
    <p class="text-center text-muted">No hay radiografías disponibles.</p>
@endif


<!-- MODAL PARA SUBIR RADIOGRAFÍA -->
<div class="modal fade" id="modalSubirRadiografia" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Subir Nueva Radiografía</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('radiografias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Seleccione las imágenes:</label>
                        <input type="file" name="imagenes[]" class="form-control" accept="image/jpeg, image/png" multiple required>
                        <small class="text-muted">Solo se aceptan archivos JPG y PNG.</small>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción (opcional):</label>
                        <input type="text" name="descripcion" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Subir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
