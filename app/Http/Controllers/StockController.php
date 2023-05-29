<?php

namespace App\Http\Controllers;

use App\Models\Movimentation;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller{
  public function index(){
    $stocks = Stock::all();
    $movArray = $stocks->toArray();

    for($i = 0; $i < count($movArray); $i++){
      $product_info = Product::query()->firstWhere('id', '=', $movArray[$i]['id']);
      $movArray[$i]['product_info'] = $product_info->toArray();

      $movementInfo = Movimentation::where('id_product', $movArray[$i]['id_product'])->get()->pluck('qt_product');
      dd($movementInfo);
    }

    return view('stock', ['stocks' => $movArray]);
  }
}
