<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MovimentController extends Controller
{
    public function index(){

        return view('manage');
    }

    public function infoProducts($id){
        try {
            $products = Product::query()->firstWhere('product_code', $id);
            if($products == null){
                $res = [
                    'status' => '404',
                    'message' => 'This product code does not exist',
                ];
                return response()->json($res);
            }
            return response()->json($products);
        }
        catch(ModelNotFoundException $e){
            $res = [
                'status' => '401',
                'message' => 'Error',
            ];
            return response()->json($res);
        }
    }
}
