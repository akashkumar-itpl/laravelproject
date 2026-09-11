@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Posts', 'menu-open')
@section('ourservices', 'active')
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <form
            action="@if ($id == '') {{ route('admin.add-activity-form') }} @else {{ route('admin.update-activity-form', $id) }} @endif"
            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">

            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/activity') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body">

                            <div class="card-header bg-primary mb-20">
                                <h3 class="card-title">Activity Info</h3>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label"> Title*</label>
                                <div class="col-sm-10">
                                    <textarea id="title" name="title" class="form-control @error('title') is-invalid @enderror">{{ old('title', $title) }}</textarea>
                                    <span class="text-danger error-text title_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="image" class="col-form-label">Image*</label>
                                    {{-- Image Section Start --}}
                                    <div class="row imageSection">
                                        <div class="col-md-4">
                                            <label class="btn btn-sm btn-info" for="image">Upload File</label>
                                            <input id="image" name="image" type="file"
                                                class="form-control hide image" aria-required="true" aria-invalid="false">

                                        </div>
                                        <div class="col-md-8">
                                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                                id="imageId">Choose
                                                From
                                                activity</button>
                                            <input type="hidden" name="imageactivity" class="imageactivity">
                                        </div>

                                        <div class="col-md-12 previewBox">
                                            @if (isset($image))
                                                <img src="{{ asset('storage/media/' . $image) }}"
                                                    class="preview-image-before-upload image" width="100px" />
                                            @else
                                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                                    class="preview-image-before-upload image" width="100px" />
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-danger error-text image_err"></span>
                                    {{-- Image Section END --}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vedio" class="col-sm-2 col-form-label"> Vedio</label>
                                <div class="col-sm-10">
                                    <textarea id="vedio" name="vedio" class="form-control @error('vedio') is-invalid @enderror">{{ old('vedio', $vedio) }}</textarea>
                                    <span class="text-danger error-text vedio_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-sm-2 col-form-label"> Slug </label>
                                <div class="col-sm-10">
                                    <textarea id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror">{{ old('slug', $slug) }}</textarea>
                                    <span class="text-danger error-text slug_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-sm-2 col-form-label"> Sort </label>
                                <div class="col-sm-10">
                                    <input id="sortOrder" name="sortOrder" type="text" class="form-control"
                                        aria-required="true" value="{{ old('sortOrder', $sortOrder) }}">
                                    <span class="text-danger error-text sortOrder_err"></span>
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
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('#categoryId').select2({
                theme: 'bootstrap4'
            });

            $('#featuredImage').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-featuredImage-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#mainImage').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-mainImage-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#imageone').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-imageone-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#imagetwo').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-imagetwo-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#imagethree').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-imagethree-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#imagefour').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-imagefour-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#imagefive').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-imagefive-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#imagesix').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-imagesix-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
