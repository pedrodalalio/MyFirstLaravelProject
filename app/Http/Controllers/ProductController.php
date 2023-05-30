<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller{

  //this index is only returning the home page
  public function index(){
    return view('home');
  }

  public function show(){
    $products = Product::all();
    return view('products', ['products' => $products]);
  }

  public function create(Request $request)
  {
    try {
      $data = $request->all();
      foreach ($data as $d) {
        if ($d == null) {
          $res = [
            'status' => '412',
            'message' => 'Empty field!'
          ];
          return response()->json($res);
        }
      }

      //Alterar para password
      $product = [];
      $product[0] = Product::create([
        'name' => $data['name'],
        'description' => $data['description'],
        'product_code' => $data['product_code'],
        'category' => 'categoria',
        'measurement_units' => $data['measurement_units'],
        'unit_quantity' => $data['unit_quantity'],
      ]);

      Stock::create([
        'id_product' => $product[0]->id,
        'max_stock' => 0,
        'min_stock' => 0,
        'qt_stock' => 0,
      ]);

      $product[1] = [
        'status' => '201',
        'message' => 'Dados salvos com sucesso!'
      ];
      return response()->json($product);
    } catch (\Exception $e) {
      $res = [
        'status' => '406',
        'message' => 'error'
      ];
      return response()->json($res);
    }
  }

  public function showEdit(int $id)
  {
    try {
      $res = [];
      $res[0] = Product::query()->findOrFail($id);

      $res[1] = [
        'status' => '201',
        'message' => 'Dados Editados Com Sucesso!'
      ];

      return response()->json($res);
    } catch (\Exception $e) {
      $res = [
        'status' => '404',
        'message' => 'Product Not Found'
      ];

      return response()->json($res);
    }
  }

  public function update(Request $request, int $id)
  {
    try {
      $data = [];
      $data[0] = $request->all();

      Product::query()->findOrFail($id)->update($data[0]);

      $data[1] = [
        'status' => '201',
        'message' => 'Data Updated!'
      ];

      return response()->json($data);
    } catch (\Exception $e) {
      $res = [
        'status' => '406',
        'message' => 'Error'
      ];
      return response()->json($res);
    }
  }

  public function destroy(int $id)
  {
    try {
      $res = [];
      $res[0] = $id;

      Batch::query()->firstWhere('id_product', $id)->delete();
      Product::query()->findOrFail($id)->delete();

      $res[1] = [
        'status' => '200',
        'message' => 'Deleted'
      ];

      return response()->json($res);
    } catch (\Exception $e) {
      $res = [
        'status' => '404',
        'message' => 'Product Not Found'
      ];

      return response()->json($res);
    }
  }
}
