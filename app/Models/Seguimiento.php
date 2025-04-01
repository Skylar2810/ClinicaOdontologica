<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $table = 'seguimientos';

    protected $fillable = [
        'tratamiento_id',
        'seguimiento',
        'estado',
        'fecha_seguimiento',
    ];

    // Relación con Tratamiento
    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class);
    }
}
