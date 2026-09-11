@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Store','menu-open')
@section('settings','active')
@section('container')


    <div class="content-wrapper">
        <div class="card">
            <div class="card-header ">
                <h3 class="card-title" style="font-size: 1.6em">@yield('page_title') <sup><a href="#" data-toggle="tooltip"
                            data-placement="top" title="@yield('info')"><i class="fa fa-info-circle"></i></a></sup></h3>
                
            </div>
    
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        @include('admin.settings.tabHeader')
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" role="tabpanel" >
                                <form action="{{ route('admin.update-shipping-form', $id) }}"
                                    class="form-horizontal box" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="{{ $id }}" id="id" />
                                    <div class="card">
                                        <div class="card-header card-header-sticky">
                                            <h3 class="card-title" style="font-size: 1.6em">Charges Applicable on cart</h3>

                                            <div class="card-tools">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input" value="1" id="customSwitch4" name="status" @if ($status) checked @endif>
                                                            <label class="custom-control-label" for="customSwitch4">Inactive/Active</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <button type="submit" name="add" class="btn btn-info btn-sm badge">Save <i
                                                                class="fa fa-check"></i></button>
                                                        |
                                                        <a href="{{ url('admin/settings-shipping') }}" class="btn btn-warning btn-sm badge"><i
                                                                class="right fas fa-angle-left"></i> Cancel </a>
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
                                                                <label for="minCartValue" class="col-sm-3 col-form-label">Min Cart Value</label>
                                                                <div class="col-sm-9">
                                                                    <input id="minCartValue" value="{{ old('minCartValue', $minCartValue) }}"
                                                                        placeholder="Min Cart Value" name="minCartValue" type="text"
                                                                        class="form-control @error('minCartValue') is-invalid @enderror">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="ChargesApplicable" class="col-sm-3 col-form-label">Charges Applicable (Incl GST 18%)</label>
                                                                <div class="col-sm-9">
                                                                    <input id="ChargesApplicable" value="{{ old('ChargesApplicable', $ChargesApplicable) }}"
                                                                        placeholder="Charges Applicable (Incl GST 18%)" name="ChargesApplicable" type="text"
                                                                        class="form-control @error('ChargesApplicable') is-invalid @enderror">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection