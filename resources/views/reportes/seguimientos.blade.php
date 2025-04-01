<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tratamientos y Seguimiento</title>
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
    </style>
</head>
<body>

    <div class="container">
        <!-- Título de Tratamientos -->
        <div class="title">Tratamientos y Seguimiento</div>

        <!-- Información del Paciente -->
        <h4>Datos del Paciente</h4>
        <p><strong>Nombre:</strong> {{ $paciente->nombres }} | <strong>CI:</strong> {{ $paciente->ci }}</p>

        <!-- Tabla de Tratamientos -->
        @foreach($tratamientos as $tratamiento)
            <table class="table">
                <thead>
                    <tr>
                        <th>Tratamiento</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha de Seguimiento</th>
                        <th>Seguimiento</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $tratamiento->especialidade->descripcion ?? 'N/A' }}</td>
                        <td>{{ $tratamiento->fecha ? \Carbon\Carbon::parse($tratamiento->fecha)->format('d/m/Y') : 'Fecha no disponible' }}</td>
                        
                        <!-- Iterar sobre todos los seguimientos -->
                        <td>
                        @if($tratamiento->seguimiento && $tratamiento->seguimiento->isEmpty())
                            <p>Sin Fecha de Seguimiento</p>
                        @elseif($tratamiento->seguimiento)
                            @foreach($tratamiento->seguimiento as $seguimiento)
                                <p>{{ $seguimiento->fecha_seguimiento ? \Carbon\Carbon::parse($seguimiento->fecha_seguimiento)->format('d/m/Y') : 'No disponible' }}</p>
                            @endforeach
                        @else
                            <p></p>
                        @endif
                    </td>

                    <td>
                        @if($tratamiento->seguimiento && $tratamiento->seguimiento->isEmpty())
                            <p>Sin Seguimiento</p>
                        @elseif($tratamiento->seguimiento)
                            @foreach($tratamiento->seguimiento as $seguimiento)
                                <p>{{ $seguimiento->seguimiento ?? 'No disponible' }}</p>
                            @endforeach
                        @else
                            <p></p>
                        @endif
                    </td>

                    <td>
                        @if($tratamiento->seguimiento && $tratamiento->seguimiento->isEmpty())
                            <p>Sin Estado</p>
                        @elseif($tratamiento->seguimiento)
                            @foreach($tratamiento->seguimiento as $seguimiento)
                                <p>{{ $seguimiento->estado ?? 'No disponible' }}</p>
                            @endforeach
                        @else
                            <p></p>
                        @endif
                    </td>
                    </tr>
                </tbody>
            </table>
        @endforeach

        <!-- Pie de Página -->
        <div class="footer">
            <p>Gracias por confiar en Nosotros.
            <br> ¡Esperamos verlo pronto en "TERCEROS-DENT"!</p>
        </div>
    </div>

</body>
</html>
