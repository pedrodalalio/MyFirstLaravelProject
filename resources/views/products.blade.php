@extends('layouts.main')

@section('title', 'Products')

@section('content')

    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Products</h1>
        @can('add products')
            <button class="btn btn-outline-dark ml-5" data-toggle="modal" data-target="#addProductsModalLabel">New</button>
        @endcan

    </div>

    <table class="table table-striped table-bordered table-secondary">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Code</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="tbodyEdit">
        @foreach($products as $product)
            <tr id="tre-{{$product->id}}">
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->product_code}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->category}}</td>
                    <td class="products-icon">
                        @can('edit products')
                            <button type="button" value="{{$product->id}}" class="btnEditProduct btn btn-success" data-toggle="modal" data-target="#editProductsModalLabel">
                                <i class="ti-pencil"></i><span class="ml-1">Edit</span>
                            </button>
                        @endcan
                        @can('delete products')
                            <button type="button" value="{{$product->id}}" class="btnDeleteProduct btn btn-danger" data-toggle="modal" data-target="#">
                                <i class="ti-trash"></i><span class="ml-1">Delete</span>
                            </button>
                        @endcan
                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Add Modal--}}
    <div class="modal fade" id="addProductsModalLabel" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addFormProduct">
                        @csrf
                        <div>
                            <input type="hidden" value="#">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="nameAddP" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_code">Product code</label>
                                <input type="text" name="product_code" class="form-control" id="product_codeAddP" placeholder="Product code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="d-block" name="description" id="descriptionAddP" placeholder="Describe your product" cols="59"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="categoryAddP">
                                <option value="food">Food</option>
                                <option value="drink">Drink</option>
                                <option value="fit">Fit</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnAddProduct" class="btn btn-info">Create product</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal--}}
    <div class="modal fade" id="editProductsModalLabel" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editFormProduct">
                        @csrf
                        <div>
                            <input type="hidden" id="idEditP" name="id">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nameEditP">Name</label>
                                <input type="text" class="form-control" name="name" id="nameEditP" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="codeEditP">Product code</label>
                                <input type="text" class="form-control" name="product_code" id="product_codeEditP" placeholder="Product code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptionEditP">Description</label>
                            <textarea class="d-block" name="description" id="descriptionEditP" placeholder="Describe your product" cols="59"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="categoryEditP">Category</label>
                            <select class="form-control" name="category" id="categoryEditP">
                                <option value="food">Food</option>
                                <option value="drink">Drink</option>
                                <option value="fit">Fit</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnFormEditProduct" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
