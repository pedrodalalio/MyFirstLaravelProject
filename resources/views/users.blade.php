@extends('layouts.main')

@section('title', 'User')

@section('content')

    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Users</h1>
        <button class="btn btn-outline-dark ml-5" data-toggle="modal" data-target="#addUsersModalLabel">New</button>
    </div>

    <table class="table table-striped table-bordered table-secondary">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
            <th scope="col">Phone</th>
            <th scope="col">UNIFAE Registration</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Pedro</td>
            <td>pedrodalalio13@gmail.com</td>
            <td>123.456.789-12</td>
            <td>(19)9999-9999</td>
            <td>27774-5</td>
            <td class="products-icon">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editUsersModalLabel">
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
    <div class="modal fade" id="addUsersModalLabel" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New User</h5>
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
                                <label for="user_name">Complete name</label>
                                <input type="text" class="form-control" id="user_name" placeholder="Complete name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" placeholder="xxx.xxx.xxx-xx">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="exempla@example.com">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="(99)9999-9999">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="registration">UNIFAE Registration</label>
                                <input type="text" class="form-control" id="registration" placeholder="Your registration">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Create user</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal--}}
    <div class="modal fade" id="editUsersModalLabel" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
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
                                <label for="user_name">Complete name</label>
                                <input type="text" class="form-control" id="user_name" placeholder="Complete name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" placeholder="xxx.xxx.xxx-xx">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="exempla@example.com">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="(99)9999-9999">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="registration">UNIFAE Registration</label>
                                <input type="text" class="form-control" id="registration" placeholder="Your registration">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
