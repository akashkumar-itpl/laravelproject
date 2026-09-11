@extends('admin/layout')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->
        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">

                <div class="clearfix"></div>



                <div class="row gimage"></div>
                <div class="row bg-white">
                    <div class="container">


                        <div class="row mt50">
                            <div class="col-md-12 text-center"><img src="{{ URL::asset('front/img/denied.jpg') }}"
                                    style="width:auto; float:none; display:inline-block;width:600px"></div>
                            <div class="col-md-12">
                                <h3 class="text-center">Access Denied</h3>
                            </div>
                            <div class="col-md-12">
                                <p class="text-center"> Sorry!You Don't have permission to view this section.</p>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    >
@endsection
