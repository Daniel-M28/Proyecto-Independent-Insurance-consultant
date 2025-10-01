<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  Ejecutar seeder de roles
        $this->call([
            RoleSeeder::class,
        ]);

        // Crear usuarios de prueba con factory
        \App\Models\User::factory()->count(10)->create();

        //  Crear usuario administrador
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // evita duplicados
            [
                'name' => 'Admin',
                'lastname' => 'User', //  agregado para evitar error
                'password' => bcrypt('password123'),
            ]
        );

        if (! $admin->hasRole('administrador')) {
            $admin->assignRole($adminRole);
        }
    }
}
