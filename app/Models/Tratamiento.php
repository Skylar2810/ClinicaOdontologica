<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tratamiento
 *
 * @property $id
 * @property $fecha
 * @property $pacientes_id
 * @property $pieza
 * @property $especialidades_id
 * @property $seguimiento
 * @property $presupuesto
 * @property $created_at
 * @property $updated_at
 *
 * @property Especialidade $especialidade
 * @property Paciente $paciente
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tratamiento extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fecha', 'pacientes_id', 'pieza', 'especialidades_id', 'seguimiento', 'presupuesto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function especialidade()
    {
        return $this->belongsTo(\App\Models\Especialidade::class, 'especialidades_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paciente()
    {
        return $this->belongsTo(\App\Models\Paciente::class, 'pacientes_id', 'id');
    }
    
 
    public function seguimiento()
    {
        return $this->hasMany(\App\Models\Seguimiento::class, 'tratamiento_id')->orderBy('fecha_seguimiento', 'desc');
    }

    
}
