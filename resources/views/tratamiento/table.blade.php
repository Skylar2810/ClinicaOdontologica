<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead">
            <tr>
                <th>Nombres y Apellidos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->nombres }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('tratamientos.show', $paciente->id) }}">
                            <i class="fa fa-fw fa-eye"></i> Ver Tratamientos
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $pacientes->links() !!} {{-- Para paginación --}}
