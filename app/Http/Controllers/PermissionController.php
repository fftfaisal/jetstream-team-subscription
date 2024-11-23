<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __invoke()
    {
        $permissions = Permission::get();

        return view('permissions.index', [
            'permissions' => $permissions,
        ]);
    }
}
