<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


// TODO: Show Roles
it('can access roles index with view roles permission', function () {
    // Crear el permiso
    $permission = Permission::create(['name' => 'view roles']);
    
    // Crear el rol y asignarle el permiso
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo($permission);

    // Crear un usuario y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Autenticar al usuario y realizar la solicitud
    $response = $this->actingAs($user)->get(route('roles.index'));

    // Verificar que la respuesta sea exitosa
    $response->assertStatus(200);
});



//TODO: Create a role
it('can access create roles page with create roles permission', function () {
    // Crear el permiso
    $permission = Permission::create(['name' => 'create roles']);
    
    // Crear el rol y asignarle el permiso
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo($permission);

    // Crear un usuario y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Autenticar al usuario y realizar la solicitud
    $response = $this->actingAs($user)->get(route('roles.create'));

    // Verificar que la respuesta sea exitosa
    $response->assertStatus(200);
});



//  TODO: Edit Role 
it('can edit a role with edit roles permission', function () {
    // Crear el permiso 'edit roles'
    $permission = Permission::create(['name' => 'edit roles']);
    
    // Crear el rol y asignarle el permiso
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo($permission);

    // Crear un usuario y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Autenticar al usuario
    $this->actingAs($user);

    // Realizar la solicitud GET a la ruta de edición del rol
    $response = $this->get(route('roles.edit', $role->id));

    // Verificar que el usuario accede correctamente a la página de edición
    $response->assertStatus(200); // Espera un estado HTTP 200 (éxito)

    // Verificar que la vista contiene el rol y los permisos correctos
    $response->assertViewIs('roles.edit'); // Verifica si la vista es la esperada
    $response->assertViewHas('role', $role); // Verifica que el rol esté presente en la vista
    $response->assertViewHas('permissions'); // Verifica que los permisos estén presentes en la vista
});


//TODO: Update Roles
it('can update a role with update roles permission', function () {
    // Crear los permisos necesarios
    Permission::create(['name' => 'update roles', 'guard_name' => 'web']);
    Permission::create(['name' => 'view roles', 'guard_name' => 'web']);
    Permission::create(['name' => 'edit roles', 'guard_name' => 'web']);

    // Crear el rol y asignarle el permiso necesario
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo('update roles');

    // Crear un usuario y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Autenticar al usuario
    $this->actingAs($user);

    // Datos de la solicitud para actualizar el rol
    $roleData = [
        'name' => 'updated_role',
        'permission' => ['view roles', 'edit roles']
    ];

    // Realizar la solicitud PUT a la ruta de actualización del rol
    $response = $this->put(route('roles.update', $role->id), $roleData);

    // Verificar que el rol fue actualizado y redirige correctamente
    $response->assertRedirect(route('roles.index'));

    // Verificar que el rol se actualizó en la base de datos
    $this->assertDatabaseHas('roles', ['name' => 'updated_role']);

    // Verificar que los permisos se hayan sincronizado correctamente
    $role->refresh();
    $this->assertTrue($role->hasPermissionTo('view roles'));
    $this->assertTrue($role->hasPermissionTo('edit roles'));
});


