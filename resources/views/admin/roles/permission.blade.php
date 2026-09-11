@extends('admin/layout')
@section('page_title', $pageTitle)
@section('Member', 'menu-open')
@section('member_list', 'active')
@section('container')



    <style>
        .box_8w74674gv {
            border: 1px solid #2fb1eb;
            margin-bottom: 20px;
        }


        .box_8w74674gv .panel-title {
            font-size: 15px;
            margin-bottom: 0px;
        }

        .box_8w74674gv .panel-default>.panel-heading {
            color: #333;
            background-color: #2fb1eb;
            padding: 0;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .box_8w74674gv .panel-default>.panel-heading a {
            display: block;
            padding: 10px 15px;
            color: #fff;
        }

        .box_8w74674gv .panel-default>.panel-heading a:after {
            content: "";
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            float: right;
            transition: transform .25s linear;
            -webkit-transition: -webkit-transform .25s linear;
        }

        .box_8w74674gv .panel-default>.panel-heading a[aria-expanded="true"] {
            background-color: #2fb1eb;
        }

        .box_8w74674gv .panel-default>.panel-heading a[aria-expanded="true"]:after {
            content: "\2212";
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .box_8w74674gv .panel-default>.panel-heading a[aria-expanded="false"]:after {
            content: "\002b";
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }


        .box_8w74674gv .nav-item a {
            color: #000;
        }

        .mb20 {
            margin-bottom: 20px;
        }

    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <form action="{{ route('admin.roles-permision-form', $id) }}" class="form-horizontal" name="ApplyOnlineForm"
            id="adminForm" method="post" enctype="multipart/form-data">

            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/roles') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>


                <div class="card-body">
                    <div class="card card-info">
                        @csrf
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{-- @php print_r(array_values($Permisionlist));@endphp --}}

                            {{-- <div class="form-group row"  style=" border:solid 1px #ddd;">
                @foreach ($AdminMenulist as $val)
                 
                <div class="col-sm-4" style="margin-bottom:10px;  padding:10px;">
                  <input type="checkbox" name="fileid[]" value="{{$val->id}}"  > &nbsp;&nbsp; {{$val->title}}
                </div>
                @endforeach
                 
              </div> --}}
                            <div class="row mb20">
                                <div class="col-md-12">
                                    <div class="caption">
                                        <button type="button" class="btn  btn-info btn-xs bluebut"
                                            onclick="selectAllPermission(this)">Select All</button>
                                        <button type="button" class="btn  btn-danger btn-xs greenbut"
                                            onclick="unSelectAllPermission(this)">Unselect All</button>
                                        <button type="button" class="btn  btn-info btn-xs show_button bluebut"
                                            onclick="showAllPermission()">Show All</button>



                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                @foreach ($AdminMenulist as $val)
                                    <div class="col-md-3">
                                        <div class="panel-group box_8w74674gv" id="accordion" role="tablist"
                                            aria-multiselectable="true">

                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingTwo">
                                                    <h4 class="panel-title">
                                                        <a class="boxpermision collapsed" role="button"
                                                            data-toggle="collapse" data-parent="#accordion"
                                                            href="#collapse{{ $val->id }}" aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            {{ $val->title }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse{{ $val->id }}" class="panel-collapse collapse"
                                                    role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="panel-body">
                                                        <ul class="nav flex-column">
                                                            @php
                                                                $adminid = $val->id;
                                                                $submenulist = getSubMenuPermission($adminid);
                                                            @endphp
                                                            @foreach ($submenulist as $menu)
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link"> {{ $menu->title }}
                                                                        <span class="pull-right ">
                                                                            <input type="checkbox"
                                                                                class="permission_checkbok" id=""
                                                                                name="permissions[]"
                                                                                value="{{ $menu->id }}"
                                                                                @if (in_array($menu->id, $Permisionlist)) checked @endif></span>
                                                                    </a>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @endforeach





                            </div>








                        </div>




                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $id }}" />
                        @if ($id != '')
                            <p class="text-right"><small><strong>Last Updated On: {{ $updated_at }}</strong></small>
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


    <script type="text/javascript">
        function selectAllPermission() {
            $(".panel-group").slideDown(function() {
                $('.boxpermision').removeClass('collapsed');
                $('.panel-collapse').show();
            });
            $(".permission_checkbok").prop('checked', true);
            $('.select_all').addClass('hide');
            $('.deselect_all').removeClass('hide');
        }

        function unSelectAllPermission() {
            $(".card-body").slideDown();
            $(".permission_checkbok").prop('checked', false);
            $('.select_all').removeClass('hide');
            $('.deselect_all').addClass('hide');
        }

        function showAllPermission() {
            $(".panel-group").slideDown(function() {
                $('.boxpermision').removeClass('collapsed');
                $('.panel-collapse').show();
            });
        }
    </script>
@endsection
