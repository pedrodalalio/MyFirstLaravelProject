<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('home');
    }

    public function show(){
        return view('products');
    }

    public function store(){
        return view('products');
    }
}
