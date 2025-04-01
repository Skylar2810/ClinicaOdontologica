<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiografías</title>
    <style>
           body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; padding: 10px; background-color: #f8f8f8; }
        .container { max-width: 700px; margin: auto; padding: 20px; background: white; border: 2px solid #4CAF50; }

        /* Título de Factura */
        .title { text-align: center; margin-top: 10px; font-size: 18px; font-weight: bold; }

        /* Tablas */
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #4CAF50; padding: 6px; text-align: left; }
        .table th { background-color: #4CAF50; color: white; text-align: center; }

        /* Pie de Página */
        .footer { text-align: center; margin-top: 15px; font-size: 10px; color: gray; }

        img { width: 60%; max-height: 400px; }
        .imagen-container { page-break-inside: avoid; text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
     <!-- Titulo de las Radiografias -->
        <div class="title">Radiografías</div>

     <!-- Información del Paciente -->
        <h4>Datos del Paciente</h4>
        <p><strong>Nombre:</strong> {{ $paciente->nombres }} | <strong>CI:</strong> {{ $paciente->ci }}</p>

    @foreach ($radiografias as $radiografia)
        <div class="imagen-container">
            <img src="{{ public_path('storage/radiografias/' . $radiografia->imagen) }}">
            <p>{{ $radiografia->descripcion }}</p>
        </div>
    @endforeach

    <!-- Pie de Página -->
        <div class="footer">
            <p>Gracias por confiar en Nosotros.
            <br> ¡Esperamos verlo pronto en "TERCEROS-DENT"!</p>
        </div>
    </div>
</body>
</html>
