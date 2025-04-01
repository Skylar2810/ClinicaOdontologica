<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead">
            <tr>
                <th>No</th>
                <th>Nombres y Apellidos</th>
                <th>Carnet</th>
                <th>Edad</th>
                <th>Teléfono o Celular</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $paciente->nombres }}</td>
                    <td>{{ $paciente->ci }}</td>
                    <td>{{ $paciente->edad }}</td>
                    <td>{{ $paciente->telcel }}</td>
                    <td>{{ $paciente->correo }}</td>
                      <td>
                        <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST">
                            <a class="btn btn-sm btn-primary " href="{{ route('pacientes.show', $paciente->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                            <a class="btn btn-sm btn-success" href="{{ route('pacientes.edit', $paciente->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                             <!-- Botón para ver radiografías -->
                            <a class="btn btn-sm btn-info" href="{{ route('radiografias.index', $paciente->id) }}">
                                <i class="fa fa-fw fa-image"></i> {{ __('') }}
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $pacientes->withQueryString()->links() !!} {{-- Para paginación --}}
