<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paciente
 *
 * @property $id
 * @property $nombres
 * @property $ci
 * @property $edad
 * @property $ocupacion
 * @property $lugar
 * @property $fechap
 * @property $telcel
 * @property $correo
 * @property $domicilio
 * @property $nombresfamiliar
 * @property $edadfamiliar
 * @property $telcelfamiliar
 * @property $correofamiliar
 * @property $tabaco
 * @property $alcochol
 * @property $alergia
 * @property $sed
 * @property $apetito
 * @property $miccion
 * @property $les
 * @property $vih
 * @property $otros
 * @property $hta
 * @property $anemia
 * @property $asma
 * @property $tbc
 * @property $htaf
 * @property $anemiaf
 * @property $asmaf
 * @property $tbcf
 * @property $dengue
 * @property $fiebre
 * @property $its
 * @property $stress
 * @property $trauma
 * @property $farmacologicos
 * @property $especificacion
 * @property $fechae
 * @property $hora
 * @property $motivo
 * @property $tiempo
 * @property $sintomas
 * @property $relato
 * @property $funciones
 * @property $estado
 * @property $pa
 * @property $peso
 * @property $talla
 * @property $tº
 * @property $fc
 * @property $fr
 * @property $intraoral
 * @property $extraoral
 * @property $sexos_id
 * @property $estados_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Estado $estado
 * @property Sexo $sexo
 * @property Tratamiento[] $tratamientos
 * @property Pago[] $pagos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Paciente extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombres', 'ci', 'edad', 'ocupacion', 'lugar', 'fechap', 'telcel', 'correo', 'domicilio', 'nombresfamiliar', 'edadfamiliar', 'telcelfamiliar', 'correofamiliar', 'tabaco', 'alcochol', 'alergia', 'sed', 'apetito', 'miccion', 'les', 'vih', 'otros', 'hta', 'anemia', 'asma', 'tbc', 'htaf', 'anemiaf', 'asmaf', 'tbcf', 'dengue', 'fiebre', 'its', 'stress', 'trauma', 'farmacologicos', 'especificacion', 'fechae', 'hora', 'motivo', 'tiempo', 'sintomas', 'relato', 'funciones', 'estado', 'pa', 'peso', 'talla', 'tº', 'fc', 'fr', 'intraoral', 'extraoral', 'sexos_id', 'estados_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class, 'estados_id', 'descripcion');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sexo()
    {
        return $this->belongsTo(\App\Models\Sexo::class, 'sexos_id', 'id');
    }

    public function tratamientos()
    {
        return $this->hasMany(\App\Models\Tratamiento::class, 'id', 'paciente_id');
    }

       /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagos()
    {
        return $this->hasMany(\App\Models\Pago::class, 'id', 'pacientes_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    
}
