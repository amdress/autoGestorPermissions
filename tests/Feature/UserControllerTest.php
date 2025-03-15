<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


// TODO: Index Route
it('has user index page', function () {
    // Crear el permiso
    $permission = Permission::create(['name' => 'view users']);
    
    // Crear el rol y asignarle el permiso
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo($permission);

    // Crear un usuario de prueba y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Autenticar al usuario y realizar la solicitud
    $response = $this->actingAs($user)->get(route('users.index'));

    // Verificar que la respuesta sea exitosa
    $response->assertStatus(200);
});




//TODO : Show  Update User Page
it('has user edit page', function () {
    // Crear el permiso de editar usuarios
    $permission = Permission::create(['name' => 'edit users']);

    // Crear el rol y asignarle el permiso
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo($permission);

    // Crear un usuario de prueba y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Crear otro usuario para editar
    $userToEdit = User::factory()->create();

    // Autenticar al usuario y realizar la solicitud de edición
    $response = $this->actingAs($user)->get(route('users.edit', $userToEdit->id));

    // Verificar que la respuesta sea exitosa (200)
    $response->assertStatus(200);

    // Verificar que los datos del usuario estén presentes en la vista
    $response->assertViewHas('user', $userToEdit);
    $response->assertViewHas('roles');
    $response->assertViewHas('hasRoles');
});


//TODO: Edit User Route
it('can update user with edit permission', function () {
    // Crear el permiso y rol
    $permission = Permission::create(['name' => 'edit users']);
    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo($permission);

    // Crear un usuario de prueba y asignarle el rol
    $user = User::factory()->create();
    $user->assignRole($role);

    // Crear otro usuario para actualizar
    $userToUpdate = User::factory()->create();

    // Datos de la actualización
    $updatedData = [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
    ];

    // Autenticar al usuario y realizar la solicitud de actualización
    $response = $this->actingAs($user)->put(route('users.update', $userToUpdate->id), $updatedData);

    // Verificar la redirección después de la actualización
    $response->assertRedirect(route('users.index'));
    
    // Verificar que el usuario se haya actualizado en la base de datos
    $userToUpdate->refresh();
    expect($userToUpdate->name)->toBe($updatedData['name']);
    expect($userToUpdate->email)->toBe($updatedData['email']);
});
