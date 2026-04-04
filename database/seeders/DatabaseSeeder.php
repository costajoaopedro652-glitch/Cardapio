<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
   public function run()
{
    // limpar cache do Spatie
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // permissões
    Permission::firstOrCreate(['name' => 'ver pedidos']);
    Permission::firstOrCreate(['name' => 'ver cardapio']);


    // roles
    $admin = Role::firstOrCreate(['name' => 'admin']);
    $room = Role::firstOrCreate(['name' => 'room']);

    // permissões do admin
    $admin->syncPermissions([
        'ver pedidos'
    ]);

    // permissões do room
    $room->syncPermissions([
        'ver cardapio'
    ]);

    // User Admin
    $adminUser= User::firstOrCreate(
        ['email'=>'admin@gmail.com'],
        [
            'name'=>'admin',
            'password'=> Hash::make(12345678)
        ]
        );
        $adminUser->assignRole($admin);
        //User room
        $roomUser = User::firstOrcreate(
            ['email'=>'room@gmail.com'],
            [
                'name'=>'room',
                'password'=> Hash::make(12345678)
            ]
            );
        $roomUser->assignRole($room);

//criação dos items teste

        Item::firstOrCreate(
            ['name'=>'hamburguer','categoria'=>'noite'],
            ['price'=>10,'is_available'=>1]
        );
        Item::firstOrCreate(
            ['name'=>'lasanha','categoria'=>'almoço'],
            ['price'=>15,'is_available'=>1]
        );
        Item::firstOrCreate(
            ['name'=>'café','categoria'=>'manha'],
            ['price'=>4,'is_available'=>1]
            
        );
        Item::firstOrCreate(
            ['name'=>'agua','categoria'=>'tarde'],
            ['price'=>5,'is_available'=>1]
            
        );
}
}
