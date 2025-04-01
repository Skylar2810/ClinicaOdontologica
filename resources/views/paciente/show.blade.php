@extends('layouts.app')

@section('template_title')
    {{ $paciente->nombres ?? __('Show') . " " . __('Paciente') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <span class="card-title">HISTORIA CLINICA DENTAL</span>
                        </div>
                        <div>
                            <a class="btn btn-primary btn-sm" href="{{ route('pacientes.index') }}"> {{ __('Atras') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                    <h4>FILIACION</h4>
                        <!-- Primera Fila -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Nombres y Apellidos :</strong>
                                {{ $paciente->nombres }}
                            </div>
                            <div class="col-md-4">
                                <strong>Carnet:</strong>
                                {{ $paciente->ci }}
                            </div>
                            <div class="col-md-4">
                                <strong>Edad:</strong>
                                {{ $paciente->edad }}
                            </div>
                        </div>

                        <!-- Segunda Fila -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Sexo:</strong>
                                {{ $paciente->sexo->descripcion ?? 'No asignado' }}
                            </div>
                            <div class="col-md-4">
                                <strong>Estado Civil:</strong>
                                {{ $paciente->estadoRel->descripcion ?? 'No asignado' }}
                            </div>
                            <div class="col-md-4">
                                <strong>Ocupación o Profesion:</strong>
                                {{ $paciente->ocupacion }}
                            </div>
                        </div>

                        <!-- Tercera Fila -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Lugar de Nacimiento:</strong>
                                {{ $paciente->lugar }}
                            </div>
                            <div class="col-md-4">
                                <strong>Fecha de Nacimiento:</strong>
                                {{ $paciente->fechap }}
                            </div>
                            <div class="col-md-4">
                                <strong>Teléfono/Celular:</strong>
                                {{ $paciente->telcel }}
                            </div>
                        </div>

                        <!-- Cuarta Fila -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Correo:</strong>
                                {{ $paciente->correo }}
                            </div>
                            <div class="col-md-4">
                                <strong>Domicilio Actual:</strong>
                                {{ $paciente->domicilio }}
                            </div>
                        </div>






                        <!-- Quinta Fila -->
                        <br>
                        <h4>NOMBRE DEL PADRE, MADRE O APODERADO</h4>
                        <div class="row mb-3">
                        <div class="col-md-4">
                                <strong>Nombres y Apellidos :</strong>
                                {{ $paciente->nombresfamiliar }}
                            </div>
                            <div class="col-md-4">
                                <strong>Edad:</strong>
                                {{ $paciente->edadfamiliar }}
                            </div>
                            <div class="col-md-4">
                                <strong>Teléfono/Celular:</strong>
                                {{ $paciente->telcelfamiliar }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Correo:</strong>
                                {{ $paciente->correofamiliar }}
                            </div>
                        </div>




                        <!-- Sexta Fila -->
                        <br>
                        <h4>ANTECEDENTES PATOLOGICOS</h4>
                        <h5 class="mb-3">Antecedentes Generales:</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Tabaco:</strong>
                                {{ $paciente->tabaco }}
                            </div>
                            <div class="col-md-4">
                                <strong>Alcohol:</strong>
                                {{ $paciente->alcochol }}
                            </div>
                            <div class="col-md-4">
                                <strong>Alergia:</strong>
                                {{ $paciente->alergia }}
                            </div>
                        </div>

                        <!-- Séptima Fila -->
                        <h5 class="mb-3">Antecedentes Fisiologicos:</h5>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>Sed:</strong>
                                {{ $paciente->sed }}
                            </div>
                            <div class="col-md-4">
                                <strong>Apetito:</strong>
                                {{ $paciente->apetito }}
                            </div>
                            <div class="col-md-4">
                                <strong>Micción:</strong>
                                {{ $paciente->miccion }}
                            </div>
                        </div>

                        <!-- Octava Fila -->
                        <h5 class="mb-3">Antecedentes Inmunologicos:</h5>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>LES:</strong>
                                {{ $paciente->les }}
                            </div>
                            <div class="col-md-4">
                                <strong>VIH:</strong>
                                {{ $paciente->vih }}
                            </div>
                            <div class="col-md-4">
                                <strong>Otros:</strong>
                                {{ $paciente->otros }}
                            </div>
                        </div>

                        <!-- Novena Fila -->
                        <h5 class="mb-3">Antecedentes Patologicos:</h5>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <strong>HTA:</strong>
                                {{ $paciente->hta }}
                            </div>
                            <div class="col-md-3">
                                <strong>Anemia:</strong>
                                {{ $paciente->anemia }}
                            </div>
                            <div class="col-md-3">
                                <strong>Asma:</strong>
                                {{ $paciente->asma }}
                            </div>
                            <div class="col-md-3">
                                <strong>TBC:</strong>
                                {{ $paciente->tbc }}
                            </div>
                        </div>

                        <!-- Décima Fila -->
                        <h5 class="mb-3">Antecedentes Familiares:</h5>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <strong>HTA:</strong>
                                {{ $paciente->htaf }}
                            </div>
                            <div class="col-md-3">
                                <strong>Anemia:</strong>
                                {{ $paciente->anemiaf }}
                            </div>
                            <div class="col-md-3">
                                <strong>Asma:</strong>
                                {{ $paciente->asmaf }}
                            </div>
                            <div class="col-md-3">
                                <strong>TBC:</strong>
                                {{ $paciente->tbcf }}
                            </div>
                        </div>

                        <!-- Undécima Fila -->
                        <h5 class="mb-3">Antecedentes Epidemiologicos:</h5>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>Dengue:</strong>
                                {{ $paciente->dengue }}
                            </div>
                            <div class="col-md-4">
                                <strong>Fiebre Amarilla:</strong>
                                {{ $paciente->fiebre }}
                            </div>
                            <div class="col-md-4">
                                <strong>ITS:</strong>
                                {{ $paciente->its }}
                            </div>
                        </div>

                        <!-- Duodécima Fila -->
                        <h5 class="mb-3">Antecedentes Ocupacionales:</h5>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <strong>Stress:</strong>
                                {{ $paciente->stress }}
                            </div>
                            <div class="col-md-4">
                                <strong>Trauma Acustico:</strong>
                                {{ $paciente->trauma }}
                            </div>
                        </div>

                        <!-- Décimotercera Fila -->
                        <h5 class="mb-3"> Otros Antecedentes:</h5>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <strong> Ant. Farmacológicos:</strong>
                                {{ $paciente->farmacologicos }}
                            </div>
                            <div class="col-md-5">
                                <strong>Especificación de Antecedentes:</strong>
                                {{ $paciente->especificacion }}
                            </div>
                        </div>



                        <!-- Décimocuarta Fila -->
                        <br>
                        <h4>ENFERMEDAD ACTUAL</h4>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Fecha:</strong>
                                {{ $paciente->fechae }}
                            </div>
                            <div class="col-md-4">
                                <strong>Hora de Atencion:</strong>
                                {{ $paciente->hora }}
                            </div>
                        </div>

                        <!-- Décimoquinta Fila -->
                        <div class="row mb-3">
                        <div class="col-md-4">
                                <strong>Motivo de Consulta:</strong>
                                {{ $paciente->motivo }}
                            </div>
                            <div class="col-md-4">
                                <strong>Tiempo de la Enfermedad:</strong>
                                {{ $paciente->tiempo }}
                            </div>
                            <div class="col-md-4">
                                <strong>Síntomas Principales:</strong>
                                {{ $paciente->sintomas }}
                            </div>
                        </div>

                        <!-- Décimosexta Fila -->
                        <div class="row mb-3">
                        <div class="col-md-5">
                                <strong>Relato Cronologico:</strong>
                                {{ $paciente->relato }}
                            </div>
                            <div class="col-md-5">
                                <strong>Funciones Biologicas:</strong>
                                {{ $paciente->funciones }}
                            </div>
                            
                        </div>




                        <!-- Décimoséptima Fila -->
                        <br>
                        <h4>EXAMEN CLINICO</h4>
                        <div class="form-group mb-2 mb20"> <strong>Estado General:</strong> {{ $paciente->estado }} </div> 
                        <div class="row mb-3">
                        <div class="col-md-4">
                                <strong>PA:</strong>
                                {{ $paciente->pa }}
                            </div>
                            <div class="col-md-4">
                                <strong>Peso:</strong>
                                {{ $paciente->peso }}
                            </div>
                            <div class="col-md-4">
                                <strong>Talla:</strong>
                                {{ $paciente->talla }}
                            </div>
                        </div>

                        <div class="row mb-3">
                         <div class="col-md-4">
                                <strong>Tº:</strong>
                                {{ $paciente->{'tº'} }}
                            </div>
                            <div class="col-md-4">
                                <strong>FC:</strong>
                                {{ $paciente->fc }}
                            </div>
                            <div class="col-md-4">
                                <strong>FR:</strong>
                                {{ $paciente->fr }}
                            </div>
                        </div>

                        <!-- Décimooctava Fila -->
                        <br>
                        <h4>EVALUACION ODONTOLOGICA</h4>
                        <div class="form-group mb-2 mb20"> <strong> Examen Intra Oral:</strong> {{ $paciente->intraoral }} </div> 
                        <div class="form-group mb-2 mb20"> <strong>Examen Extra Oral:</strong> {{ $paciente->extraoral }} </div> 

                        <!-- Añadir más filas si es necesario -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
