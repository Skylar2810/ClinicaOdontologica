<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiografia extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'imagen', 'nombre', 'descripcion'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}

