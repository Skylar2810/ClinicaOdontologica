<div class="row padding-1 p-1">
    <div class="col-md-12">
    <h4>FILIACION</h4>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="nombres" class="form-label">{{ __('Nombres y Apellidos') }}</label>
            <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres', $paciente?->nombres) }}" id="nombres" placeholder="Nombres y Apellidos">
            {!! $errors->first('nombres', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="ci" class="form-label">{{ __('Carnet') }}</label>
            <input type="text" name="ci" class="form-control @error('ci') is-invalid @enderror" value="{{ old('ci', $paciente?->ci) }}" id="ci" placeholder="Carnet Identidad">
            {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="edad" class="form-label">{{ __('Edad') }}</label>
            <input type="text" name="edad" class="form-control @error('edad') is-invalid @enderror" value="{{ old('edad', $paciente?->edad) }}" id="edad" placeholder="Edad">
            {!! $errors->first('edad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>

        <div class="row mb-3">
        <div class="col-md-4">
            <label for="sexos_id" class="form-label">{{ __('Sexo') }}</label>
           <select name="sexos_id" class="form-control @error('sexos_id') is-invalid @enderror" id="sexos_id">
                <option value="">{{ __('Seleccione el sexo') }}</option>
                     @foreach($sexos as $id => $descripcion)
                      <option value="{{ $id }}" {{ old('sexos_id', $paciente?->sexos_id) == $id ? 'selected' : '' }}>
                             {{ $descripcion }}
                        </option>
                     @endforeach
            </select>
           </div>
        <div class="col-md-4">
            <label for="estados_id" class="form-label">{{ __('Estados Civil') }}</label>
            <select name="estados_id" class="form-control @error('estados_id') is-invalid @enderror" id="estados_id">
                <option value="">{{ __('Seleccione el estado') }}</option>
                    @foreach($estados as $id => $descripcion)
                     <option value="{{ $id }}" {{ old('estados_id', $paciente?->estados_id) == $id ? 'selected' : '' }}>
                        {{ $descripcion }}
                    </option>
                    @endforeach
            </select>
            </div>


        <div class="col-md-4">
            <label for="ocupacion" class="form-label">{{ __('Ocupacion o Profesion') }}</label>
            <input type="text" name="ocupacion" class="form-control @error('ocupacion') is-invalid @enderror" value="{{ old('ocupacion', $paciente?->ocupacion) }}" id="ocupacion" placeholder="Ocupacion o Profesion">
            {!! $errors->first('ocupacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

        <div class="row mb-3">
        <div class="col-md-4">
            <label for="lugar" class="form-label">{{ __('Lugar de Nacimiento') }}</label>
            <input type="text" name="lugar" class="form-control @error('lugar') is-invalid @enderror" value="{{ old('lugar', $paciente?->lugar) }}" id="lugar" placeholder="Lugar de Nacimiento">
            {!! $errors->first('lugar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="fechap" class="form-label">{{ __('Fecha de Nacimiento') }}</label>
            <input type="date" name="fechap" class="form-control @error('fechap') is-invalid @enderror" value="{{ old('fechap', $paciente?->fechap) }}" id="fechap" placeholder="Fecha de Nacimiento">
            {!! $errors->first('fechap', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="telcel" class="form-label">{{ __('Telfono/Celular') }}</label>
            <input type="text" name="telcel" class="form-control @error('telcel') is-invalid @enderror" value="{{ old('telcel', $paciente?->telcel) }}" id="telcel" placeholder="Telefono/Celular">
            {!! $errors->first('telcel', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>


        <div class="row mb-3">
        <div class="col-md-4">
            <label for="correo" class="form-label">{{ __('Correo') }}</label>
            <input type="text" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $paciente?->correo) }}" id="correo" placeholder="Correo Electronico">
            {!! $errors->first('correo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="domicilio" class="form-label">{{ __('Domicilio Actual') }}</label>
            <input type="text" name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" value="{{ old('domicilio', $paciente?->domicilio) }}" id="domicilio" placeholder="Domicilio Actual">
            {!! $errors->first('domicilio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>


        <br>
        <h4>NOMBRE DEL PADRE, MADRE O APODERADO</h4>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="nombresfamiliar" class="form-label">{{ __('Nombres y Apellidos') }}</label>
            <input type="text" name="nombresfamiliar" class="form-control @error('nombresfamiliar') is-invalid @enderror" value="{{ old('nombresfamiliar', $paciente?->nombresfamiliar) }}" id="nombresfamiliar" placeholder="Nombres y Apellidos">
            {!! $errors->first('nombresfamiliar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="edadfamiliar" class="form-label">{{ __('Edad') }}</label>
            <input type="text" name="edadfamiliar" class="form-control @error('edadfamiliar') is-invalid @enderror" value="{{ old('edadfamiliar', $paciente?->edadfamiliar) }}" id="edadfamiliar" placeholder="Edad">
            {!! $errors->first('edadfamiliar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="telcelfamiliar" class="form-label">{{ __('Telefono/Celular') }}</label>
            <input type="text" name="telcelfamiliar" class="form-control @error('telcelfamiliar') is-invalid @enderror" value="{{ old('telcelfamiliar', $paciente?->telcelfamiliar) }}" id="telcelfamiliar" placeholder="Telefono/Celular">
            {!! $errors->first('telcelfamiliar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>



        <div class="row mb-3">
        <div class="col-md-4">
            <label for="correofamiliar" class="form-label">{{ __('Correo') }}</label>
            <input type="text" name="correofamiliar" class="form-control @error('correofamiliar') is-invalid @enderror" value="{{ old('correofamiliar', $paciente?->correofamiliar) }}" id="correofamiliar" placeholder="Correo Electronico">
            {!! $errors->first('correofamiliar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>


        <br>
        <h4>ANTECEDENTES PATOLOGICOS</h4>
        <h5 class="mb-3">Antecedentes Generales:</h5>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="tabaco" class="form-label">{{ __('Tabaco') }}</label>
            <input type="text" name="tabaco" class="form-control @error('tabaco') is-invalid @enderror" value="{{ old('tabaco', $paciente?->tabaco) }}" id="tabaco" placeholder="Tabaco">
            {!! $errors->first('tabaco', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="alcochol" class="form-label">{{ __('Alcochol') }}</label>
            <input type="text" name="alcochol" class="form-control @error('alcochol') is-invalid @enderror" value="{{ old('alcochol', $paciente?->alcochol) }}" id="alcochol" placeholder="Alcochol">
            {!! $errors->first('alcochol', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="alergia" class="form-label">{{ __('Alergia') }}</label>
            <input type="text" name="alergia" class="form-control @error('alergia') is-invalid @enderror" value="{{ old('alergia', $paciente?->alergia) }}" id="alergia" placeholder="Alergia">
            {!! $errors->first('alergia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>

        <h5 class="mb-3">Antecedentes Fisiologicos</h5>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="sed" class="form-label">{{ __('Sed') }}</label>
            <input type="text" name="sed" class="form-control @error('sed') is-invalid @enderror" value="{{ old('sed', $paciente?->sed) }}" id="sed" placeholder="Sed">
            {!! $errors->first('sed', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="apetito" class="form-label">{{ __('Apetito') }}</label>
            <input type="text" name="apetito" class="form-control @error('apetito') is-invalid @enderror" value="{{ old('apetito', $paciente?->apetito) }}" id="apetito" placeholder="Apetito">
            {!! $errors->first('apetito', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="miccion" class="form-label">{{ __('Miccion') }}</label>
            <input type="text" name="miccion" class="form-control @error('miccion') is-invalid @enderror" value="{{ old('miccion', $paciente?->miccion) }}" id="miccion" placeholder="Miccion">
            {!! $errors->first('miccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>


        <h5 class="mb-3">Antecedentes Inmunologicos:</h5>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="les" class="form-label">{{ __('LES') }}</label>
            <input type="text" name="les" class="form-control @error('les') is-invalid @enderror" value="{{ old('les', $paciente?->les) }}" id="les" placeholder="LES">
            {!! $errors->first('les', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="vih" class="form-label">{{ __('VIH') }}</label>
            <input type="text" name="vih" class="form-control @error('vih') is-invalid @enderror" value="{{ old('vih', $paciente?->vih) }}" id="vih" placeholder="VIH">
            {!! $errors->first('vih', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="otros" class="form-label">{{ __('Otros') }}</label>
            <input type="text" name="otros" class="form-control @error('otros') is-invalid @enderror" value="{{ old('otros', $paciente?->otros) }}" id="otros" placeholder="Otros">
            {!! $errors->first('otros', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>

        <h5 class="mb-3">Antecedentes Patologicos:</h5>
        <div class="row mb-3">
        <div class="col-md-3">
            <label for="hta" class="form-label">{{ __('HTA') }}</label>
            <input type="text" name="hta" class="form-control @error('hta') is-invalid @enderror" value="{{ old('hta', $paciente?->hta) }}" id="hta" placeholder="HTA">
            {!! $errors->first('hta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-3">
            <label for="anemia" class="form-label">{{ __('Anemia') }}</label>
            <input type="text" name="anemia" class="form-control @error('anemia') is-invalid @enderror" value="{{ old('anemia', $paciente?->anemia) }}" id="anemia" placeholder="Anemia">
            {!! $errors->first('anemia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-3">
            <label for="asma" class="form-label">{{ __('Asma') }}</label>
            <input type="text" name="asma" class="form-control @error('asma') is-invalid @enderror" value="{{ old('asma', $paciente?->asma) }}" id="asma" placeholder="Asma">
            {!! $errors->first('asma', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-3">
            <label for="tbc" class="form-label">{{ __('TBC') }}</label>
            <input type="text" name="tbc" class="form-control @error('tbc') is-invalid @enderror" value="{{ old('tbc', $paciente?->tbc) }}" id="tbc" placeholder="TBC">
            {!! $errors->first('tbc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>



        <h5 class="mb-3">Antecedentes Familiares:</h5>
        <div class="row mb-3">
        <div class="col-md-3">
            <label for="htaf" class="form-label">{{ __('HTA') }}</label>
            <input type="text" name="htaf" class="form-control @error('htaf') is-invalid @enderror" value="{{ old('htaf', $paciente?->htaf) }}" id="htaf" placeholder="HTA">
            {!! $errors->first('htaf', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-3">
            <label for="anemiaf" class="form-label">{{ __('Anemia') }}</label>
            <input type="text" name="anemiaf" class="form-control @error('anemiaf') is-invalid @enderror" value="{{ old('anemiaf', $paciente?->anemiaf) }}" id="anemiaf" placeholder="Anemia">
            {!! $errors->first('anemiaf', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-3">
            <label for="asmaf" class="form-label">{{ __('Asma') }}</label>
            <input type="text" name="asmaf" class="form-control @error('asmaf') is-invalid @enderror" value="{{ old('asmaf', $paciente?->asmaf) }}" id="asmaf" placeholder="Asma">
            {!! $errors->first('asmaf', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-3">
            <label for="tbcf" class="form-label">{{ __('TBC') }}</label>
            <input type="text" name="tbcf" class="form-control @error('tbcf') is-invalid @enderror" value="{{ old('tbcf', $paciente?->tbcf) }}" id="tbcf" placeholder="TBC">
            {!! $errors->first('tbcf', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>




        <h5 class="mb-3">Antecedentes Epidemiologicos:</h5>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="dengue" class="form-label">{{ __('Dengue') }}</label>
            <input type="text" name="dengue" class="form-control @error('dengue') is-invalid @enderror" value="{{ old('dengue', $paciente?->dengue) }}" id="dengue" placeholder="Dengue">
            {!! $errors->first('dengue', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="fiebre" class="form-label">{{ __('Fiebre Amarilla') }}</label>
            <input type="text" name="fiebre" class="form-control @error('fiebre') is-invalid @enderror" value="{{ old('fiebre', $paciente?->fiebre) }}" id="fiebre" placeholder="Fiebre Amarilla">
            {!! $errors->first('fiebre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="its" class="form-label">{{ __('ITS') }}</label>
            <input type="text" name="its" class="form-control @error('its') is-invalid @enderror" value="{{ old('its', $paciente?->its) }}" id="its" placeholder="ITS">
            {!! $errors->first('its', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>



        <h5 class="mb-3">Antecedentes Ocupacionales:</h5>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="stress" class="form-label">{{ __('Stress') }}</label>
            <input type="text" name="stress" class="form-control @error('stress') is-invalid @enderror" value="{{ old('stress', $paciente?->stress) }}" id="stress" placeholder="Stress">
            {!! $errors->first('stress', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="trauma" class="form-label">{{ __('Trauma Acustico') }}</label>
            <input type="text" name="trauma" class="form-control @error('trauma') is-invalid @enderror" value="{{ old('trauma', $paciente?->trauma) }}" id="trauma" placeholder="Trauma Acustico">
            {!! $errors->first('trauma', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>


        <h5 class="mb-3">Otros Antecedentes:</h5>
        <div class="row mb-3">
        <div class="col-md-5">
            <label for="farmacologicos" class="form-label">{{ __('Antecedentes Farmacologicos') }}</label>
            <input type="text" name="farmacologicos" class="form-control @error('farmacologicos') is-invalid @enderror" value="{{ old('farmacologicos', $paciente?->farmacologicos) }}" id="farmacologicos" placeholder="Antecedentes Farmacologicos">
            {!! $errors->first('farmacologicos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-5">
            <label for="especificacion" class="form-label">{{ __('Especificacion de Antecedentes') }}</label>
            <input type="text" name="especificacion" class="form-control @error('especificacion') is-invalid @enderror" value="{{ old('especificacion', $paciente?->especificacion) }}" id="especificacion" placeholder="Especificacion de Antecedentes">
            {!! $errors->first('especificacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>



        <br>
        <h4>ENFERMEDAD ACTUAL</h4>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="fechae" class="form-label">{{ __('Fecha') }}</label>
            <input type="date" name="fechae" class="form-control @error('fechae') is-invalid @enderror" value="{{ old('fechae', $paciente?->fechae) }}" id="fechae" placeholder="Fecha">
            {!! $errors->first('fechae', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="hora" class="form-label">{{ __('Hora de Atencion') }}</label>
            <input type="time" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora', $paciente?->hora) }}" id="hora" placeholder="Hora de Atencion">
            {!! $errors->first('hora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>



        <div class="row mb-3">
        <div class="col-md-4">
            <label for="motivo" class="form-label">{{ __('Motivo de Consulta') }}</label>
            <input type="text" name="motivo" class="form-control @error('motivo') is-invalid @enderror" value="{{ old('motivo', $paciente?->motivo) }}" id="motivo" placeholder="Motivo de Consulta">
            {!! $errors->first('motivo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="tiempo" class="form-label">{{ __('Tiempo de la Enfermedad') }}</label>
            <input type="text" name="tiempo" class="form-control @error('tiempo') is-invalid @enderror" value="{{ old('tiempo', $paciente?->tiempo) }}" id="tiempo" placeholder="Tiempo de la Enfermedad">
            {!! $errors->first('tiempo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="sintomas" class="form-label">{{ __('Sintomas Principales') }}</label>
            <input type="text" name="sintomas" class="form-control @error('sintomas') is-invalid @enderror" value="{{ old('sintomas', $paciente?->sintomas) }}" id="sintomas" placeholder="Sintomas Principales">
            {!! $errors->first('sintomas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>



        <div class="row mb-3">
        <div class="col-md-4">
            <label for="relato" class="form-label">{{ __('Relato Cronologico') }}</label>
            <input type="text" name="relato" class="form-control @error('relato') is-invalid @enderror" value="{{ old('relato', $paciente?->relato) }}" id="relato" placeholder="Relato Cronologico">
            {!! $errors->first('relato', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="funciones" class="form-label">{{ __('Funciones Biologicas') }}</label>
            <input type="text" name="funciones" class="form-control @error('funciones') is-invalid @enderror" value="{{ old('funciones', $paciente?->funciones) }}" id="funciones" placeholder="Funciones Biologicas">
            {!! $errors->first('funciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>




        <br>
        <h4>EXAMEN CLINICO</h4>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado General') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $paciente?->estado) }}" id="estado" placeholder="Estado General">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="pa" class="form-label">{{ __('Pa') }}</label>
            <input type="text" name="pa" class="form-control @error('pa') is-invalid @enderror" value="{{ old('pa', $paciente?->pa) }}" id="pa" placeholder="Pa">
            {!! $errors->first('pa', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="peso" class="form-label">{{ __('Peso') }}</label>
            <input type="text" name="peso" class="form-control @error('peso') is-invalid @enderror" value="{{ old('peso', $paciente?->peso) }}" id="peso" placeholder="Peso">
            {!! $errors->first('peso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="talla" class="form-label">{{ __('Talla') }}</label>
            <input type="text" name="talla" class="form-control @error('talla') is-invalid @enderror" value="{{ old('talla', $paciente?->talla) }}" id="talla" placeholder="Talla">
            {!! $errors->first('talla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>



        <div class="row mb-3">
        <div class="col-md-4">
            <label for="tº" class="form-label">{{ __('Tº') }}</label>
            <input type="text" name="tº" class="form-control @error('tº') is-invalid @enderror" value="{{ old('tº', $paciente?->tº) }}" id="tº" placeholder="Tº">
            {!! $errors->first('tº', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="fc" class="form-label">{{ __('Fc') }}</label>
            <input type="text" name="fc" class="form-control @error('fc') is-invalid @enderror" value="{{ old('fc', $paciente?->fc) }}" id="fc" placeholder="Fc">
            {!! $errors->first('fc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-4">
            <label for="fr" class="form-label">{{ __('Fr') }}</label>
            <input type="text" name="fr" class="form-control @error('fr') is-invalid @enderror" value="{{ old('fr', $paciente?->fr) }}" id="fr" placeholder="Fr">
            {!! $errors->first('fr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        </div>



        <br>
        <h4>EVALUACION ODONTOLOGICA</h4>
        <div class="form-group mb-2 mb20">
            <label for="intraoral" class="form-label">{{ __('Examen Intra Oral') }}</label>
            <input type="text" name="intraoral" class="form-control @error('intraoral') is-invalid @enderror" value="{{ old('intraoral', $paciente?->intraoral) }}" id="intraoral" placeholder="Examen Intra Oral">
            {!! $errors->first('intraoral', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="extraoral" class="form-label">{{ __('Examen Extra Oral') }}</label>
            <input type="text" name="extraoral" class="form-control @error('extraoral') is-invalid @enderror" value="{{ old('extraoral', $paciente?->extraoral) }}" id="extraoral" placeholder="Examen Extra Oral">
            {!! $errors->first('extraoral', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>