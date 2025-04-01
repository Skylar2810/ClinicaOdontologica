@extends('layouts.app')

@section('template_title')
    Editar Usuario
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span id="card_title">
                            {{ __('Editar Usuario') }}
                        </span>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $usuario->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $usuario->email }}" required>
                            </div>


                            <div class="form-group">
                                    <label for="roles">Rol</label><br>
                                    <label>
                                        <input type="radio" name="role" value="Admin" 
                                            {{ $usuario->hasRole('Admin') ? 'checked' : '' }}>
                                        Admin
                                    </label><br>
                                    <label>
                                        <input type="radio" name="role" value="Paciente" 
                                            {{ $usuario->hasRole('Paciente') ? 'checked' : '' }}>
                                        Paciente
                                    </label>
                                </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Actualizar Usuario</button>
                                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
