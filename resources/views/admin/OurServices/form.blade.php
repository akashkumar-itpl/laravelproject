@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Posts', 'menu-open')
@section('ourservices', 'active')
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <form
            action="@if ($id == '') {{ route('admin.add-ourservices-form') }} @else {{ route('admin.update-ourservices-form', $id) }} @endif"
            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">

            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/ourservices') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body">

                            <div class="card-header bg-primary mb-20">
                                <h3 class="card-title">Service Info</h3>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label"> Title*</label>
                                <div class="col-sm-10">
                                    <input id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $title) }}">
                                    <span class="text-danger error-text title_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">Sub Text</label>
                                <div class="col-sm-10">
                                    <textarea id="content" name="content" class="form-control @error('title') is-invalid @enderror">{{ old('content', $content) }}</textarea>
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mainImage" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input id="mainImage" name="mainImage" type="file" class="form-control"
                                        aria-required="true" aria-invalid="false">
                                    <span class="text-danger error-text mainImage_err"></span>
                                    @if ($mainImage != '')
                                        <a href="{{ asset('storage/media/Images/' . $mainImage) }}" target="_blank"><img
                                                width="100px" src="{{ asset('storage/media/Images/' . $mainImage) }}" /></a>
                                    @endif
                                    <img width="100px" id="preview-mainImage-before-upload" />
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
            $('#mainImage').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-mainImage-before-upload').attr('src', e.target.result);
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
