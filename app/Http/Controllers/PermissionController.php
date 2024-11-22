<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __invoke()
    {
        $roles = Role::query()->with('permissions')->withCount('users')->get();
        $permissions = Permission::get();

        return view('permissions.index', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }
}
