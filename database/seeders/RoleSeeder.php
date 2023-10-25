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
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $developer = Role::create(['name' => 'developer']);

        Permission::create(['name' => 'home'])->syncRoles([$admin, $manager, $developer]);
        Permission::create(['name' => 'admin'])->syncRoles([$admin]);
        Permission::create(['name' => 'manager'])->syncRoles([$manager]);
        Permission::create(['name' => 'developer'])->syncRoles([$admin, $manager, $developer]);
    }
}
