@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Posts', 'menu-open')
@section('contact_us', 'active')
@section('container')

<div class="content-wrapper">
    <form
        action="@if ($id == '') {{ route('admin.add-contact-us-form') }} @else {{ route('admin.update-contact-us-form', $id) }} @endif"
        class="form-horizontal" id="adminForm" method="post" enctype="multipart/form-data">

        <div class="card">
            <div class="card-header card-header-sticky">
                <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                <div class="card-tools">
                    <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i class="fa fa-check"></i></button>
                    |
                    <!-- <a href="{{ url('admin/contact_us') }}" class="btn btn-warning btn-sm btn-badge">
                        <i class="right fas fa-angle-left"></i> Back
                    </a> -->
                </div>
            </div>

            <div class="card-body">
                <div class="card card-info">
                    @csrf
                    <div class="card-body">

                        <div class="card-header bg-primary mb-20">
                            <h3 class="card-title">Contact Info</h3>
                        </div>

                        {{-- Title --}}
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title*</label>
                            <div class="col-sm-10">
                                <input id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $title) }}">
                                <span class="text-danger error-text title_err"></span>
                            </div>
                        </div>

                        {{-- Banner --}}
                        <div class="form-group row">
                            <label for="banner" class="col-sm-2 col-form-label">Banner*</label>
                            <div class="col-sm-10">
                                <input id="banner" name="banner" type="file" class="form-control">
                                <span class="text-danger error-text banner_err"></span>
                                @if ($banner != '')
                                    <a href="{{ asset('storage/media/Images/' . $banner) }}" target="_blank">
                                        <img width="100px" src="{{ asset('storage/media/Images/' . $banner) }}" />
                                    </a>
                                @endif
                                <img width="100px" id="preview-banner-before-upload" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Address Image*</label>
                            <div class="col-sm-10">
                                <input id="image" name="image" type="file" class="form-control">
                                <span class="text-danger error-text image_err"></span>
                                @if ($image != '')
                                    <a href="{{ asset('storage/media/Images/' . $image) }}" target="_blank">
                                        <img width="100px" src="{{ asset('storage/media/Images/' . $image) }}" />
                                    </a>
                                @endif
                                <img width="100px" id="preview-image-before-upload" />
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address*</label>
                            <div class="col-sm-10">
                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                                    rows="3">{{ old('address', $address) }}</textarea>
                                <span class="text-danger error-text address_err"></span>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email*</label>
                            <div class="col-sm-10">
                                <input id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $email) }}">
                                <span class="text-danger error-text email_err"></span>
                            </div>
                        </div>

                        {{-- Mobile --}}
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile 1*</label>
                            <div class="col-sm-6">
                                <input type="text" id="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                                    value="{{ old('mobile', $mobile) }}" maxlength="14">
                                <span class="text-danger error-text mobile_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile1" class="col-sm-2 col-form-label">Mobile 2*</label>
                            <div class="col-sm-6">
                                <input type="text" id="mobile1" name="mobile1" class="form-control @error('mobile1') is-invalid @enderror"
                                    value="{{ old('mobile1', $mobile1) }}" maxlength="14">
                                <span class="text-danger error-text mobile1_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile2" class="col-sm-2 col-form-label">Mobile 3*</label>
                            <div class="col-sm-6">
                                <input type="text" id="mobile2" name="mobile2" class="form-control @error('mobile2') is-invalid @enderror"
                                    value="{{ old('mobile2', $mobile2) }}" maxlength="14">
                                <span class="text-danger error-text mobile2_err"></span>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $id }}" />
                        @if ($id != '')
                            <p class="text-right"><small><strong>Last Updated On: {{ $updated_at }}</strong></small></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Image Preview Script --}}
<script>
    $(function() {
        $('#banner').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-banner-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('#image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>

@endsection
