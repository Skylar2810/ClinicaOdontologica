<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#busqueda').on('keyup', function() {
        var valor = $(this).val();
        $.ajax({
            url: "{{ route('tratamientos.index') }}",
            method: 'GET',
            data: { busqueda: valor },
            success: function(data) {
                $('#tabla_pacientes').html(data); // Actualiza la tabla sin recargar
            }
        });
    });
});
</script>

@extends('layouts.app')

@section('template_title')
    Pacientes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <div class="d-md-flex justify-content-md">
                    <input type="text" id="busqueda" class="form-control" placeholder="Buscar paciente...">
                </div>

                <br>

                <div class="card">
                    <div class="card-header  bg-teal text-black">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <h3 class="card-title">LISTA DE PACIENTES</h3>
                            </span>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div id="tabla_pacientes">
                            @include('tratamiento.table') {{-- Se carga la tabla de pacientes dinámicamente --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


