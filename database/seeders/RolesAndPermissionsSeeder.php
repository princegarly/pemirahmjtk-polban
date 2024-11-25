<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $Administrator = Role::create(['name' => 'administrator', 'guard_name' => 'web']);
        $Operator = Role::create(['name' => 'operator', 'guard_name' => 'web']);
        $Witness = Role::create(['name' => 'witness', 'guard_name' => 'web']);
        $Voters = Role::create(['name' => 'voters', 'guard_name' => 'web']);
    }
}
