<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar o criar a Role Admin
        $adminRole = Role::where('name', 'admin')->first();

        // Nao existe a Role Admin?
        if (!$adminRole) {
            $this->command->error("O papel 'admin' não existe. Execute 'php artisan db:seed --class=RoleSeeder' primeiro.");
            return;
        }

         // Criamos o usuario Admin por default
         $admin = User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password123') // Cambia esto en producción
        ]);

        // Asignar a rol admin ao usuario
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

          // Asignamos as pemissoes 
          $admin->syncPermissions(Permission::all());
    }
}
