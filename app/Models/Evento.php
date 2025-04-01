<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evento
 *
 * @property int $id
 * @property string $title
 * @property string $hora
 * @property int $pacientes_id
 * @property int $especialidades_id
 * @property string $descripcion
 * @property string $fecha
 * @property string $color
 *
 * @property Especialidade $especialidade
 * @property Paciente $paciente
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Evento extends Model
{
    use HasFactory;

    static $rules = [
        'title'             => 'required|string',
        'hora'              => 'required',
        'pacientes_id'      => 'required',
        'especialidades_id' => 'required',
        'descripcion'       => 'nullable|string',
        'fecha'             => 'required|date',
        'color'             => 'nullable|string'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'hora',
        'pacientes_id',
        'especialidades_id',
        'descripcion',
        'fecha',
        'color'
    ];

    /**
     * Relación con Especialidade
     */
    public function especialidade()
    {
        return $this->belongsTo(\App\Models\Especialidade::class, 'especialidades_id', 'id');
    }
    
    /**
     * Relación con Paciente
     */
    public function paciente()
    {
        return $this->belongsTo(\App\Models\Paciente::class, 'pacientes_id', 'id');
    }

    public function especialidad() // Cambiar a singular
{
    return $this->belongsTo(\App\Models\Especialidade::class, 'especialidades_id', 'id');
}
}
