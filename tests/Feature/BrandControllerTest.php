<?php


use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

it('tem a página do brandcontroller', function () {
    // Criar uma permissão e um papel
    $permission = Permission::create(['name' => 'view brands']);  // A permissão necessária
    $role = Role::create(['name' => 'admin']);  // O papel necessário

    // Atribuir a permissão ao papel
    $role->givePermissionTo($permission);

    // Criar um usuário de teste e atribuir-lhe o papel
    $user = User::factory()->create();
    $user->assignRole($role);  // Atribuir o papel ao usuário

    // Autenticar o usuário e testar a rota
    $response = $this->actingAs($user)->get('/brands');  // Realiza a solicitação como um usuário autenticado

    // Verificar se a resposta foi bem-sucedida
    $response->assertStatus(200);
});

