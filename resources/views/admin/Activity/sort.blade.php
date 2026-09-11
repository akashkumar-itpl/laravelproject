@extends('admin/layout')
@section('page_title', 'Manage Sort')
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
        <div class="container my-5">
            <h1>Sort Services</h1>
            <form action="{{route('admin.servicesortUpdate')}}"  class="form-horizontal"  name="ApplyOnlineForm" id="ApplyOnlineForm" method="post" enctype="multipart/form-data">
                @csrf
                <ul class="list-group " id="dropZone">
                    @foreach ($service as $service)
                    <div class="list-group-item">
                        <input type="button"  value="{{$service['title']}}" name="sortingDataval[]">
                        <input type="hidden"  value="{{$service['id']}}" name="sortingDataid[]">
                    </div>
                    @endforeach
                </ul>
                <br>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
    <script>
        $(function() {
            $("#dropZone").sortable({
                revert: true,
            });
        });
    </script>
@endsection
