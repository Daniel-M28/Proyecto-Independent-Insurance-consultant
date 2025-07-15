<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Llama al seeder de roles
    // $this->call([
    //     RoleSeeder::class,
    // ]);

       \App\Models\User::factory()->count(50)->create();
}
}
