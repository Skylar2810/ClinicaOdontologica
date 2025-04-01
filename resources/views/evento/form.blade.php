<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="title" class="form-label">{{ __('Title') }}</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $evento?->title) }}" id="title" placeholder="Title">
            {!! $errors->first('title', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora" class="form-label">{{ __('Hora') }}</label>
            <input type="time" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora', $evento?->hora) }}" id="hora" placeholder="Hora">
            {!! $errors->first('hora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
         <div class="form-group mb-2 mb20">
            <label for="pacientes_id" class="form-label">{{ __('Pacientes Id') }}</label>
            <select name="pacientes_id" class="form-control @error('pacientes_id') is-invalid @enderror" id="pacientes_id">
                <option value="">{{ __('Seleccione al Paciente') }}</option>
                     @foreach($pacientes as $id => $nombres)
                      <option value="{{ $id }}" {{ old('pacientes_id', $evento->pacientes_id) == $id ? 'selected' : '' }}>
                             {{ $nombres }}
                        </option>
                     @endforeach
            </select>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="especialidades_id" class="form-label">{{ __('Especialidades Id') }}</label>
            <select name="especialidades_id" class="form-control @error('especialidades_id') is-invalid @enderror" id="especialidades_id">
                <option value="">{{ __('Seleccione la Especialidad') }}</option>
                     @foreach($especialidades as $id => $descripcion)
                      <option value="{{ $id }}" {{ old('especialidades_id', $evento->especialidades_id) == $id ? 'selected' : '' }}>
                             {{ $descripcion }}
                        </option>
                     @endforeach
            </select>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $evento?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="start" class="form-label">{{ __('Start') }}</label>
            <input type="text" name="start" class="form-control @error('start') is-invalid @enderror" value="{{ old('start', $evento?->start) }}" id="start" placeholder="Start">
            {!! $errors->first('start', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="end" class="form-label">{{ __('End') }}</label>
            <input type="text" name="end" class="form-control @error('end') is-invalid @enderror" value="{{ old('end', $evento?->end) }}" id="end" placeholder="End">
            {!! $errors->first('end', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
</div>