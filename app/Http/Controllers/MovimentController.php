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

    public function products(int $id){
        try {
            $products = Product::query()->firstWhere('product_code', $id);
            return response()->json($products);
        }
        catch(\Exception $e){
            dd($e->getMessage());
            $res = [
                'status' => '404',
                'message' => 'This product does not exist',
            ];
            return response()->json($res);
        }
    }
}
