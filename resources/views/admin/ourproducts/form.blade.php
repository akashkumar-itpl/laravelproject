@extends('admin/layout')

@section('page_title', $pageTitle)

@section('Posts', 'menu-open')

@section('ourproducts', 'active')

@section('container')

<style> .content {

        height: 225px;

        }</style>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <!-- /.content-header -->

        <form

            action="@if ($id == '') {{ route('admin.add-ourproducts-form') }} @else {{ route('admin.update-ourproducts-form', $id) }} @endif"

            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">



            <div class="card">

                <div class="card-header card-header-sticky">

                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>

                    <div class="card-tools">

                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i

                                class="fa fa-check"></i></button>

                        |

                        <a href="{{ url('admin/ourproducts') }}" class="btn btn-warning btn-sm btn-badge"><i

                                class="right fas fa-angle-left"></i> Back </a>

                    </div>

                </div>

                <!-- /.card-header -->

                <div class="card-body">

                    <div class="card card-info">

                        @csrf

                        <div class="card-body">



                            <div class="card-header bg-primary mb-20">

                                <h3 class="card-title">Our Products Info</h3>

                            </div>



                            <div class="form-group row">

                                <label for="title" class="col-sm-2 col-form-label"> Title*</label>

                                <div class="col-sm-10">

                                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $title) }}">

                                    <span class="text-danger error-text title_err"></span>

                                </div>

                            </div>


    <!-- Home Manage -->
     
                            <div class="form-group row">

                            <label for="home_content" class="col-sm-2 col-form-label">

                           Home Sort Description</label>

                            <div class="col-sm-8">

                            <textarea id="home_content" placeholder="Meta Description" name="home_content" class="form-control content">{{ $home_content }} </textarea>

                            <span class="text-danger error-text home_content_err"></span>

                            </div>

                            </div>
     
                            <div class="form-group row">

                            <label for="home_image" class="col-sm-2 col-form-label">Home Image</label>

                            <div class="col-sm-10">

                            <input id="home_image" name="home_image" type="file" class="form-control SingleimageUpload"

                            aria-required="true" aria-invalid="false" accept="image/*">

                            <span class="text-danger error-text home_image_err"></span>

                            @if ($home_image != '')

                            <a href="{{ asset('storage/media/ourproducts/' . $home_image) }}" target="_blank"><img

                            width="100px" src="{{ asset('storage/media/ourproducts/' . $home_image) }}" /></a>

                            @endif

                            <img width="100px" id="preview-home_image-before-upload" />

                            </div>

                            </div>

                            <div class="form-group row">

                            <label for="htagtitle" class="col-sm-2 col-form-label">Home HashTag Title</label>

                            <div class="col-sm-10">

                            <input type="text" id="htagtitle" name="htagtitle" class="form-control @error('htagtitle') is-invalid @enderror" value="{{ old('htagtitle', $htagtitle) }}">

                            <span class="text-danger error-text htagtitle_err"></span>

                            </div>

                            </div>

<!-- Close -->

                            

                            <div class="form-group row">

                                <label for="image" class="col-sm-2 col-form-label">Image*</label>

                                <div class="col-sm-10">

                                    <input id="image" name="image" type="file" class="form-control SingleimageUpload"

                                    aria-required="true" aria-invalid="false" accept="image/*">

                                    <span class="text-danger error-text image_err"></span>

                                    @if ($image != '')

                                    <a href="{{ asset('storage/media/ourproducts/' . $image) }}" target="_blank"><img

                                    width="100px" src="{{ asset('storage/media/ourproducts/' . $image) }}" /></a>

                                    @endif

                                    <img width="100px" id="preview-image-before-upload" />

                                </div>

                                



                                @php

                                include(public_path('admin_assets/dist/js/single.php'));

                                @endphp



                            </div>

                            <div class="form-group row">

                            <label for="icon" class="col-sm-2 col-form-label"> Icon</label>

                            <div class="col-sm-10">

                            <input type="text" id="icon" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $icon) }}">

                            <span class="text-danger error-text icon_err"></span>

                            </div>

                            </div>


                            <div class="form-group row">

                                <label for="content" class="col-sm-2 col-form-label">

                                    Description</label>

                                    <div class="col-sm-8">

                                        <textarea id="content" placeholder="Meta Description" name="content" class="form-control content">{{ $content }} </textarea>

                                        <span class="text-danger error-text content_err"></span>

                                    </div>

                                </div>

                                

                                <div class="form-group row">

                                    <label for="sortOrder" class="col-sm-2 col-form-label"> Sort Order</label>

                                    <div class="col-sm-2">

                                        <input type="number" id="sortOrder" name="sortOrder" class="form-control @error('sortOrder') is-invalid @enderror" value="{{ old('sortOrder', $sortOrder) }}">

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

