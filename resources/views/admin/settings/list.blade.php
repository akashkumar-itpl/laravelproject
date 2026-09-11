@extends('admin/layout')
@section('page_title', $pageTitle)
@section('info','Manage your settings from here.')
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
                        <div class="tab-pane fade show active" id="custom-tabs-gernal" role="tabpanel"
                            aria-labelledby="custom-tabs-gernal-tab">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper
                            dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo.
                            Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque
                            tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique
                            senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit
                            suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo
                            est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus
                            quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum
                            ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
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

@endsection