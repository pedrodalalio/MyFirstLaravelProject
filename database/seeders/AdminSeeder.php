<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'name' => 'admin',
            'cpf' => '999.999.999-99',
            'email' => 'admin@gmail.com',
            'phone' => '(19)99999-9999',
            'registration' => '27774-5',
            'permissions' => 'add products, edit products, delete products',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->givePermissionTo(['add products', 'edit products']);

        User::create([
            'name' => 'add',
            'cpf' => '1',
            'email' => 'add@gmail.com',
            'phone' => '1',
            'registration' => '1',
            'permissions' => 'add products',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->givePermissionTo(['add products']);

        User::create([
            'name' => 'edit',
            'cpf' => '2',
            'email' => 'edit@gmail.com',
            'phone' => '2',
            'registration' => '2',
            'permissions' => 'edit products',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->givePermissionTo(['edit products']);

        User::create([
            'name' => 'delete',
            'cpf' => '3',
            'email' => 'delete@gmail.com',
            'phone' => '3',
            'registration' => '3',
            'permissions' => 'delete products',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->givePermissionTo(['delete products']);
    }
}
