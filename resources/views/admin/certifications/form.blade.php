@extends('admin/layout')

@section('page_title', $pageTitle)

@section('Posts', 'menu-open')

@section('certifications', 'active')

@section('container')



    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <!-- /.content-header -->

        <form

            action="@if ($id == '') {{ route('admin.add-certifications-form') }} @else {{ route('admin.update-certifications-form', $id) }} @endif"

            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">



            <div class="card">

                <div class="card-header card-header-sticky">

                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>

                    <div class="card-tools">

                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i

                                class="fa fa-check"></i></button>

                        |

                        <a href="{{ url('admin/certifications') }}" class="btn btn-warning btn-sm btn-badge"><i

                                class="right fas fa-angle-left"></i> Back </a>

                    </div>

                </div>

                <!-- /.card-header -->

                <div class="card-body">

                    <div class="card card-info">

                        @csrf

                        <div class="card-body">



                            <div class="card-header bg-primary mb-20">

                                <h3 class="card-title">Certifications Info</h3>

                            </div>



                            <div class="form-group row">

                                <label for="title" class="col-sm-2 col-form-label"> Title*</label>

                                <div class="col-sm-10">

                                    <input id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $title) }}">

                                    <span class="text-danger error-text title_err"></span>

                                </div>

                            </div>

                            <div class="form-group row">

<label for="image" class="col-sm-2 col-form-label">Image*</label>

<div class="col-sm-10">

    <input id="image" name="image" type="file" class="form-control"

        aria-required="true" aria-invalid="false" accept="image/*">

    <span class="text-danger error-text image_err"></span>

    @if ($image != '')

        <a href="{{ asset('storage/media/Images/' . $image) }}" target="_blank"><img

                width="100px" src="{{ asset('storage/media/certifications/' . $image) }}" /></a>

    @endif

    <img width="100px" id="preview-image-before-upload" />

</div>

</div>

                            <div class="form-group row">

                                <label for="pdf" class="col-sm-2 col-form-label">PDF*</label>

                                <div class="col-sm-10">

                                    <input id="pdf" name="pdf" type="file" class="form-control"

                                        aria-required="true" aria-invalid="false" accept=".pdf,application/pdf">

                                    <span class="text-danger error-text pdf_err"></span>

                                    @if ($pdf != '')

                                        <a href="{{ asset('storage/media/certifications/' . $pdf) }}" target="_blank"><img

                                                width="100px" src="{{ asset('storage/media/certifications/' . $image) }}" /></a>

                                    @endif

                                    <img width="100px" id="preview-pdf-before-upload" />

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

