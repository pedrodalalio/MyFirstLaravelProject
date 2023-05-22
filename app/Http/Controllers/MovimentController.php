<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MovimentController extends Controller
{
    public function index(){

        $products = Product::all();
        return view('manage', ['products' => $products]);
    }
}
