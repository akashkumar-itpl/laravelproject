@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Store','menu-open')
@section('settings','active')
@section('container')


    <div class="content-wrapper">
        <!-- /.content-header -->
        <form action="@if ($id == '') {{ route('admin.add-email-form') }} @else {{ route('admin.update-email-form', $id) }} @endif"
            class="form-horizontal box" name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="productId" value="{{ $id }}" id="productId" />
            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>

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
                                <a href="{{ url('admin/settings-email') }}" class="btn btn-warning btn-sm badge"><i
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
                                        <label for="recipient" class="col-sm-12 col-form-label">Recipients</label>
                                        <div class="col-sm-12">
                                            <input id="recipient" value="{{ old('recipient', $recipient) }}"
                                                placeholder="Recipients" name="recipient" type="text"
                                                class="form-control @error('recipient') is-invalid @enderror">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="subject" class="col-sm-12 col-form-label">Subject*</label>
                                        <div class="col-sm-12">
                                            <input id="subject" value="{{ old('subject', $subject) }}"
                                                placeholder="Subject" name="subject" type="subject"
                                                class="form-control @error('subject') is-invalid @enderror">
                                                <span class="text-danger error-text subject_err"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="bodyTemplate" class="col-sm-12 col-form-label">Template</label>
                                        <div class="col-sm-12">
                                            <textarea id="bodyTemplate" name="bodyTemplate" type="text"
                                                class="summernote form-control @error('bodyTemplate') is-invalid @enderror">{{ old('bodyTemplate', $bodyTemplate) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="defaultTemplate" class="col-sm-12 col-form-label">Default Template <span style="color:rgb(19, 19, 231); cursor: pointer;"  onclick="myFunction()">copy text</span></label>
                                        <div class="col-sm-12">
                                            <textarea id="defaultTemplate" name="defaultTemplate" readonly rows="6" type="text"
                                                class="form-control @error('defaultTemplate') is-invalid @enderror">{{ old('defaultTemplate', $defaultTemplate) }}</textarea>
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
        </form>
    </div>
    
    <script>
        function myFunction() {
            var copyText = document.getElementById("defaultTemplate");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            Toast.fire({
                icon: 'success',
                title: "Text copied."
            });
        }
    </script>

@endsection