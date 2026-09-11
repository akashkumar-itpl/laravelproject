@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Appearance', 'menu-open')
@section('footer', 'active')
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <form
            action="@if ($id == '') {{ route('admin.add-footer-form') }} @else {{ route('admin.update-footer-form', $id) }} @endif"
            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">

            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/footer') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Title*</label>
                                <div class="col-sm-10">
                                    <input id="title" value="{{ old('title', $title) }}" name="title" type="text"
                                        class="form-control">
                                    <span class="text-danger error-text title_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">Content*</label>
                                <div class="col-sm-10">
                                    <textarea id="content" name="content" class="summernote form-control">{{ old('content', $content) }}</textarea>
                                    <span class="text-danger error-text content_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">Additional Class</label>
                                <div class="col-sm-10">
                                    <textarea name="additionalClass" class="form-control">{{ old('additionalClass', $additionalClass) }}</textarea>
                                    <span class="text-danger error-text additionalClass_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sortOrder" class="col-sm-2 col-form-label">Sort Order</label>
                                <div class="col-sm-10">
                                    <input id="sortOrder" value="{{ old('sortOrder', $sortOrder) }}" name="sortOrder"
                                        type="text" class="form-control @error('sortOrder') is-invalid @enderror">
                                    @error('sortOrder')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
