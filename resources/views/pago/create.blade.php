@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Pago
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Pago</span>
                    </div>
                    <div class="card-body bg-white">
                        <form action="{{ route('pagos.pagar', $paciente->id) }}" method="POST">
 @csrf

                            @include('pago.form')
</form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
