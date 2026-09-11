@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Store','menu-open')
@section('settings','active')
@section('container')


    <div class="content-wrapper">
        <!-- /.content-header -->
        <form
            action="@if ($id == '') {{ route('admin.add-gateway-form') }} @else {{ route('admin.update-gateway-form', $id) }} @endif"
            class="form-horizontal box" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="productId" value="{{ $id }}" id="productId" />
            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>

                    <div class="card-tools" style="width: 55%;margin-right: -14%;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" value="1" id="customSwitch3" name="mode" @if ($mode) checked @endif>
                                    <label class="custom-control-label" for="customSwitch3">Development/Production</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" value="1" id="customSwitch4" name="status" @if ($status) checked @endif>
                                    <label class="custom-control-label" for="customSwitch4">Inactive/Active</label>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <button type="submit" name="add" class="btn btn-info btn-sm badge">Save <i
                                        class="fa fa-check"></i></button>
                                |
                                <a href="{{ url('admin/product') }}" class="btn btn-warning btn-sm badge"><i
                                        class="right fas fa-angle-left"></i> Back </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-12 col-form-label">Titile* @php echo $title; @endphp</label>
                                        <div class="col-sm-12">
                                            <input id="title" value="{{ old('title', $title) }}"
                                                placeholder="Titile" name="title" type="text"
                                                class="form-control @error('title') is-invalid @enderror">
                                            <span class="text-danger error-text title_err"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-12 col-form-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea id="summernote" name="description" type="text"
                                                class="summernote form-control @error('description') is-invalid @enderror">{{ old('description', $description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="thankyouText" class="col-sm-12 col-form-label">Thankyou Text</label>
                                        <div class="col-sm-12">
                                            <textarea id="summernote" name="thankyouText" type="text"
                                                class="summernote form-control @error('thankyouText') is-invalid @enderror">{{ old('thankyouText', $thankyouText) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="payNowButtonText" class="col-sm-12 col-form-label">Pay Now Text Button*</label>
                                        <div class="col-sm-12">
                                            <input id="payNowButtonText" value="{{ old('payNowButtonText', $payNowButtonText) }}"
                                                placeholder="Pay Now Text Button" name="payNowButtonText" type="payNowButtonText"
                                                class="form-control @error('description') is-invalid @enderror">
                                                <span class="text-danger error-text payNowButtonText_err"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="saltKey" class="col-sm-12 col-form-label">Salt Key</label>
                                        <div class="col-sm-12">
                                            <input id="saltKey" value="{{ old('saltKey', $saltKey) }}"
                                                placeholder="Salt Key" name="saltKey" type="saltKey"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="merchantKey" class="col-sm-12 col-form-label">Merchant Key</label>
                                        <div class="col-sm-12">
                                            <input id="merchantKey" value="{{ old('merchantKey', $merchantKey) }}"
                                                placeholder="Merchant Key" name="merchantKey" type="merchantKey"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="testSaltKey" class="col-sm-12 col-form-label">Test Salt Key</label>
                                        <div class="col-sm-12">
                                            <input id="testSaltKey" value="{{ old('testSaltKey', $testSaltKey) }}"
                                                placeholder="Test Salt Key" name="testSaltKey" type="testSaltKey"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="testMerchantKey" class="col-sm-12 col-form-label">Test Merchant Key</label>
                                        <div class="col-sm-12">
                                            <input id="testMerchantKey" value="{{ old('testMerchantKey', $testMerchantKey) }}"
                                                placeholder="Test Merchant Key" name="testMerchantKey" type="testMerchantKey"
                                                class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $id }}" />
                        @if ($id != '')
                            <p class="text-right"><small><strong>Last Updated On:
                                        {{ $updated_at }}</strong></small>
                            </p>
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