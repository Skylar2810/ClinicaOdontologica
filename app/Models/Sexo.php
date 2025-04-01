<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sexo
 *
 * @property $id
 * @property $Descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Paciente[] $pacientes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sexo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['Descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany(\App\Models\Paciente::class, 'id', 'sexos_id');
    }
    
}
