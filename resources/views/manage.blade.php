@extends('layouts.main')

@section('title', 'Manage')

@section('content')
    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Movements</h1>

        <button class="btn btn-outline-dark ml-5" data-toggle="modal" data-target="#">New Movement</button>

        {{--Add Modal--}}
        <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
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
                                    <label for="nameAddP">Name</label>
                                    <input type="text" name="name" class="form-control" id="nameAddP" placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="product_codeAddP">Product code</label>
                                    <input type="text" name="product_code" class="form-control" id="product_codeAddP" placeholder="Product code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descriptionAddP">Description</label>
                                <textarea class="d-block" name="description" id="descriptionAddP" placeholder="Describe your product" cols="59"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="categoryAddP">Category</label>
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

        <div class="search-box">
            <form action="#">
                <label>
                    <input id="search-box" type="text" name="search" placeholder="Search...">
                </label>
                <i class="ti-search"></i>
            </form>
        </div>
    </div>

    <table id="manageTable" class="table table-striped table-bordered table-secondary">
        <thead>
        <tr>
            <th scope="col">Product Code</th>
            <th scope="col">Batch ID</th>
            <th scope="col">Type</th>
            <th scope="col">Origin</th>
            <th scope="col">Quantity</th>
            <th scope="col">Date</th>
{{--            <th scope="col">Action</th>--}}
        </tr>
        </thead>
        <tbody id="tbodyStock">
        {{--@foreach( as )--}}
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
{{--            <td class="d-flex justify-content-around">--}}
{{--                <button type="button" value="" class=" btn btn-success" data-toggle="modal" data-target="#">--}}
{{--                    <i class="ti-pencil"></i>--}}
{{--                </button>--}}

{{--                <button type="button" value="" class=" btn btn-danger">--}}
{{--                    <i class="ti-trash"></i>--}}
{{--                </button>--}}

{{--                <button type="button" value="" class=" btn btn-info" data-toggle="modal" data-target="#">--}}
{{--                    <i class="ti-archive"></i>--}}
{{--                </button>--}}
{{--            </td>--}}
        </tr>
        {{--@endforeach--}}
        </tbody>
    </table>
@endsection
