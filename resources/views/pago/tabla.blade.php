<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead">
            <tr>
                <th>Nombres y Apellidos</th>
                <th>Deuda Total</th>
            </tr>
        </thead>
        <tbody>
             @foreach($deudas as $deuda)
                @if (Auth::user()->hasRole('Admin') || (Auth::user()->hasRole('Paciente') && $deuda['paciente'] === Auth::user()->name))
                    <tr>
                        <td>{{ $deuda['paciente'] }}</td>
                        <td>{{ $deuda['deudaTotal'] }}</td>
                        <td>
                            @if (Auth::user()->hasRole('Admin'))
                                <a href="{{ route('pagos.show', $deuda['paciente_id']) }}" class="btn btn-primary">Ver Pagos</a>
                            @elseif (Auth::user()->hasRole('Paciente'))
                                <a href="{{ route('pagos.show', $deuda['paciente_id']) }}" class="btn btn-secondary">Ver Mis Pagos</a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
</div>

{!! $pacientes->withQueryString()->links() !!} {{-- Para paginación --}}
