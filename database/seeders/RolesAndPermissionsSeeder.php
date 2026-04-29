<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permisos
        // Permisos (por módulo)
        Permission::create(['name' => 'acceso dashboard']);
        Permission::create(['name' => 'acceso usuarios']);
        Permission::create(['name' => 'acceso roles']);

        // Roles
        $admin = Role::create(['name' => 'admin']);
        $supervisor = Role::create(['name' => 'supervisor']);
        $tecnico = Role::create(['name' => 'tecnico']);
        $user = Role::create(['name' => 'user']);

        // Admin tiene acceso a todo
        $admin->givePermissionTo(Permission::all());

        // Usuario normal solo a dashboard
        $user->givePermissionTo([
            'acceso dashboard'
        ]);
    }
}
