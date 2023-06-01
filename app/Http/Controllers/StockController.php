<?php

namespace App\Http\Controllers;

use App\Models\Movimentation;
use App\Models\Product;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller{
  public function index(){
    $stocks = Stock::all();
    $movArray = $stocks->toArray();
    for($i = 0; $i < count($movArray); $i++){
      $product_info = Product::query()->firstWhere('id', '=', $movArray[$i]['id']);
      $movArray[$i]['product_info'] = $product_info->toArray();
    }
    return view('stock', ['stocks' => $movArray]);
  }

  public function showItems(int $id){
    $stock = Stock::query()->findOrFail($id);
    $product_info = Product::query()->firstWhere('id', '=', $stock['id']);
    $stock['product'] = $product_info;
    return response()->json($stock);
  }

  public function update(Request $request){
    try {
      $stock = $request->all();
      Stock::query()->findOrFail($stock['id'])->update([
        'min_stock' => $stock['min_stock'],
        'max_stock' => $stock['max_stock'],
      ]);
      return response()->json($stock);
    }
    catch (Exception $e){
      $res = [
        'status' => 400,
        'message' => 'Error',
      ];
      return response()->json($res);
    }
  }
}
