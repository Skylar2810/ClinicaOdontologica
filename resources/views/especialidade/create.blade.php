@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Especialidade
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Nuevo Tratamiento</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('especialidades.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('especialidade.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
