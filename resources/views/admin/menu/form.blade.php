@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Menu', 'menu-open')
@section('menu', 'active')
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <form
            action="@if ($id == '') {{ route('admin.add-menu-form') }} @else {{ route('admin.update-menu-form', $id) }} @endif"
            class="form-horizontal" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">

            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        {{-- |
                        <a href="{{ url('admin/menu') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a> --}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body">
                            <div class="card-header bg-primary mb-20">
                                <h3 class="card-title">Menu Info</h3>
                            </div>

                            <div class="form-group row">
                                <label for="menuName" class="col-sm-2 col-form-label">Menu Name*</label>
                                <div class="col-sm-8">
                                    <input id="menuName" name="menuName" value="{{ old('menuName', $menuName) }}" type="text"
                                        class="form-control @error('menuName') is-invalid @enderror">
                                    @error('menuName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="examId" class="col-sm-2 col-form-label">Exam*</label>
                                <div class="col-sm-8">
                                    <select name="examId" id="examId"
                                        class="form-control @error('examId') is-invalid @enderror">
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $key => $val)
                                            @if (Request::old('examId') == $val->id || $examId == $val->id)
                                                <option value="{{ $val->id }}" selected>{{ $val->examName }}</option>
                                            @else
                                                <option value="{{ $val->id }}">{{ $val->examName }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('examId')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-header bg-primary mb-20">
                                <h3 class="card-title">Locations</h3>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <select name="cityId[]" id="cityId"
                                        class="form-control select2 @error('examId') is-invalid @enderror"
                                        multiple="multiple" data-placeholder="Select City">
                                        <option value="">Select Cities</option>
                                        @foreach ($city as $citykey => $cityval)
                                            @if (Request::old('cityId') == $cityval->id || $cityId == $cityval->id)
                                                <option value="{{ $cityval->id }}" selected>{{ $cityval->cityName }}
                                                </option>
                                            @else
                                                <option value="{{ $cityval->id }}">{{ $cityval->cityName }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-header bg-primary mb-20">
                                <h3 class="card-title">Colleges</h3>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <select name="collegeId[]" id="collegeId" class="form-control select2"
                                        multiple="multiple" data-placeholder="Select College">
                                        <option value="">Select Colleges</option>
                                    </select>
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
            $('#cityId,#collegeId').select2({
                theme: 'bootstrap4'
            });

            $('#examId').change(function() {
                var examId = $(this).val();
                if (examId) {
                    $.ajax({
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "examId": examId
                        },
                        url: "{{ url('admin/getColleges') }}",
                        beforeSend: function() {
                            $("#loaderImage").show();
                        },
                        complete: function() {
                            $("#loaderImage").hide();
                        },
                        success: function(res) {
                            if (res) {
                                $("#collegeId").empty();
                                $("#collegeId").append('<option>Select Colleges</option>');
                                $.each(res, function(key, value) {
                                    $("#collegeId").append('<option value="' + key +
                                        '">' + value + '</option>');
                                });
                            } else {
                                $("#collegeId").empty();
                            }
                        }
                    });
                } else {
                    $("#collegeId").empty();
                }
            });
        });
    </script>
@endsection
