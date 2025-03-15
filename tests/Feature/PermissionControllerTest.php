<?php
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


// TODO: Show Permission
it('can access Permission index with view view permission', function () {
    // Crear el permiso
    $permission = Permission::create(['name' => 'view permissions']);
    
    // Crear el rol y asignarle el permiso
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo($permission);

    // Crear un usuario y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Autenticar al usuario y realizar la solicitud
    $response = $this->actingAs($user)->get(route('permissions.index'));

    // Verificar que la respuesta sea exitosa
    $response->assertStatus(200);
});


//TODO: Create a role
it('can access create Permission page with create create permission', function () {
    // Crear el permiso
    $permission = Permission::create(['name' => 'create permissions']);
    
    // Crear el rol y asignarle el permiso
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo($permission);

    // Crear un usuario y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Autenticar al usuario y realizar la solicitud
    $response = $this->actingAs($user)->get(route('permissions.create'));

    // Verificar que la respuesta sea exitosa
    $response->assertStatus(200);
});


