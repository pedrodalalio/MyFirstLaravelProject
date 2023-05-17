<?php

namespace Database\Seeders;

use App\Http\Controllers\RoleController;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $roleController = new RoleController();
        $roleController->createRoles();
    }
}
