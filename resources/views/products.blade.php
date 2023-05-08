@extends('layouts.main')

@section('title', 'Products')

@section('content')

    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Products</h1>
        <button class="btn btn-outline-dark ml-5" data-toggle="modal" data-target="#addProductsModalLabel">New</button>
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
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>993</td>
            <td>Coffee</td>
            <td>Coffee beans from spain</td>
            <td>Beans</td>
            <td class="products-icon">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editProductsModalLabel">
                    <i class="ti-pencil"></i><span class="ml-1">Edit</span>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#">
                    <i class="ti-trash"></i><span class="ml-1">Delete</span>
                </button>
            </td>
        </tr>
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
                    <form>
                        <div>
                            <input type="hidden" value="#">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="code">Product code</label>
                                <input type="text" class="form-control" id="code" placeholder="Product code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="d-block" name="description" id="description" placeholder="Describe your product" cols="59"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Create product</button>
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
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
