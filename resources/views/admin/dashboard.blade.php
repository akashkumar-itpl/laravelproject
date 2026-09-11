@extends('admin/layout')

@section('page_title', 'Dashboard')

@section('Dashboard', 'active')

@section('container')



@php



$totalseo = GetSeo();
$ourproducts = Getourproducts();

@endphp

<style>



                     

.info-box-top {

border-radius: 1rem;

overflow: hidden;

background: #fff;

transition: all 0.3s ease;





border-radius: 1rem;

box-shadow: 0 0 15px rgba(213 162 164); 

color: #fff;

transition: 0.3s 

ease;

border: 2px solid transparent;

}



.info-box-top:hover {

  box-shadow: 0 0 25px #da1a22, 0 0 0px #da1a22 inset;

  transform: translateY(-6px);

  }



.info-header {

background: linear-gradient(90deg, #ff7eb3, #ff758c);

color: #fff;

font-weight: 600;

padding: 0.8rem;

font-size: 1.1rem;

}

.info-body .info-link {

color: #555;

text-decoration: none;

font-weight: 600;

}

.info-body .info-link:hover {

color: #ff758c;

}

.info-number {

font-size: 2rem;

font-weight: 700;

color: #222;

}



.info-header-2 {

background: linear-gradient(90deg, #0089ff, #0089ff);

color: #fff;

font-weight: 600;

padding: 0.8rem;

font-size: 1.1rem;

}

.info-header-3 {

background: linear-gradient(90deg, #e11545, #e11545);

color: #fff;

font-weight: 600;

padding: 0.8rem;

font-size: 1.1rem;

}

.info-header-4 {

background: linear-gradient(90deg, #6c757d, #6c757d);

color: #fff;

font-weight: 600;

padding: 0.8rem;

font-size: 1.1rem;

}

.info-body-2 .info-link-2:hover {

color: #e11545;

}

.info-number {

font-size: 2rem;

font-weight: 700;

color: #222;

}



</style>



    

    <div class="content-wrapper">

        <!-- Content Header lodu lalit (Page header) -->

        <div class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">

                        <h1 class="m-0">Dashboard</h1>

                    </div><!-- /.col -->

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="#">Home</a></li>

                            <li class="breadcrumb-item active">@yield('page_title')</li>

                        </ol>

                    </div><!-- /.col -->

                </div><!-- /.row -->

            </div><!-- /.container-fluid -->

        </div>

        <!-- /.content-header -->



        <!-- Main content -->

        <section class="content">

            <div class="container-fluid">

                <!-- Info boxes -->

                <div class="row">

                 

                    <!-- <div class="col-12 col-sm-6 col-md-3">

                    <div class="info-box-top p-0 mb-4">

                    <div class="info-header d-flex align-items-center justify-content-center">

                    <i class="fas fa-newspaper me-2"></i>

                    &nbsp;<span>News</span>

                    </div>

                    <div class="info-body text-center p-3">

                    <a href="{{ url('/admin/news') }}" class="info-link">View Details</a>

                    <div class="info-number mt-2">2</div>

                    </div>

                    </div>

                    </div> -->






                    <div class="col-12 col-sm-6 col-md-3">

                    <div class="info-box-top p-0 mb-4">

                    <div class="info-header-3 d-flex align-items-center justify-content-center">

                    <i class="fas fa-search me-2"></i>



                    &nbsp;<span>Pages</span>

                    </div>

                    <div class="info-body-2 text-center p-3">

                    <a href="{{ url('/admin/page') }}" class="info-link-2">View Details</a>

                    <div class="info-number mt-2">{{$totalseo}}</div>

                    </div>

                    </div>

                    </div>

                    <div class="col-12 col-sm-6 col-md-3">

                    <div class="info-box-top p-0 mb-4">

                    <div class="info-header-2 d-flex align-items-center justify-content-center">
                   
                    <i class="fas fa-cubes me-2"></i>

                    &nbsp;<span>Our Products</span>

                    </div>

                    <div class="info-body-2 text-center p-3">

                    <a href="{{ url('/admin/ourproducts') }}" class="info-link-2">View Details</a>

                    <div class="info-number mt-2">{{ $ourproducts }}</div>

                    </div>

                    </div>

                    </div> 



                 



                   



                    <!-- fix for small devices only -->

                    <div class="clearfix hidden-md-up"></div>

                </div>

                <!-- /.row -->

        </section>

        <!-- /.content -->





        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->



@endsection

