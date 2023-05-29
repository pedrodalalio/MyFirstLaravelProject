@extends('layouts.main')

@section('title', 'Stock')

@section('content')

    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Stock</h1>
    </div>

    <table id="stockTable" class="table table-striped table-bordered table-secondary">
        <thead>
        <tr>
            <th scope="col">Product Code</th>
            <th scope="col">Min Stock</th>
            <th scope="col">Max Stock</th>
            <th scope="col">Total Stock</th>
        </tr>
        </thead>
        <tbody id="tbodyStock">
{{--
  "id" => 1
  "id_product" => 1
  "qt_stock" => 10
  "min_stock" => 1
  "max_stock" => 20
--}}
        {{dd($stocks)}}

            @foreach($stocks as $stock)
                <tr>
                    <th scope="row">{{$stock['product_info']['product_code']}}</th>
                    <td>{{$stock['min_stock']}}</td>
                    <td>{{$stock['max_stock']}}</td>
                    <td>Total</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
