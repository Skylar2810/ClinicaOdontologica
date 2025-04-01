@extends('layouts.app')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#registerForm").submit(function(e) {
        e.preventDefault(); // Evita que se recargue la página

        $.ajax({
            url: "{{ route('usuarios.store') }}", // Ruta de tu store()
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Agregar el nuevo usuario a la tabla sin recargar la página
                    let nuevoUsuario = `
                        <tr>
                            <td>${response.user.name}</td>
                            <td>${response.user.email}</td>
                        </tr>`;
                    
                    $("#tablaUsuarios tbody").append(nuevoUsuario);

                    // Ocultar el modal
                    $("#modalRegistro").modal("hide");

                    // Limpiar el formulario
                    $("#formRegistro")[0].reset();
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText); // Ver errores en la consola
            }
        });
    });
});
</script>




@section('template_title')
    Usuarios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-md-flex justify-content-md">
                    @if (Auth::user()->hasRole('Admin'))
                        <form action="{{ route('usuarios.index') }}" method="GET">
                            <div class="btn-group">
                                <input type="text" name="busqueda" class="form-control" placeholder="Buscar usuario">
                                <input type="submit" value="Buscar" class="btn btn-primary">
                            </div>
                        </form>
                    @endif
                </div>
                <br>

                <div class="card">
                    <div class="card-header">
                    

                             @if (Auth::user()->hasRole('Admin'))
                             <div class="float-right">
                                  <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#registerModal">
                                    Registrar Usuario
                                </button>
                              </div>
                              @endif

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Usuarios y Roles') }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                @foreach($usuario->roles as $role)
                                                    <span class="badge bg-info">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if (Auth::user()->hasRole('Admin'))
                                                    

                                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                                   
                                                    <a class="btn btn-sm btn-success" href="{{ route('usuarios.edit', $usuario->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Registrar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroForm" action="{{ route('usuarios.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar</button>
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
