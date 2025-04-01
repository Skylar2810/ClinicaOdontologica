<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'nombres' => 'required|string',
			'ci' => 'required|string',
			'edad' => 'required|string',
			'ocupacion' => 'required|string',
			'lugar' => 'required|string',
			'fechap' => 'required',
			'telcel' => 'required|string',
			'correo' => 'required|string',
			'domicilio' => 'required|string',
			'nombresfamiliar' => 'required|string',
			'edadfamiliar' => 'required|string',
			'telcelfamiliar' => 'required|string',
			'correofamiliar' => 'required|string',
			'tabaco' => 'string',
			'alcochol' => 'string',
			'alergia' => 'string',
			'sed' => 'string',
			'apetito' => 'string',
			'miccion' => 'string',
			'les' => 'string',
			'vih' => 'string',
			'otros' => 'string',
			'hta' => 'string',
			'anemia' => 'string',
			'asma' => 'string',
			'tbc' => 'string',
			'htaf' => 'string',
			'anemiaf' => 'string',
			'asmaf' => 'string',
			'tbcf' => 'string',
			'dengue' => 'string',
			'fiebre' => 'string',
			'its' => 'string',
			'stress' => 'string',
			'trauma' => 'string',
			'farmacologicos' => 'string',
			'especificacion' => 'string',
			'fechae' => 'required',
			'hora' => 'required',
			'motivo' => 'required|string',
			'tiempo' => 'required|string',
			'sintomas' => 'required|string',
			'relato' => 'required|string',
			'funciones' => 'required|string',
			'estado' => 'required|string',
			'pa' => 'required|string',
			'peso' => 'required|string',
			'talla' => 'required|string',
			'tº' => 'required|string',
			'fc' => 'required|string',
			'fr' => 'required|string',
			'intraoral' => 'string',
			'extraoral' => 'string',
			'sexos_id' => 'required',
			'estados_id' => 'required',
        ];
    }
}
