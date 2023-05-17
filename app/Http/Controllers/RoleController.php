<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller{
    public function createRoles(){
        $roles = [
            ['name' => 'add products', 'guard_name' => 'web'],
            ['name' => 'edit products', 'guard_name' => 'web'],
            ['name' => 'delete products', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role){
            Role::create($role);
        }
    }

    public function showRoles(){
        $data = Role::all();
        return response()->json($data);
    }
}
