<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller{
    public function createPermissions(){
        $permissions = [
            ['name' => 'add products', 'guard_name' => 'web'],
            ['name' => 'edit products', 'guard_name' => 'web'],
            ['name' => 'delete products', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }

    public function showPermissions(){
        $data = Permission::all();
        return response()->json($data);
    }
}
