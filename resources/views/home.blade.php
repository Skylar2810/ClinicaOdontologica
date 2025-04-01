@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
@stop

@section('content')
<style>
    /* Estilos personalizados */
    .home-container {
        position: relative; /* Posición relativa para permitir el posicionamiento absoluto del texto */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 80vh;
        text-align: center;
        color: white;
    }

    .home-container h1 {
        font-size: 2.5rem;
        color: teal;
        text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.5);
        position: absolute; /* El texto se posiciona encima de la imagen */
        top: 8%; /* Ajusta la distancia desde la parte superior */
        left: 50%;
        transform: translateX(-50%);
    }

    .home-container p {
        font-size: 1.5rem;
        color:teal;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
        position: absolute; /* El texto se posiciona encima de la imagen */
        top: 50%; /* Ajusta la distancia desde la parte superior */
        left: 50%;
        transform: translateX(-50%);
    }

    /* Contenedor de la imagen */
    .image-container img {
        width: 200%; /* La imagen ocupará el 100% de su contenedor */
        max-width: 1100px;
        height: 100%; /* Ajusta la altura al 100% */
        object-fit: cover; /* Asegura que la imagen cubra el área sin deformarse */
        border-radius: 10px; /* Bordes redondeados (opcional) */
    }
</style>

<div class="home-container">
    <!-- Imagen de la clínica -->
    <div class="image-container">
        <img src="{{ asset('storage/radiografias/fondo.jpg') }}" alt="Imagen de la clínica">
    </div>

    <!-- Texto encima de la imagen -->
    <h1>Bienvenid@ <br>{{ Auth::user()->name }} <br> a la Clinica Odontologica <br> "TERCEROS-DENT"</h1>
    <p>¡En la Clínica Odontológica "TERCEROS-DENT", cuidamos tu sonrisa con la 
                                            mejor atención!.</p>
</div>
@stop
