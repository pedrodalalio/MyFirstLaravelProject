<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class UserController extends Controller{

    public function show(){
        return view('users');
    }

    public function create(Request $request){
        try {
            print("antes");
            $input = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => PasswordValidationRules::passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ]);
            print("depois");
            $user = (new CreateNewUser())->create($input);

            return response()->json([
                'status' => 'success',
                'message' => 'Dados salvos com sucesso!'
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
