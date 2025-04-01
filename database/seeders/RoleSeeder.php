<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Evitar duplicados con firstOrCreate()
        $role1 = Role::firstOrCreate(['name' => 'Admin']);
        $role2 = Role::firstOrCreate(['name' => 'Paciente']);

        // Crear permisos y asignarlos a roles
        $permissions = [
            'home' => [$role1, $role2],
            'pacientes.index' => [$role1],
            'pacientes.create' => [$role1],
            'pacientes.edit' => [$role1],
            'pacientes.show' => [$role1],
            'pacientes.destroy' => [$role1],
            'tratamientos.index' => [$role1],
            'tratamientos.create' => [$role1],
            'tratamientos.edit' => [$role1],
            'tratamientos.show' => [$role1],
            'tratamientos.destroy' => [$role1],
            'especialidades.index' => [$role1],
            'especialidades.create' => [$role1],
            'especialidades.edit' => [$role1],
            'especialidades.show' => [$role1],
            'especialidades.destroy' => [$role1],
            'pagos.index' => [$role1, $role2],
            'pagos.create' => [$role1],
            'pagos.edit' => [$role1],
            'pagos.show' => [$role1, $role2],
            'pagos.destroy' => [$role1],
            'eventos.index' => [$role1],
            'eventos.create' => [$role1],
            'eventos.edit' => [$role1],
            'eventos.show' => [$role1],
            'eventos.destroy' => [$role1],
            'eventos.citas' => [$role2],
            'usuarios.index' => [$role1, $role2],
            'usuarios.create' => [$role1],
            'usuarios.edit' => [$role1],
            'usuarios.show' => [$role1],
            'usuarios.destroy' => [$role1]
        ];

        foreach ($permissions as $permiso => $roles) {
            $permission = Permission::firstOrCreate(['name' => $permiso]);
            $permission->syncRoles($roles);
        }
    }
}
