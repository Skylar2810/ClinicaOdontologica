<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Pagos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; padding: 10px; background-color: #f8f8f8; }
        .container { max-width: 700px; margin: auto; padding: 20px; background: white; border: 2px solid #4CAF50; }
        
        /* Encabezado */
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 3px solid #4CAF50; 
            padding-bottom: 10px; 
            margin-bottom: 10px; 
        }
        .clinic-info { font-size: 12px; text-align: right; width: 100%;}
        .logo { width: 80%; text-align: left;  margin-top: -100px; }
        .logo img { width: 220px; }

        /* Título de Factura */
        .title { text-align: center; margin-top: 10px; font-size: 18px; font-weight: bold; }
        .factura-info { text-align: center; font-size: 12px; margin-top: 5px; }

        /* Tablas */
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #4CAF50; padding: 6px; text-align: left; }
        .table th { background-color: #4CAF50; color: white; text-align: center; }

        /* Totales */
        .total { font-size: 14px; text-align: right; margin-top: 10px; font-weight: bold; }

        /* Pie de Página */
        .footer { text-align: center; margin-top: 15px; font-size: 10px; color: gray; }
    </style>
</head>
<body>

    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <!-- Información de la Clínica -->
            <div class="clinic-info">
                <p> Dirección: Zona Villa Fátima Avenida Las Américas Nº 325 
                <br>primer piso Frente al Ex Surtidor
                <br>La Paz, Bolivia</p>
                <p>Cel: 63167903</p>
                <p> Email: marianaterceros@gmail.com</p>
            </div>
            <!-- Logo a la derecha -->
            <div class="logo">
                <img src="{{ public_path('vendor/adminlte/dist/img/AdminLTELogo3.png') }}" alt="Logo Clínica">
            </div>
        </div>

        <!-- Título de Factura -->
        <div class="title">FACTURA</div>
        <div class="factura-info">
            <p><strong>Fecha de Emisión:</strong> {{ now()->format('d/m/Y') }}</p>
        </div>

        <!-- Información del Paciente -->
        <h4>Datos del Paciente</h4>
        <p><strong>Nombre:</strong> {{ $paciente->nombres }} | <strong>CI:</strong> {{ $paciente->ci }}</p>

        <!-- Tabla de Tratamientos -->
        <h4>Tratamientos Realizados</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tratamiento</th>
                    <th>Estado</th>
                    <th>Presupuesto (Bs.)</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPresupuesto = 0; @endphp
                @forelse($tratamientos as $tratamiento)
                    @php $totalPresupuesto += $tratamiento->presupuesto; @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($tratamiento->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $tratamiento->especialidade->descripcion  ?? 'N/A' }}</td>

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

                         <td>{{ number_format($tratamiento->presupuesto, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align: center;">No hay tratamientos registrados.</td></tr>
                @endforelse
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Total Presupuesto:</td>
                    <td style="font-weight: bold;">{{ number_format($totalPresupuesto, 2) }} Bs.</td>
                </tr>
            </tbody>
        </table>

        <!-- Tabla de Pagos -->
        <h4>Pagos Realizados</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Monto (Bs.)</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPagos = 0; @endphp
                @forelse($pagos as $pago)
                    @php $totalPagos += $pago->monto; @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                        <td>{{ number_format($pago->monto, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" style="text-align: center;">No hay pagos registrados.</td></tr>
                @endforelse
                <tr>
                    <td style="text-align: right; font-weight: bold;">Total Pagado:</td>
                    <td style="font-weight: bold;">{{ number_format($totalPagos, 2) }} Bs.</td>
                </tr>
            </tbody>
        </table>

        <!-- Saldo Pendiente -->
        <div class="total">
            Saldo Pendiente: {{ number_format($totalPresupuesto - $totalPagos, 2) }} Bs.
        </div>

        <!-- Pie de Página -->
        <div class="footer">
            <p>Gracias por confiar en Nosotros.
            <br> ¡Esperamos verlo pronto en "TERCEROS-DENT"!</p>
        </div>
    </div>

</body>
</html>
