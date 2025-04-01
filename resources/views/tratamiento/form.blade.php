<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $tratamiento?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="pacientes_id" class="form-label">{{ __('Pacientes') }}</label>
            <select name="pacientes_id" class="form-control @error('pacientes_id') is-invalid @enderror" id="pacientes_id">
                <option value="">{{ __('Seleccione al Paciente') }}</option>
                     @foreach($pacientes as $id => $nombres)
                      <option value="{{ $id }}" {{ old('pacientes_id', $tratamiento?->pacientes_id) == $id ? 'selected' : '' }}>
                             {{ $nombres }}
                        </option>
                     @endforeach
            </select>
        
        </div>
        <div class="form-group mb-2 mb20">
            <label for="pieza" class="form-label">{{ __('Pieza') }}</label>
            <input type="text" name="pieza" class="form-control @error('pieza') is-invalid @enderror" value="{{ old('pieza', $tratamiento?->pieza) }}" id="pieza" placeholder="Pieza">
            {!! $errors->first('pieza', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="especialidades_id" class="form-label">{{ __('Tratamiento a Realizar') }}</label>
            <select name="especialidades_id" class="form-control @error('especialidades_id') is-invalid @enderror" id="especialidades_id">
                <option value="">{{ __('Seleccione el tratamiento') }}</option>
                     @foreach($especialidades as $id => $descripcion)
                      <option value="{{ $id }}" {{ old('especialidades_id', $tratamiento?->especialidades_id) == $id ? 'selected' : '' }}>
                             {{ $descripcion }}
                        </option>
                     @endforeach
            </select>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="seguimiento" class="form-label">{{ __('Seguimiento') }}</label>
            <input type="text" name="seguimiento" class="form-control @error('seguimiento') is-invalid @enderror" value="{{ old('seguimiento', $tratamiento?->seguimiento) }}" id="seguimiento" placeholder="Seguimiento">
            {!! $errors->first('seguimiento', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="presupuesto" class="form-label">{{ __('Presupuesto') }}</label>
            <input type="text" name="presupuesto" class="form-control @error('presupuesto') is-invalid @enderror" value="{{ old('presupuesto', $tratamiento?->presupuesto) }}" id="presupuesto" placeholder="Presupuesto">
            {!! $errors->first('presupuesto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>