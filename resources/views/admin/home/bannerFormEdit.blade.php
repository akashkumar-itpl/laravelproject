@extends('admin/layout')
@section('page_title', 'Manage Home Banner')
@section('info', 'Manage Home Page Banners from here.')
@section('Appearance', 'menu-open')
@section('banner_list', 'active')
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->


        <form action="{{ route('admin.update-homebanner-form', $id) }}" class="form-horizontal" name="ApplyOnlineForm"
            id="adminForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/homebanner') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">

                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="title" class="col-form-label">Select Page</label>
                                    <select name="menu_id" id="menu_id"
                                        class="form-control @error('menu_id') is-invalid @enderror">
                                        <option value="">Select Page </option>
                                        @foreach ($menu as $key => $val)
                                            @if (Request::old('menu_id') == $val->id || $menu_id == $val->id)
                                                <option value="{{ $val->id }}" selected>{{ $val->title }}
                                                </option>
                                            @else
                                                <option value="{{ $val->id }}">{{ $val->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="title" class="col-form-label">Banner Title*</label>
                                    <input id="title" value="{{ old('title', $title) }}" name="title" type="text"
                                        class="form-control">
                                    <span class="text-danger error-text title_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="bannerImage" class="col-form-label">Desktop Banner Image* <small>( 1349*500
                                            )</small></label>
                                    {{-- Image Section Start --}}
                                    <div class="row imageSection">
                                        <div class="col-md-4">
                                            <label class="btn btn-sm btn-info" for="bannerImage">Upload File</label>
                                            <input id="bannerImage" name="bannerImage" type="file"
                                                class="form-control hide image" aria-required="true" aria-invalid="false">

                                        </div>
                                        <div class="col-md-8">
                                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                                id="bannerImageId">Choose
                                                From
                                                Gallery</button>
                                            <input type="hidden" name="bannerImageGallery" class="bannerImageGallery">
                                        </div>

                                        <div class="col-md-12 previewBox">
                                            @if ($bannerImage != '')
                                                <img src="{{ asset('storage/media/' . $bannerImage) }}"
                                                    class="preview-image-before-upload image" width="250px" />
                                            @else
                                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                                    class="preview-image-before-upload image" width="100px" />
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-danger error-text bannerImage_err"></span>
                                    {{-- Image Section END --}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="mobImage" class="col-form-label">Mobile Banner Image <small>( 400*500
                                            )</small></label>
                                    {{-- Image Section Start --}}
                                    <div class="row imageSection">
                                        <div class="col-md-4">
                                            <label class="btn btn-sm btn-info" for="mobImage">Upload File</label>
                                            <input id="mobImage" name="mobImage" type="file"
                                                class="form-control hide image" aria-required="true" aria-invalid="false">
                                            <span class="text-danger error-text mobImage_err"></span>
                                        </div>
                                        <div class="col-md-8">
                                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                                id="mobImageId">Choose
                                                From
                                                Gallery</button>
                                            <input type="hidden" name="mobImageGallery" class="mobImageGallery">
                                        </div>

                                        <div class="col-md-12 previewBox">
                                            @if ($mobImage != '')
                                                <img src="{{ asset('storage/media/' . $mobImage) }}"
                                                    class="preview-image-before-upload image" width="250px" />
                                            @else
                                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                                    class="preview-image-before-upload image" width="100px" />
                                            @endif
                                        </div>
                                    </div>
                                    {{-- Image Section END --}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="content" class="col-form-label">Content Over Banner</label>
                                    <textarea id="content" name="content" type="text"
                                        class="summernote form-control @error('content') is-invalid @enderror">{{ old('content', $content) }}</textarea>
                                    <span class="text-danger error-text content_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="redirectUrl" class="col-form-label">Redirect To</label>
                                    <input id="redirectUrl" value="{{ old('redirectUrl', $redirectUrl) }}"
                                        name="redirectUrl" type="text" class="form-control">
                                    <span class="text-danger error-text redirectUrl_err"></span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="sortOrder" class="col-form-label">Display Order</label>
                                    <input id="sortOrder" value="{{ old('sortOrder', $sortOrder) }}" name="sortOrder"
                                        type="number" class="form-control">
                                    <span class="text-danger error-text sortOrder_err"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
