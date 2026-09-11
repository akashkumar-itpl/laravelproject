<!DOCTYPE html>

<html lang="en">



<head>

    @php

        $adminData = getAdminData();

    @endphp

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $adminData['siteTitle'] }} | ADMIN</title>

    <link rel="icon" type="{{ asset('storage/media/admin/' . $adminData['favicon']) }}" sizes="16x16"

        href="{{ asset('storage/media/admin/' . $adminData['favicon']) }}">



    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet"

        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Tempusdominus Bootstrap 4 -->

    <link rel="stylesheet"

        href="{{ URL::asset('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- iCheck -->

    <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- JQVMap -->

    {{-- <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/jqvmap/jqvmap.min.css')}}"> --}}

    <!-- Theme style -->

    <link rel="stylesheet" href="{{ URL::asset('admin_assets/dist/css/adminlte.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ URL::asset('admin_assets/dist/css/image-uploader.min.css') }}"> --}}

    <!-- overlayScrollbars -->

    <link rel="stylesheet"

        href="{{ URL::asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Daterange picker -->

    {{-- <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/daterangepicker/daterangepicker.css')}}"> --}}



    <!-- summernote -->

    {{-- <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/summernote/summernote-bs4.min.css') }}"> --}}

    <!-- CodeMirror -->

    <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/codemirror/codemirror.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/codemirror/theme/monokai.css') }}">





    <link rel="stylesheet"

        href="{{ URL::asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet"

        href="{{ URL::asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet"

        href="{{ URL::asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- SweetAlert2 -->

    <link rel="stylesheet"

        href="{{ URL::asset('admin_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">



    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"

        type="text/css" />



    <!-- Select2 -->

    <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet"

        href="{{ URL::asset('admin_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">





    <!-- jQuery -->

    <script src="{{ URL::asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>



    <!-- jQuery UI 1.11.4 -->

    <script src="{{ URL::asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- DataTables  & Plugins -->

    <script src="{{ URL::asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ URL::asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ URL::asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">

    </script>

    <script src="{{ URL::asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">

    </script>

    <script src="{{ URL::asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ URL::asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>



    <!-- Select2 -->

    <script src="{{ URL::asset('admin_assets/plugins/select2/js/select2.full.min.js') }}"></script>



    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Nestable JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js"></script>

    {{-- <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script> --}}





    <style>

        :root {

            --primary: {{ $adminData['primaryColor'] }};



        }



        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,

        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {

            background-color: {{ $adminData['mainMenuBackgroundColor'] }};

            color: {{ $adminData['mainMenuTextColor'] }};

        }



        [class*=sidebar-light-] .nav-treeview>.nav-item>.nav-link.active,

        [class*=sidebar-light-] .nav-treeview>.nav-item>.nav-link.active:hover {

            background-color: {{ $adminData['subMenuBackgroundColor'] }};

            color: {{ $adminData['subMenuTextColor'] }};

            border: 1px solid {{ $adminData['subMenuBorderColor'] }};

        }



        textarea.form-control {
        /* height: auto; */
        height: 270px !important;
        }

    </style>



    <script>

        var APP_URL = {!! json_encode(url('/')) !!}

    </script>

</head>



<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        {{-- <div class="loaderDiv" id="loaderImage" style="background: {{ $adminData['loaderBackground'] }}"> --}}

        <div class="loaderDiv" id="loaderImage">

            <img src="{{ asset('storage/media/admin/' . $adminData['loader']) }}" alt="" class="" id="">

        </div>



        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand  navbar-light"

            @if (\App::isDownForMaintenance()) style="background: linear-gradient(45deg, #ff0018, #ffffff00);" @endif>

            <!-- Left navbar links -->

            <ul class="navbar-nav">

                <li class="nav-item">

                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i

                            class="fas fa-bars"></i></a>

                </li>

                @if (\App::isDownForMaintenance())

                    <li class="nav-item">

                        <h4 style="color: #fff">WEBSITE IS UNDER MAINTENANCE MODE</h4>

                    </li>

                @endif

            </ul>



            <ul class="navbar-nav ml-auto">



                <li class="nav-item">

                    <a class="nav-link" href="{{ url('/') }}" target="_blank">

                        <i class="fas fa-globe"></i> Visit Site

                    </a>

                </li>



                {{-- <li class="nav-item dropdown">

                    <a class="nav-link" data-toggle="dropdown" href="#">

                        <i class="fas fa-trash"></i> Clear Cache

                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <span class="dropdown-item dropdown-header">Clear Various Cache</span>

                        <div class="dropdown-divider"></div>



                        <a href="{{ url('/config-cache') }}" class="dropdown-item">

                            <i class="fas fa-trash mr-2"></i> Clear Configuration Cache

                        </a>

                        <div class="dropdown-divider"></div>



                        <a href="{{ url('/route-cache') }}" class="dropdown-item">

                            <i class="fas fa-trash mr-2"></i> Clear Route Cache

                        </a>

                        <div class="dropdown-divider"></div>



                        <a href="{{ url('/view-cache') }}" class="dropdown-item">

                            <i class="fas fa-trash mr-2"></i> Clear View Cache

                        </a>

                        <div class="dropdown-divider"></div>



                        <a href="{{ url('/event-cache') }}" class="dropdown-item">

                            <i class="fas fa-trash mr-2"></i> Clear Events Cache

                        </a>

                        <div class="dropdown-divider"></div>



                        <a href="{{ url('/application-cache') }}" class="dropdown-item">

                            <i class="fas fa-trash mr-2"></i> Clear Application Cache

                        </a>

                        <div class="dropdown-divider"></div>



                        <a href="{{ url('/all-cache') }}" class="dropdown-item dropdown-footer"> <i

                                class="fas fa-trash mr-2"></i> Clear All

                            Cache</a>

                    </div>

                </li>



                <li class="nav-item">

                    <div class="daynight">

                        <label for="checkboxDarkMode">

                            <input type="checkbox" id="checkboxDarkMode">

                            <div class="toggle">

                                <div class="cloud"></div>

                                <div class="star"></div>

                                <div class="sea"></div>

                                <div class="mountains"></div>

                            </div>

                        </label>

                    </div>

                </li> --}}



                {{-- <li class="nav-item dropdown">

                    <a class="nav-link" data-toggle="dropdown" href="#">

                        <i class="far fa-bell"></i>

                        <span class="badge badge-warning navbar-badge">15</span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <span class="dropdown-item dropdown-header">15 Notifications</span>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">

                            <i class="fas fa-envelope mr-2"></i> 4 new messages

                            <span class="float-right text-muted text-sm">3 mins</span>

                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">

                            <i class="fas fa-users mr-2"></i> 8 friend requests

                            <span class="float-right text-muted text-sm">12 hours</span>

                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">

                            <i class="fas fa-file mr-2"></i> 3 new reports

                            <span class="float-right text-muted text-sm">2 days</span>

                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>

                    </div>

                </li> --}}



                {{-- <li class="nav-item">

                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">

                        <i class="fas fa-expand-arrows-alt"></i>

                    </a>

                </li> --}}





                <li class="nav-item">

                    <a class="nav-link" href="javascript:void(0)" role="button">

                        <span id="clock">-:--:-- --</span>

                    </a>

                </li>



                <li class="dropdown user user-menu mt-2">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <!-- <img src="{{ URL::asset('admin_assets/imageupload/user.jpg') }}" class="user-image"

                            alt="User Image"> -->

                        <span class="hidden-xs">

                            {{ auth()->guard('admin')->user()->firstName }}

                            {{ auth()->guard('admin')->user()->lastName }}

                        </span>

                    </a>

                    <ul class="dropdown-menu">

                        <!-- User image -->

                        <li class="user-header">

                            <!-- <img src="{{ URL::asset('admin_assets/imageupload/user.jpg') }}" class="img-circle"

                                alt="User Image"> -->



                            <p>

                                {{ auth()->guard('admin')->user()->firstName }}

                                {{ auth()->guard('admin')->user()->lastName }}

                                <small>Logged since Nov. 2012</small>

                            </p>

                        </li>



                        <!-- Menu Footer-->

                        <li class="user-footer">

                            {{-- <div class="pull-left">

                                <a href="{{ url('admin/edit-admin/'.Crypt::encrypt(auth()->guard('admin')->user()->id)) }}" class="btn btn-primary label btn-sm btn-round"><i

                                        class="nav-icon fas fa-edit"></i>

                                    Edit Profile</a>

                            </div> --}}

                            <div class="pull-right">

                                <a href="{{ url('admin/logout') }}" class="btn btn-danger label btn-sm btn-round"><i

                                        class="nav-icon fas fa-power-off"></i> Log

                                    out</a>

                            </div>

                        </li>

                       

                    </ul>

                </li>



            </ul>



        </nav>

        <!-- /.navbar -->



        <!-- Main Sidebar Container -->

        <aside class="main-sidebar sidebar-light-primary elevation-4">

            <!-- Brand Logo -->

            <a href="" class="brand-link" style="text-align: center;">

                <img src="{{ asset('storage/media/admin/' . $adminData['logo']) }}" alt="ITPL Logo"

                    style="width: 100px">



            </a>



            <!-- Sidebar -->

            <div class="sidebar">

                {{-- style="@if (isset($adminData['sidebarBgColor'])) background-color:{{ $adminData['sidebarBgColor'] }} @endIf" --}}





                <!-- Sidebar Menu -->

                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"

                        data-accordion="false">

                        <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->

                        <li class="nav-item">

                            <a href="{{ url('admin/dashboard') }}" class="nav-link dashboard  @yield('Dashboard')">

                                <i class="nav-icon fas fa-tachometer-alt"></i>

                                <p>

                                    Dashboard

                                </p>

                            </a>

                        </li>



                        @php

                            $AdminMenuData = getAdminMenu();

                        @endphp

                        {!! $AdminMenuData !!}



                    </ul>

                </nav>

                <!-- /.sidebar-menu -->

            </div>

            <!-- /.sidebar -->

        </aside>



        @yield('container')

    @show

    <input type="hidden" value="{{ url('admin/') }}" id="url" name="url">



    {{-- <footer class="main-footer" style="padding: 0px">

        <small>

            <strong>Copyright &copy; 2021-{{ now()->year + 1 }} <a href="#">sculpt wellness</a>.</strong>

            All rights reserved. | Powered By <strong><a href="#">ITPL</strong></a>

            <div class="float-right d-none d-sm-inline-block">

                <b>Laravel Version</b> 8.33.1,

                <b>PHP Version</b> 7.4

            </div>

        </small>

    </footer> --}}



    <!-- Control Sidebar -->

    <aside class="control-sidebar control-sidebar-dark">

        <!-- Control sidebar content goes here -->

    </aside>

    <!-- /.control-sidebar -->

</div>

<!-- ./wrapper -->







<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>

    $.widget.bridge('uibutton', $.ui.button);

</script>

<!-- Bootstrap 4 -->

<script src="{{ URL::asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- daterangepicker -->

<script src="{{ URL::asset('admin_assets/plugins/moment/moment.min.js') }}"></script>

<script src="{{ URL::asset('admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->

<script src="{{ URL::asset('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">

</script>

<!-- Summernote -->

{{-- <script src="{{ URL::asset('admin_assets/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}

<!-- CodeMirror -->

<script src="{{ URL::asset('admin_assets/plugins/codemirror/codemirror.js') }}"></script>

<script src="{{ URL::asset('admin_assets/plugins/codemirror/mode/css/css.js') }}"></script>

<script src="{{ URL::asset('admin_assets/plugins/codemirror/mode/xml/xml.js') }}"></script>

<script src="{{ URL::asset('admin_assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

<script src="{{ URL::asset('admin_assets/plugins/chart.js/Chart.min.js') }}"></script>

<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>



<script src="{{ URL::asset('admin_assets/form.js') }}"></script>

<script src="{{ URL::asset('admin_assets/common.js') }}"></script>

<script src="{{ URL::asset('admin_assets/jquery.imagesloader-1.0.1.js') }}"></script>



<!-- AdminLTE App -->

<script src="{{ URL::asset('admin_assets/dist/js/adminlte.js') }}"></script>



<!-- SweetAlert2 -->

<script src="{{ URL::asset('admin_assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@php

    include(public_path('admin_assets/dist/js/filecomp.php'));

@endphp



@include('flash-message')

@include('common-script')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<!--Code for Confirm Multiple Task-->

<div class="modal fade bs-modal-xl" id="galleryDiv" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header" style="background:#00124b;color:#fff">

                <h4 id="alert_message_div_header text-left" style="width: 100%;">Choose an image</h4>

            </div>

            <div class="row adminMediaRow" height="400px">



            </div>

            <div class="row">

                <div class="col-md-12 text-center">

                    <button class="btn btn-sm btn-primary" id="loadMore">Load More</button>

                </div>

            </div>

        </div>

    </div>

</div>

<!--End Code for Confirm Multiple Task-->





</body>



</html>

