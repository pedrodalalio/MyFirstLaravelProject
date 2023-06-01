<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Movimentation;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MovimentController extends Controller{
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
        'qt_product' => 'required|numeric|gt:0',
        'dt_movimentation' => 'required',
      ]);

      $data = $request->all();
      $product = Product::query()->where('product_code', '=', $data['product_code'])->first();

      $batch = Batch::query()->where('num_batch', '=', $data['num_batch'])->first();

      if($batch === null){
        $batch = Batch::create([
          'id_product' => $product->id,
          'num_batch' => $data['num_batch'],
          'dt_validity' => $data['dt_validity'],
          'active' => $data['active']
        ]);

        $res[0] = $batch;
      }

      $res[0] = $batch;

      $res[1] = Movimentation::create([
        'id_product' => $product->id,
        'id_batch' =>$batch->id,
        'type' => $data['type'],
        'origin' => $data['origin'],
        'qt_product' => $data['qt_product'],
        'dt_movimentation' => $data['dt_movimentation'],
      ]);

      if($data['type'] === 'entry'){
        $stock = Stock::query()->firstWhere('id_product', '=', $product->id);
        $total = $stock->qt_stock;
        $total += $data['qt_product'];

        Stock::query()->findOrFail($stock->id)->update([
          'qt_stock' => $total,
        ]);
      }
      else{
        $stock = Stock::query()->firstWhere('id_product', '=', $product->id);
        $total = $stock->qt_stock;
        $total -= $data['qt_product'];

        Stock::query()->findOrFail($stock->id)->update([
          'qt_stock' => $total,
        ]);
      }

      $res[1]->dt_movimentation = date('d/m/Y', strtotime($res[1]->dt_movimentation));
      $res['product_code'] = $data['product_code'];
      $res['id'] = $res[1]->id;

      return response()->json($res);
    }
    catch (\Exception $e){
      dd($e->getMessage());
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

      $product = Product::query()->where('id', '=', $res->id_product)->first();
      $batch = Batch::query()->where('id', '=', $res->id_batch)->first();

      $res['product_code'] = $product->product_code;
      $res['name'] = $product->name;
      $res['num_batch'] = $batch->num_batch;
      $res['dt_validity'] = $batch->dt_validity;
      $res['active'] = $batch->active;

      return response()->json($res);
    }
    catch (\Exception $e){
      dd($e->getMessage());
    }
  }

  public function update(Request $request, int $id){
    try {
      $data = $request->all();
      $res['movement'] = $data;
      $product = Product::query()->where('product_code', '=', $data['product_code'])->first();

      $batch = Batch::query()->where('num_batch', '=', $data['num_batch'])->first();

      if($batch === null){
        $batch = Batch::create([
          'id_product' => $product->id,
          'num_batch' => $data['num_batch'],
          'dt_validity' => $data['dt_validity'],
          'active' => $data['active']
        ]);

        $res['batch'] = $batch;
      }

      $res['batch'] = $batch;

      Movimentation::query()->findOrFail($id)->update([
        'id_product' => $product->id,
        'id_batch' =>$batch->id,
        'type' => $data['type'],
        'origin' => $data['origin'],
        'qt_product' => $data['qt_product'],
        'dt_movimentation' => $data['dt_movimentation'],
      ]);

      if($data['type'] === 'entry'){
        $stock = Stock::query()->firstWhere('id_product', '=', $product->id);
        $total = $stock->qt_stock;
        $total += $data['qt_product'];

        Stock::query()->findOrFail($stock->id)->update([
          'qt_stock' => $total,
        ]);
      }
      else{
        $stock = Stock::query()->firstWhere('id_product', '=', $product->id);
        $total = $stock->qt_stock;
        $total -= $data['qt_product'];

        Stock::query()->findOrFail($stock->id)->update([
          'qt_stock' => $total,
        ]);
      }

      $res['movement']['dt_movimentation'] = date('d/m/Y', strtotime($res['movement']['dt_movimentation']));
      $res['product_code'] = $data['product_code'];
      $res['type'] = $data['type'];
      $res['origin'] = $data['origin'];
      return response()->json($res);
    }
    catch (\Exception $e){
      $res = [
        'status' => '401',
        'message' => 'Error',
      ];
      return response()->json($res);
    }
  }
}
