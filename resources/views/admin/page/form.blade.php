@extends('admin/layout')

@section('page_title', $pageTitle)

@section('Pages', 'menu-open')

@section('list', 'active')

@section('container')

<style>
    #loaderImage{
        display:none;
    }
    </style>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <!-- /.content-header -->

        <form

            action="@if ($id == '') {{ route('admin.add-page-form') }} @else {{ route('admin.update-page-form', $id) }} @endif"

            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">



            <div class="card">

                <div class="card-header card-header-sticky">

                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>

                    <div class="card-tools">

                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i

                                class="fa fa-check"></i></button>

                        |

                        <a href="{{ url('admin/page') }}" class="btn btn-warning btn-sm btn-badge"><i

                                class="right fas fa-angle-left"></i> Back </a>

                    </div>

                </div>

                <!-- /.card-header -->

                <div class="card-body">

                    <div class="card card-info">

                        @csrf

                        <div class="card-body">



                            <div class="card-header bg-primary mb-20">

                                <h3 class="card-title">Page Info</h3>

                            </div>

                            <div class="form-group row">

                                <label for="title" class="col-sm-2 col-form-label">Title</label>

                                <div class="col-sm-10">
<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $title }}"> 
                                    <span class="text-danger error-text title_err"></span>

                                </div>

                            </div>
                            <div class="form-group row">

                            <label for="slug" class="col-sm-2 col-form-label">Slug*</label>

                            <div class="col-sm-10">

                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ $slug }}"> 

                            <span class="text-danger error-text slug_err"></span>

                            </div>
                            @php

                            include(public_path('admin_assets/dist/js/single.php'));

                            @endphp
                            </div>
                            <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label"> Banner Image*</label>
                            <div class="col-sm-10">
                            <input type="file" name="banner" class="SingleimageUpload">
                            </div>
                            </div>

                            @if (!empty($banner))
                            <img src="{{ asset('storage/media/' . $banner) }}"
                            class="preview-image-before-upload image" width="100px" />

                            @endif

                            <div class="form-group row">

                                <label for="content" class="col-sm-2 col-form-label">Content</label>

                                <div class="col-sm-10">

                                    <textarea id="content" name="content"

                                        class="form-control summernote @error('content') is-invalid @enderror">{{ old('content', $content) }}</textarea>

                                    <span class="text-danger error-text content_err"></span>

                                </div>

                            </div>
                          


                            <div class="form-group row">

                                <label for="metaTitle" class="col-sm-2 col-form-label">Meta Title</label>

                                <div class="col-sm-4">

                                    <input id="metaTitle" type="text" value="{{ old('metaTitle', $metaTitle) }}"

                                        name="metaTitle" class="form-control @error('metaTitle') is-invalid @enderror">

                                    @error('metaTitle')

                                        <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>



                                <label for="canonicalUrl" class="col-sm-2 col-form-label">Canonical URL</label>

                                <div class="col-sm-4">

                                    <input id="canonicalUrl" type="text" value="{{ old('canonicalUrl', $canonicalUrl) }}"

                                        name="canonicalUrl"

                                        class="form-control @error('canonicalUrl') is-invalid @enderror">

                                    @error('canonicalUrl')

                                        <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            <div class="form-group row">

                                <label for="metaKeywords" class="col-sm-2 col-form-label">Meta Keywords</label>

                                <div class="col-sm-4">

                                    <textarea id="metaKeywords" name="metaKeywords"

                                        class="form-control @error('metaKeywords') is-invalid @enderror">{{ old('metaKeywords', $metaKeywords) }}</textarea>

                                    @error('metaKeywords')

                                        <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>



                                <label for="metaDescription" class="col-sm-2 col-form-label">Meta Description</label>

                                <div class="col-sm-4">

                                    <textarea id="metaDescription" name="metaDescription"

                                        class="form-control @error('metaDescription') is-invalid @enderror">{{ old('metaDescription', $metaDescription) }}</textarea>

                                    @error('metaDescription')

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



    <script>

        $(function() {

           



            $('#Image').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-Image-before-upload').attr('src', e.target.result);

                }

                reader.readAsDataURL(this.files[0]);

            });

            

        });

    </script>



@endsection

