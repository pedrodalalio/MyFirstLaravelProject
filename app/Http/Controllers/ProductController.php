<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    //this index is only returning the home page
    public function index(){
        return view('home');
    }

    public function show(){
        $products = Product::all();
        return view('products', ['products' => $products]);
    }

    public function create(Request $request){
        try {
            $data = $request->all();

            foreach($data as $d){
                if($d == null){
                    $res = [
                        'status' => '412',
                        'message' => 'Empty field!'
                    ];
                    return response()->json($res);
                }
            }

            //Alterar para password
            $product = [];
            $product[0] = Product::create($data);

            $product[1] = [
                'status' => '201',
                'message' => 'Dados salvos com sucesso!'
            ];
            return response()->json($product);
        }
        catch(\Exception $e){
            $res = [
                'status' => '406',
                'message' => 'error'
            ];
            return response()->json($res);
        }
    }

    public function showEdit(int $id){

    }

    public function update(Request $request, int $id){

    }
    public function destroy(int $id){

    }


}
