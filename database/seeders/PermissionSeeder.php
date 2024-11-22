<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Administrator' => [
                'user:view',
                'user:create',
                'user:update',
                'user:delete',
                'role:view',
                'role:create',
                'role:update',
                'role:delete',
                'post:view',
                'post:create',
                'post:update',
                'post:delete',
            ],
            'Editor' => [
                'post:view',
                'post:create',
                'post:update',
            ],
            'Member' => [
                'post:view',
            ],
        ];

        collect($roles)->each(function ($permissions, $role) {
            $role = Role::findOrCreate($role);
            collect($permissions)->each(function ($permission) use ($role) {
                $role->permissions()->save(Permission::findOrCreate($permission));
            });
        });
    }
}
