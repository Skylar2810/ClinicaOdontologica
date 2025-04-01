<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    public function adminlte_desc (){
        $user = auth()->user();

        // Obtener el primer rol asignado al usuario
        $role = $user->getRoleNames()->first();
        
        // Si el usuario no tiene roles, puedes asignar un valor predeterminado
        $role = $role ?: 'Sin rol'; // Por ejemplo, si no tiene rol asignado, devuelve 'Sin rol'
        
        // Puedes hacer lo que necesites con la variable $role, como retornarlo o usarlo en la vista
        return $role;
    }
}
