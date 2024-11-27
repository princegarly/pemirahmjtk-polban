<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $Permissions = [
            'dashboard',
            'user-create',
            'user-read',
            'user-update',
            'user-delete',
            'user-import',
            'role-create',
            'role-read',
            'role-update',
            'role-delete',
            'permission-read',
            'study-program-create',
            'study-program-read',
            'study-program-update',
            'study-program-delete',
            'grade-create',
            'grade-read',
            'grade-update',
            'grade-delete',
            'candidate-create',
            'candidate-read',
            'candidate-update',
            'candidate-delete',
            'election-status-already',
            'election-status-not-yet',
            'polling-booth',
            'result',
        ];

        foreach ($Permissions as $Permission) {
            Permission::create(['name' => $Permission]);
        }

        $administrator = Role::create(['name' => 'administrator', 'guard_name' => 'web']);
        $administrator->givePermissionTo('dashboard');
        $administrator->givePermissionTo('user-create');
        $administrator->givePermissionTo('user-read');
        $administrator->givePermissionTo('user-update');
        $administrator->givePermissionTo('user-delete');
        $administrator->givePermissionTo('user-import');
        $administrator->givePermissionTo('role-create');
        $administrator->givePermissionTo('role-read');
        $administrator->givePermissionTo('role-update');
        $administrator->givePermissionTo('role-delete');
        $administrator->givePermissionTo('permission-read');
        $administrator->givePermissionTo('study-program-create');
        $administrator->givePermissionTo('study-program-read');
        $administrator->givePermissionTo('study-program-update');
        $administrator->givePermissionTo('study-program-delete');
        $administrator->givePermissionTo('grade-create');
        $administrator->givePermissionTo('grade-read');
        $administrator->givePermissionTo('grade-update');
        $administrator->givePermissionTo('grade-delete');
        $administrator->givePermissionTo('candidate-create');
        $administrator->givePermissionTo('candidate-read');
        $administrator->givePermissionTo('candidate-update');
        $administrator->givePermissionTo('candidate-delete');
        $administrator->givePermissionTo('election-status-already');
        $administrator->givePermissionTo('election-status-not-yet');
        $administrator->givePermissionTo('result');

        $operator = Role::create(['name' => 'operator', 'guard_name' => 'web']);
        $operator->givePermissionTo('dashboard');
        $operator->givePermissionTo('user-create');
        $operator->givePermissionTo('user-read');
        $operator->givePermissionTo('user-update');
        $operator->givePermissionTo('user-delete');
        $operator->givePermissionTo('user-import');
        $operator->givePermissionTo('candidate-create');
        $operator->givePermissionTo('candidate-read');
        $operator->givePermissionTo('candidate-update');
        $operator->givePermissionTo('candidate-delete');
        $operator->givePermissionTo('election-status-already');
        $operator->givePermissionTo('election-status-not-yet');
        $operator->givePermissionTo('result');

        $witness = Role::create(['name' => 'witness', 'guard_name' => 'web']);
        $witness->givePermissionTo('dashboard');
        $witness->givePermissionTo('election-status-already');
        $witness->givePermissionTo('election-status-not-yet');
        $witness->givePermissionTo('result');

        $voters = Role::create(['name' => 'voters', 'guard_name' => 'web']);
        $voters->givePermissionTo('dashboard');
        $voters->givePermissionTo('polling-booth');
    }
}
