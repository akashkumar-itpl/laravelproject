@extends('admin/layout')
@section('page_title', 'Manage Home Banner')
@section('info', 'Manage Home Page Banners from here.')
@section('Appearance', 'menu-open')
@section('banner_list', 'active')
@section('container')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-size: 1.6em">@yield('page_title') <sup><a href="#"
                            data-toggle="tooltip" data-placement="top" title="@yield('info')"><i
                                class="fa fa-info-circle"></i></a></sup></h3>
                <div class="card-tools">
                    {{-- <a href="{{url('admin/homebanner-sort')}}" class="btn btn-success badge">Sort <small><i
                        class="right fas fa-sort"></i></small></a> |  --}}
                    <a onClick="multiTaskOperation('Delete',this)" data-taskurl="{{ url('admin/homebanner-multitask') }}"
                        data-original-title="Delete the selected records? " class="btn btn-danger badge">Delete <small><i
                                class="right fas fa-trash"></i></small></a>
                    | <a onClick="multiTaskOperation('Activate',this)"
                        data-taskurl="{{ url('admin/homebanner-multitask') }}"
                        data-original-title="Activate the selected records? " class="btn btn-info badge">Activate <small><i
                                class="right fas fa-check"></i></small></a>
                    | <a onClick="multiTaskOperation('Block',this)" data-taskurl="{{ url('admin/homebanner-multitask') }}"
                        data-original-title="Block the selected records? " class="btn btn-warning badge">Block <small><i
                                class="right fas fa-ban"></i></small></a>

                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @include('admin.home.bannerForm')
                    </div>
                    <div class="col-md-8">
                        <table id="example1" class="table table-bordered table-sm table-striped">
                            <thead>
                                <tr>
                                <tr>

                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Page</th>
                                    <th><i class="fa fa-image"></i></th>
                                    <th><i class="fa fa-mobile-phone"></i></th>
                                    <th>Display Order</th>
                                    <th class="text-center">Action</th>
                                    <th class="table-checkbox text-center align-middle"><input type="checkbox"
                                            class="group-checkable" data-set="#example1 .checkboxes" /></th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <script type="text/javascript">
        //=== CONFIRM FOR DELETION ===\\
        function check() {
            var a = confirm("Are your sure want to delete data?");
            if (a == true) {
                return true;
            } else {
                return false;
            }
        }
        //=== CONFIRM FOR DELETION ENDS ===\\
    </script>

    <script>
        $(function() {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ajaxBannerList') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'page'
                    },
                    {
                        data: 'desktopBanner'
                    },
                    {
                        data: 'mobileBanner'
                    },
                    {
                        data: 'sortOrder'
                    },
                    {
                        data: 'action'
                    },
                    {
                        data: 'check'
                    },
                ],
                order: [
                    [0, "desc"]
                ],
                columnDefs: [{
                        className: 'text-center',
                        targets: [2, 3, 5, 6, 7]
                    },
                    {
                        orderable: false,
                        targets: [2, 3, 5, 6, 7]
                    },
                ],
                language: {
                    // processing: "<img src='{{ URL::asset('front/img/loader.gif') }}'>"
                }
            });
        });
    </script>

@endsection
