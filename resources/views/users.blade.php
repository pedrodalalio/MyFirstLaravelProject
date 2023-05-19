@extends('layouts.main')

@section('title', 'User')

@section('content')

    <div class="d-flex mt-4 mb-2">
        <h1 class="d-block">Users</h1>
            <button class="newUserBtn btn btn-outline-dark ml-5" data-toggle="modal" data-target="#addUsersModalLabel">New</button>
    </div>

    <table id="userTable" class="table table-striped table-bordered table-secondary">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
            <th scope="col">Phone</th>
            <th scope="col">UNIFAE Registration</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="tbodyAdd">
        @foreach ($users as $user)
            <tr id="tr-{{$user->id}}">
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->cpf}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->registration}}</td>
                <td>
                    {{implode(', ',$user->roles()->pluck('name')->toArray())}}
                </td>
                <td class="products-icon">
                    <button type="button" value="{{$user->id}}" class="btnEdit btn btn-success" data-toggle="modal" data-target="#editUsersModalLabel">
                        <i class="ti-pencil"></i>
                    </button>
                    <button type="button" value="{{$user->id}}" class="btnDelete btn btn-danger" data-toggle="modal" data-target="#">
                        <i class="ti-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
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
                    <form id="addForm">
                        @csrf
                        <div>
                            <input type="hidden" value="#">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Complete name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Complete name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf"  name="cpf" onkeydown="$(this).mask('000.000.000-00');" placeholder="xxx.xxx.xxx-xx">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="passI form-control" name="password" id="password" placeholder="Password">
                            <input type="checkbox" name="showPass" id="pass" class="showPass">
                            <label class="d-inline" for="pass">Show Password</label>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" onkeydown="$(this).mask('(00)00000-0000');" placeholder="(99)99999-9999">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="registration">UNIFAE Registration</label>
                                <input type="text" class="form-control" name="registration" id="registration" onkeydown="$(this).mask('00000-0');" placeholder="Your registration">
                            </div>
                        </div>

                        <div class="form-group">
                            <p>Regra</p>
                            <div class="rolesDiv d-flex justify-content-between">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnAddUser" class="btn btn-info">Create user</button>
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
                    <form id="editForm">
                        @csrf
                        <div>
                            <input type="hidden" id="id" name="id" value="">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nameEdit">Complete name</label>
                                <input type="text" name="name" class="form-control" id="nameEdit" placeholder="Complete name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cpfEdit">CPF</label>
                                <input type="text" class="form-control" id="cpfEdit"  name="cpf" onkeydown="$(this).mask('000.000.000-00');" placeholder="xxx.xxx.xxx-xx">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="emailEdit">Email</label>
                            <input type="email" class="form-control" name="email" id="emailEdit" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="passI form-control" name="password" id="password" placeholder="Password">
                            <input type="checkbox" name="showPass" id="pass" class="showPass">
                            <label class="d-inline" for="pass">Show Password</label>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phoneEdit">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phoneEdit" onkeydown="$(this).mask('(00)00000-0000');" placeholder="(99)99999-9999">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="registrationEdit">UNIFAE Registration</label>
                                <input type="text" class="form-control" name="registration" id="registrationEdit" onkeydown="$(this).mask('00000-0');" placeholder="Your registration">
                            </div>
                        </div>

                        <div class="form-group">
                            <p>Regra</p>
                            <div class="rolesDiv d-flex justify-content-between">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnEditUser" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
