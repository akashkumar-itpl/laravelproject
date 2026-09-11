@extends('admin/layout')
@section('page_title', 'View Log Activity')
@section('info', 'View Log Activity.')
@section('Admin', 'menu-open')
@section('admin_list', 'active')
@section('container')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-size: 1.6em">@yield('page_title') <sup><a href="#" data-toggle="tooltip"
                            data-placement="top" title="@yield('info')"><i class="fa fa-info-circle"></i></a></sup></h3>
                {{-- <div class="card-tools">
                    <a href="{{ url('admin/add-admin') }}" class="btn btn-success badge">Add <small><i
                                class="right fas fa-plus"></i></small></a>
                    | <a onClick="multiTaskOperation('Delete',this)" data-taskurl="{{ url('admin/admin-multitask') }}"
                        data-original-title="Delete the selected records? " class="btn btn-danger badge">Delete <small><i
                                class="right fas fa-trash"></i></small></a>
                    | <a onClick="multiTaskOperation('Activate',this)" data-taskurl="{{ url('admin/admin-multitask') }}"
                        data-original-title="Activate the selected records? " class="btn btn-info badge">Activate <small><i
                                class="right fas fa-check"></i></small></a>
                    | <a onClick="multiTaskOperation('Block',this)" data-taskurl="{{ url('admin/admin-multitask') }}"
                        data-original-title="Block the selected records? " class="btn btn-warning badge">Block <small><i
                                class="right fas fa-ban"></i></small></a>

                </div> --}}

            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="example1" class="table table-bordered table-sm table-striped">
                    <thead>
                        <tr>
                        <tr>
                            <th width="5%">ID</th>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Url</th>
                            <th>IP</th>
                            <th>Date</th>



                        </tr>
                        </tr>
                    </thead>
                </table>

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
                ajax: "{{ route('admin.ajaxLogActivityList') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'subject'
                    },
                    {
                        data: 'url'
                    },
                    {
                        data: 'ip'
                    },
                    {
                        data: 'created_at'
                    },
                ],
                order: [
                    [0, "desc"]
                ],
                columnDefs: [{
                        className: 'text-center',
                        targets: [1, 2]
                    },
                    {
                        orderable: false,
                        targets: [1, 2]
                    },

                ],
                language: {
                    processing: "<img src='{{ URL::asset('front/images/loader.gif') }}'>"
                }
            });
        });
    </script>
@endsection
