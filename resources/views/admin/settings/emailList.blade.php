@extends('admin/layout')
@section('page_title', $pageTitle)
@section('info','Manage your email settings from here.')
@section('Store','menu-open')
@section('settings','active')
@section('container')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->
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
                            <table id="example1" class="table table-bordered table-sm table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email Name</th>
                                        <th>Recipients</th>
                                        <th>Status</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                </tr>
                                </thead>
                            
                                <tbody>
                            
                                </tbody>
                            
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    $(function() {
        $('#example1').DataTable({
            processing: true,
            serverSide: true,
            drawCallback: function(settings, json) {
                $('[data-toggle="tooltip"]').tooltip('update');
            },
            ajax: "{{route('admin.ajaxEmailList')}}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'title'
                },
                {
                    data: 'recipients'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                }
            ],
            order: [
                [0, "asc"]
            ],
            columnDefs: [{
                    className: 'text-center',
                    targets: [3, 4]
                },
                {
                    orderable: false,
                    targets: [3, 4]
                },


            ],
            language: {
                // processing: "<img src='{{URL::asset('front/img/Loader.gif')}}'>"
            }
        });

    });
</script>

@endsection