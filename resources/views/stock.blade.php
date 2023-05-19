@extends('layouts.main')

@section('title', 'Stock')

@section('content')

    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Stock</h1>
    </div>

    <table class="table table-striped table-bordered table-secondary">
        <thead>
        <tr>
            <th scope="col">Product Code</th>
            <th scope="col">Min Stock</th>
            <th scope="col">Max Stock</th>
            <th scope="col">Total Stock</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="tbodyStock">
            {{--@foreach( as )--}}
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="d-flex justify-content-around">
                        <button type="button" value="" class=" btn btn-success" data-toggle="modal" data-target="#">
                            <i class="ti-pencil"></i>
                        </button>

                        <button type="button" value="" class=" btn btn-danger">
                            <i class="ti-trash"></i>
                        </button>

                        <button type="button" value="" class=" btn btn-info" data-toggle="modal" data-target="#">
                            <i class="ti-archive"></i>
                        </button>
                    </td>
                </tr>
            {{--@endforeach--}}
        </tbody>
    </table>

@endsection
