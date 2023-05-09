<?php

namespace App\Http\Controllers;

use App\Models\CreatedUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('users');
    }

    public function store(Request $request){
        try {
            $role = $request->role;

            if($role == 'admin'){
                $role = 'admin';
            }
            elseif ($role == 'viewer'){
                $role = 'viewer';
            }
//            return User::create([
//                'name' => $input['name'],
//                'email' => $input['email'],
//                'password' => Hash::make($input['password']),
//            ])->assignRole('viewer');


            User::create([
                'name' => $request->name,
                //'cpf' => '999.999.999-99',
                'email' => $request->email,
                //'phone' => '(19)99999-9999',
                //'registration' => '27774-5',
                //'role' => 'admin',
                'email_verified_at' => now(),
                'password' => $request->password, // password
            ])->assignRole($role);

            return response()->json([
                'status' => 'success',
                'message' => 'Dados salvos com sucesso!'
            ]);

//            $userData = new CreatedUser();
//            $userData->name = $request->name;
//            $userData->cpf = $request->cpf;
//            $userData->email = $request->email;
//            $userData->password = $request->password;
//            $userData->phone = $request->phone;
//            $userData->registration = $request->registration;
//            $userData->role = $request->role;
//            $userData->save();
//            return response()->json([
//                'status' => 'success',
//                'message' => 'Dados salvos com sucesso!'
//            ]);
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}
