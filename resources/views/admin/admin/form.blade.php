@extends('admin/layout')
@section('page_title', 'Add Admin')
@section('info', 'Add User Admins.')
@section('Admin', 'menu-open')
@section('admin_list', 'active')
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <form
            action="@if ($id == '') {{ route('admin.add-admin-form') }} @else {{ route('admin.update-admin-form', $id) }} @endif"
            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">

            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/admin') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-6">
                                    <input id="firstName" value="{{ old('firstName', $firstName) }}" name="firstName"
                                        type="text" class="form-control @error('firstName') is-invalid @enderror">
                                    <span class="text-danger error-text firstName_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-6">
                                    <input id="lastName" value="{{ old('lastName', $lastName) }}" name="lastName"
                                        type="text" class="form-control @error('lastName') is-invalid @enderror">
                                    <span class="text-danger error-text lastName_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phoneNumber" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-6">
                                    <input id="phoneNumber" value="{{ old('phoneNumber', $phoneNumber) }}"
                                        name="phoneNumber" type="text"
                                        class="form-control @error('phoneNumber') is-invalid @enderror">
                                    <span class="text-danger error-text phoneNumber_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email Id</label>
                                <div class="col-sm-6">
                                    <input id="email" value="{{ old('email', $email) }}" name="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror">
                                    <span class="text-danger error-text email_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-6">
                                    <input id="password" autocomplete="new-password" name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    <span class="text-danger error-text password_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-6">
                                    <input id="confirmPassword" name="confirmPassword" type="text"
                                        class="form-control @error('confirmPassword') is-invalid @enderror">
                                    <span class="text-danger error-text confirmPassword_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-6">
                                    <select class="form-control select2" name="roleId" id="roleId">
                                        <option value="">Select Role</option>
                                        @forelse ($roles as $rolesKey=>$rolesValue)
                                            <option value="{{ $rolesKey }}"
                                                @if ($rolesKey == $roleId) selected @endif>
                                                {{ $rolesValue }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="text-danger error-text roleId_err"></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="id" value="{{ $id }}" />
                            @if ($id != '')
                                <p class="text-right"><small><strong>Last Updated On:
                                            {{ $updated_at }}</strong></small></p>
                            @endif
                        </div>
                        <!-- /.card-footer -->

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
    </div>


@endsection
