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
      <th scope="col">Name</th>
      <th scope="col">Min Stock</th>
      <th scope="col">Max Stock</th>
      <th scope="col">Total Stock</th>
      <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stocks as $stock)
      <tr id="trStock-{{$stock['id']}}">
        <th scope="row">{{$stock['product_info']['product_code']}}</th>
        <td>{{$stock['product_info']['name']}}</td>
        <td>{{$stock['min_stock']}}</td>
        <td>{{$stock['max_stock']}}</td>
        <td>{{$stock['qt_stock']}}</td>
        <td class="d-flex justify-content-around">
          <button value="{{$stock['id']}}" class="btnEditStock btn btn-success"><i class="ti-pencil"></i></button>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  {{--Edit Modal--}}
  <div class="modal fade" id="editStock" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editFormStock">
            @csrf
            <div>
              <input type="hidden" id="idStock" name="id">
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="productCodeStock">Product Code</label>
                <input class="form-control" type="text" name="product_code" id="productCodeStock">
              </div>

              <div class="form-group col-md-6">
                <label for="nameStock">Name</label>
                <input class="form-control" type="text" name="name" id="nameStock">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="minStock">Min Stock</label>
                <input class="form-control" type="text" name="min_stock" id="minStock">
              </div>

              <div class="form-group col-md-6">
                <label for="maxStock">Max Stock</label>
                <input class="form-control" type="text" name="max_stock" id="maxStock">
              </div>
            </div>

            <div class="form-group">
              <label for="qtStock">Max Stock</label>
              <input class="form-control" type="text" name="qt_stock" id="qtStock">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="btnFormEditStock" class="btn btn-info">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection
