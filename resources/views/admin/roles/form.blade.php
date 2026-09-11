@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Admins', 'menu-open')
@section('roles_list', 'active')
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <form
            action="@if ($id == '') {{ route('admin.add-roles-form') }} @else {{ route('admin.update-roles-form', $id) }} @endif"
            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">

            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/roles') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Role Name</label>
                                <div class="col-sm-6">
                                    <input id="name" value="{{ old('name', $name) }}" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror">
                                    <span class="text-danger error-text name_err"></span>
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
