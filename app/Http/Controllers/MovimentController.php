<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Movimentation;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MovimentController extends Controller
{
    public function index(){
        $movements = Movimentation::all();
        $movArray = $movements->toArray();

        for($i = 0; $i < count($movArray); $i++){
            $product_info = Product::query()->where('id', '=', $movArray[$i]['id_product'])->first();

            $batch_info = Batch::query()->where('id', '=', $movArray[$i]['id_batch'])->first();

            $product_code = $product_info->product_code;
            $num_batch = $batch_info->num_batch;

            $movArray[$i]['product_code'] = $product_code;
            $movArray[$i]['num_batch'] = $num_batch;
        }

       return view('manage', ['movements' => $movArray]);
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

    public function create(Request $request){
        try {
            $validated = $request->validate([
                'type' => 'required',
                'product_code' => 'required',
                'name' => 'required',
                'num_batch' => 'required',
                'dt_validity' => 'required',
                'active' => 'required',
                'origin' => 'required',
                'qt_product' => 'required',
                'dt_movimentation' => 'required',
            ]);

            $data = $request->all();
            $product = Product::query()->where('product_code', '=', $data['product_code'])->first();

            $batch = Batch::create([
                'id_product' => $product->id,
                'num_batch' => $data['num_batch'],
                'dt_validity' => $data['dt_validity'],
                'active' => $data['active']
            ]);

            $res[0] = $batch;

            $res[1] = Movimentation::create([
                'id_product' => $product->id,
                'id_batch' =>$batch->id,
                'type' => $data['type'],
                'origin' => $data['origin'],
                'qt_product' => $data['qt_product'],
                'dt_movimentation' => $data['dt_movimentation'],
            ]);

            $res['product_code'] = $data['product_code'];
            $res['id'] = $res[1]->id;

            return response()->json($res);
        }
        catch (\Exception $e){
            $res = [
                'status' => '400',
                'message' => 'Error To Create',
            ];

            return response()->json($res);
        }
    }

    public function showEdit(int $id){
        try {
            $res = Movimentation::query()->findOrFail($id);
            return response()->json($res);
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}
