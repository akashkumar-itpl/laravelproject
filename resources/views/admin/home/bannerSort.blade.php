@extends('admin/layout')
@section('page_title', 'Sort Banner')
@section('info', 'Manage Sort Details.')
@section('Sort', 'menu-open')
@section('Sort_list', 'active')
@section('container')

    <style>
        input[type='button'] {
            border: none;
            background: none
        }
    </style>

    <div class="content-wrapper">
        <form action="{{route('admin.homebannersortUpdate')}}"  class="form-horizontal"  name="ApplyOnlineForm" id="adminForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header card-header-sticky">
                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title')</h3>
                    <div class="card-tools">
                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                                class="fa fa-check"></i></button>
                        |
                        <a href="{{ url('admin/homebanner') }}" class="btn btn-warning btn-sm btn-badge"><i
                                class="right fas fa-angle-left"></i> Back </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card card-info">

                        <div class="card-body">
                            <ul class="list-group " id="dropZone">
                                @foreach ($banners as $banner)
                                <div class="list-group-item">
                                    <label for=""></label>
                                    <input type="button"  value="{{ strip_tags($banner['title']) }}" name="sortingDataval[]">
                                    <input type="hidden"  value="{{ $banner['id'] }}" name="sortingDataid[]">
                                </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
    <script>
        $(function() {
            // var values = [ ];
            $("#dropZone").sortable({
                revert: true,
            });
        });
    </script>
@endsection
