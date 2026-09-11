@extends('admin/layout')

@section('page_title','Manage Contact Us')
@section('info','Manage Contact Us details such as banner, title, address, email, and mobile.')
@section('Posts','menu-open')
@section('contact_us','active')

@section('container')

<div class="content-wrapper">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-size: 1.6em">
        @yield('page_title')
        <sup>
          <a href="#" data-toggle="tooltip" data-placement="top" title="@yield('info')">
            <i class="fa fa-info-circle"></i>
          </a>
        </sup>
      </h3>
      <div class="card-tools">
        | <a href="{{url('admin/add-contact-us')}}" class="btn btn-success badge">
          Add <small><i class="right fas fa-plus"></i></small></a>
        | <a onClick="multiTaskOperation('Delete',this)" data-taskurl="{{url('admin/contact-us-multitask')}}" data-original-title="Delete selected records?" class="btn btn-danger badge">
          Delete <small><i class="right fas fa-trash"></i></small></a>
        | <a onClick="multiTaskOperation('Activate',this)" data-taskurl="{{url('admin/contact-us-multitask')}}" data-original-title="Activate selected records?" class="btn btn-info badge">
          Activate <small><i class="right fas fa-check"></i></small></a>
        | <a onClick="multiTaskOperation('Block',this)" data-taskurl="{{url('admin/contact-us-multitask')}}" data-original-title="Block selected records?" class="btn btn-warning badge">
          Block <small><i class="right fas fa-ban"></i></small></a>
      </div>
    </div>

    <div class="card-body">
      <table id="example1" class="table table-bordered table-sm table-striped">
        <thead>
          <tr>
            <th width="5%">ID</th>
            <th>Banner</th>
            <th>Title</th>
            <th>Address</th>
            <th>Email</th>
            <th>Mobile</th>
            <th class="text-center">Action</th>
            <th class="table-checkbox text-center align-middle" width="4%">
              <input type="checkbox" class="group-checkable" data-set="#example1 .checkboxes"/>
            </th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<script>
$(function() {
  $('#example1').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{route('admin.ajaxcontact_usList')}}",
    columns: [
      { data: 'id' },
      { data: 'banner' },
      { data: 'title' },
      { data: 'address' },
      { data: 'email' },
      { data: 'mobile' },
      { data: 'action' },
      { data: 'check' },
    ],
    columnDefs: [
      { className: 'text-center', targets: [6,7] },
      { orderable: false, targets: [1,6,7] },
    ],
    language: {
      processing: "<img src='{{URL::asset('front/images/loader.gif')}}'>"
    }
  });
});
</script>

@endsection
