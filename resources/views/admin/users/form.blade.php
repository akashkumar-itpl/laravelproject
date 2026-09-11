@extends('admin/layout')
@section('page_title', $pageTitle)
@section('coupons', 'menu-open')
@section('list', 'active')
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <form
            action="@if ($id == '') {{ route('admin.add-authorisation-form') }} @else {{ route('admin.update-authorisation-form', $id) }} @endif"
            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">

            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/authorisation') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body faqs">

                            <div class="form-group row">
                                <label for="category" class="col-sm-2 col-form-label"> Title*</label>
                                <div class="col-sm-6">
                                    {{-- <select  id="category" name="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($allCategories as $allCategoriesData)
                                            <option value="{{ $allCategoriesData->id }}" @if ($allCategoriesData->id == $categoryId) selected @endif>{{ $allCategoriesData->categoryName }}</option>
                                        @endforeach
                                    </select> --}}
                                    <input name="title" type="text" class="form-control"
                                        value="{{ old('title', $title) }} ">
                                    <span class="text-danger error-text title_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description *</label>
                                <div class="col-sm-6">
                                    <textarea id="description" name="description" type="text"
                                        class="summernote form-control @error('description') is-invalid @enderror">{{ old('description', $description) }}</textarea>
                                    <span class="text-danger error-text description_err"></span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="categoryImage" class="col-form-label">Thumbnail Image</label>
                                    {{-- Image Section Start --}}
                                    <div class="row imageSection">
                                        <div class="col-md-4">
                                            <label class="btn btn-sm btn-info" for="categoryImage">Upload Image</label>
                                            <input id="categoryImage" name="categoryImage" type="file"
                                                class="form-control hide image" aria-required="true" aria-invalid="false">
                                            <span class="text-danger error-text categoryImage_err"></span>
                                        </div>
                                        <div class="col-md-8">
                                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                                id="categoryImageId">Choose
                                                From
                                                Gallery</button>
                                            <input type="hidden" name="categoryImageGallery" class="categoryImageGallery">
                                        </div>

                                        <div class="col-md-12 previewBox">
                                            @if (isset($categoryImage))
                                                <img src="{{ asset('storage/media/' . $categoryImage) }}"
                                                    class="preview-image-before-upload image" width="100px" />
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
                                <div class="col-sm-12">
                                    <label for="pdfFile" class="col-form-label">Pdf Upload</label>
                                    {{-- Image Section Start --}}
                                    <input type="file" name="pdfFile" id="pdfFile" />
                                    <span class="text-danger error-text pdfFile_err"></span>

                                    @if (isset($pdfFile))
                                        <a href="{{ asset('storage/pdf/' . $pdfFile) }}" target="_blank">Pdf File</a>
                                    @endif

                                </div>
                                {{-- Image Section END --}}
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
