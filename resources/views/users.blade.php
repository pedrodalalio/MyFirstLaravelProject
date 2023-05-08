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
            <th scope="col">Role</th>
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
            <td>Viewer</td>
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
                    <form action="#" method="POST">
                        <div>
                            <input type="hidden" value="#">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="user_name_add">Complete name</label>
                                <input type="text" class="form-control" id="user_name_add" placeholder="Complete name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cpf_add">CPF</label>
                                <input type="text" class="form-control" id="cpf_add" onkeydown="$(this).mask('000.000.000-00');" placeholder="xxx.xxx.xxx-xx">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email_add">Email</label>
                            <input type="text" class="form-control" id="email_add" placeholder="exempla@example.com">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone_add">Phone</label>
                                <input type="text" class="form-control" id="phone_add" onkeydown="$(this).mask('(00)00000-0000');" placeholder="(99)99999-9999">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="registration_add">UNIFAE Registration</label>
                                <input type="text" class="form-control" id="registration_add" onkeydown="$(this).mask('00000-0');" placeholder="Your registration">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p>Roles</p>

                                {{-- Here will be a foreach to catch all roles of database --}}
                                <div class="d-block">
                                    <input id="definition_add" name="definition_add" value="admin" type="checkbox">
                                    <label for="definition_add">Admin</label>
                                </div>

                                <input id="definitionv_add" name="definitionv_add" value="viewer" type="checkbox">
                                <label for="definitionv_add">Viewer</label>
                            </div>

                            <div class="form-group col-md-6">
                                <p>Permission</p>

                                {{-- Here will be a foreach to catch all permissions of database --}}

                                {{-- And I need to think what kind of permission I will have in the system and what type is for admin and what is for the viwer. Also I need to show only the permission I clicked. Maybe I change the checkbox for a radio in the role --}}
                                <div class="d-block">
                                    <input id="edit_permission_add" name="edit_permission_add" value="reade" type="checkbox">
                                    <label for="edit_permission_add">Read</label>
                                </div>

                                <input id="edit_permissionv_add" name="edit_permissionv_add" value="edit" type="checkbox">
                                <label for="edit_permissionv_add">Edit</label>
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
                                <label for="user_name_edit">Complete name</label>
                                <input type="text" class="form-control" id="user_name_edit" placeholder="Complete name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cpf_edit">CPF</label>
                                <input type="text" class="form-control" id="cpf_edit" onkeydown="$(this).mask('000.000.000-00');" placeholder="xxx.xxx.xxx-xx">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email_edit">Email</label>
                            <input type="text" class="form-control" id="email_edit" placeholder="exempla@example.com">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone_edit">Phone</label>
                                <input type="text" class="form-control" id="phone_edit" onkeydown="$(this).mask('(00)00000-0000');" placeholder="(99)9999-9999">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="registration_edit">UNIFAE Registration</label>
                                <input type="text" class="form-control" id="registration_edit" onkeydown="$(this).mask('00000-0');" placeholder="Your registration">
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
