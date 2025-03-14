<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //definimos los permissos
        $permissions = [
            'create users',
            'edit users',
            'view users',
            'delete users',
            'create roles',
            'edit roles',
            'view roles',
            'delete roles',
            'create permissions',
            'edit permissions',
            'view permissions',
            'delete permissions',
        ];

          // Crear permisos
          foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear el rol de administrador
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

         // Asignar todos los permisos al rol de admin
         $adminRole->syncPermissions(Permission::all());
    }
}
