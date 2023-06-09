<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;
use Spatie\Permission\Models\Role;

class UserController extends Controller{
    public function show(){
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    public function create(Request $request){
        try {
            $data = $request->all();
            //Verify if all inputs is filled
            foreach($data as $d){
                if($d == null){
                    $res = [
                        'status' => '412',
                        'message' => 'Empty field!'
                    ];
                    return response()->json($res);
                }
            }

            $data['auxRoles'] = $data['roles'];

            $data['roles'] = implode(", ", $data['roles']);

            $data['password'] = Hash::make($data['password']);

            $user = [];
            $user[0] = User::create($data)->assignRole($data['auxRoles']);

            $user[0]['strRole'] = $data['roles'];

            $user[1] = [
                'status' => '201',
                'message' => 'Dados salvos com sucesso!'
            ];
            return response()->json($user);
        }
        catch (\Exception $e){
            $res = [
                'status' => '406',
                'message' => 'error'
            ];
            return response()->json($res);
        }
    }

    public function showEdit(int $id){
        try {
            $res = [];
            $res[0] = User::query()->findOrFail($id); // Info do User

            $res[2] = Role::all()->pluck('id'); // Todas os ids de roles
            $res[4] = Role::all()->pluck('name'); // Todas os nomes de roles
            $res[3] = $res[0]->roles()->pluck('id'); // As roles do User

            $res[1] = [
                'status' => '201',
                'message' => 'Dados Editados Com Sucesso!'
            ];

            return response()->json($res);
        }
        catch(\Exception $e){
            $res = [
                'status' => '404',
                'message' => 'User Not Found'
            ];

            return response()->json($res);
        }
    }

    public function update(Request $request, int $id){
        try {
            $data = [];
            $data[0] = $request->all();

            $data['auxRoles'] = $data[0]['roles'];

            $data[0]['roles'] = implode(", ", $data[0]['roles']);

            if($data[0]['password'] == null){
                User::query()->findOrFail($request->id)->update(array(
                    'name' => $data[0]['name'],
                    'cpf' => $data[0]['cpf'],
                    'email' => $data[0]['email'],
                    'phone' => $data[0]['phone'],
                    'registration' => $data[0]['registration']
                ));

                $user = User::query()->findOrFail($request->id);
                $user->syncRoles($data['auxRoles']);

                $data[1] = [
                    'status' => '201',
                    'message' => 'Data Updated!'
                ];

                return response()->json($data);
            }
            // User change the password
            $data[0]['password'] = Hash::make($data[0]['password']);
            User::query()->findOrFail($request->id)->update($data[0]);

            $user = User::query()->findOrFail($request->id);
            $user->syncRoles($data['auxRoles']);

            $data[1] = [
                'status' => '201',
                'message' => 'Data Updated!'
            ];

            return response()->json($data);
        }
        catch (\Exception $e){
            $res = [
                'status' => '406',
                'message' => 'Error'
            ];
            return response()->json($res);
        }
    }

    public function destroy(int $id){
        try {
            $res = [];
            $res[0] = $id;

            User::query()->findOrFail($id)->delete();

            $res[1] = [
                'status' => '200',
                'message' => 'Deleted'
            ];

            return response()->json($res);
        }
        catch(\Exception $e){

            $res = [
                'status' => '404',
                'message' => 'User Not Found'
            ];

            return response()->json($res);
        }
    }
}
