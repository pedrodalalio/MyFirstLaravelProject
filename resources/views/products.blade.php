@extends('layouts.main')

@section('title', 'Products')

@section('content')

    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Products</h1>
        @if(auth()->user()->hasRole('add products'))
            <button class="btn btn-outline-dark ml-5" data-toggle="modal" data-target="#addProductsModalLabel">New</button>

            {{--Add Modal--}}
            <div class="modal fade" id="addProductsModalLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <label for="product_codeAddP">Product code</label>
                                        <input type="text" name="product_code" class="form-control" id="product_codeAddP" placeholder="Product code">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="nameAddP">Name</label>
                                        <input type="text" name="name" class="form-control" id="nameAddP" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descriptionAddP">Description</label>
                                    <textarea class="d-block form-control" name="description" id="descriptionAddP" placeholder="Describe your product" cols="59"></textarea>
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label for="categoryAddP">Category</label>--}}
{{--                                    <select class="form-control" name="category" id="categoryAddP">--}}
{{--                                        <option value="0"></option>--}}
{{--                                        <option value="food">Food</option>--}}
{{--                                        <option value="drink">Drink</option>--}}
{{--                                        <option value="fit">Fit</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="measurement_unitsAddP">Measurement Unit</label>
                                        <input class="form-control" type="text" name="measurement_units" id="measurement_unitsAddP">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="batchQuantity">Unit Quantity</label>
                                        <input class="form-control" type="number" name="unit_quantity" id="batchQuantity">
                                    </div>
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
        @endif

    </div>

    <table class="table table-striped table-bordered table-secondary">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Code</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
{{--            <th scope="col">Category</th>--}}
            <th scope="col">Measurement</th>
            <th scope="col">Unit Quantity</th>
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
{{--                <td>{{$product->category}}</td>--}}
                <td>{{$product->measurement_units}}</td>
                <td>{{$product->unit_quantity}}</td>
                <td class="products-icon">
                    @if(auth()->user()->hasRole('edit products'))
                        <button type="button" value="{{$product->id}}" class="btnEditProduct btn btn-success" data-toggle="modal" data-target="#editProductsModalLabel">
                            <i class="ti-pencil"></i>
                        </button>

                        {{--Edit Modal--}}
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
                                                    <label for="product_codeEditP">Product code</label>
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

                        @else
                        <button type="button" class="btn btn-secondary" disabled>
                            <i class="ti-pencil"></i>
                        </button>
                    @endif
                        @if(auth()->user()->hasRole('delete products'))
                        <button type="button" value="{{$product->id}}" class="btnDeleteProduct btn btn-danger" data-toggle="modal" data-target="#">
                            <i class="ti-trash"></i>
                        </button>

                        @else
                            <button type="button" class="btn btn-secondary" disabled>
                                <i class="ti-trash"></i>
                            </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
