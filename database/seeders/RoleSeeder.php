<?php

namespace Database\Seeders;

use App\Models\type_permissions;
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
        $type = type_permissions::create(['name' => 'auth']);

        $admin = Role::create(['name' => 'admin developer']);
        $manager = Role::create(['name' => 'manager']);
        $developer = Role::create(['name' => 'developer']);

        Permission::create(['name' => 'home'])->syncRoles([$admin, $manager, $developer]);
        Permission::create(['name' => 'admin'])->syncRoles([$admin]);
        Permission::create(['name' => 'manager'])->syncRoles([$manager]);
        Permission::create(['name' => 'developer'])->syncRoles([$admin, $manager, $developer]);

        Permission::create(['name' => 'auth', 'type_permissions_id' => $type->id])->syncRoles([$admin]);
        Permission::create(['name' => 'users', 'type_permissions_id' => $type->id])->syncRoles([$admin]);
        Permission::create(['name' => 'roles', 'type_permissions_id' => $type->id])->syncRoles([$admin]);
        Permission::create(['name' => 'permissions', 'type_permissions_id' => $type->id])->syncRoles([$admin]);
        Permission::create(['name' => 'typepermissions', 'type_permissions_id' => $type->id])->syncRoles([$admin]);
    }
}
