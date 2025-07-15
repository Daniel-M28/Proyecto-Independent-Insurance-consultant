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
      $role1= Role::create(['name' => 'administrador']);
      $role2= Role::create(['name' => 'asesor']);
      $role3= Role::create(['name' => 'usuario']);

      Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
      Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
      Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1]);
    }
}
