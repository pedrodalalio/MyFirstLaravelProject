@extends('layouts.main')

@section('title', 'Manage')

@section('content')
    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Movements</h1>

        <button class="btn btn-outline-dark ml-5" data-toggle="modal" data-target="#addMovementModal">New Movement</button>

        {{--Add Modal--}}
        <div class="modal fade" id="addMovementModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Movement</h5>
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
                                    <label for="movementType">Type</label>
                                    <select name="type" id="movementType" class="selectpicker">
                                        <option></option>
                                        <option value="entry">Entry</option>
                                        <option value="output">Output</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="movementProductCode">Product code</label>
                                    <input class="form-control" type="text" name="product_code" id="movementProductCode" onkeydown="$(this).mask('000.000.0000');">
                                    <div id="alertText">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="movementProductName">Product Name</label>
                                    <input class="form-control" type="text" name="name" id="movementProductName">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="batchMoviment">Batch</label>
                                    <input class="form-control" type="text" name="id_batch" id="batchMoviment">
                                    <div id="divText">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="batchValidity">Validity Date</label>
                                    <input class="form-control" type="date" name="dt_validity" id="batchValidity">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="batchActive">Active</label>
                                    <select id="batchActive" class="form-control" name="active">
                                        <option></option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="originMovement">Origin</label>
                                    <select id="originMovement" class="form-control" name="origin">
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="qtMovement">Product Quantity</label>
                                    <input class="form-control" type="number" name="qt_product" id="qtMovement">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dateMovement">Movimentation Date</label>
                                <input class="form-control" type="date" name="dt_movimentation" id="dateMovement">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnAddMovement" class="btn btn-info">Create movement</button>
                    </div>
                </div>
            </div>
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
