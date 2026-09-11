@extends('layouts.site')

@section('content')



        <section class="inner-page-banner">



            <div class="container-fluid">



                <img src="{{ URL::asset('storage/media/'.$pageData->banner)}}" alt="">



            </div>



            <div class="container">



                <div class="col-md-12">



                    <nav aria-label="breadcrumb">



                        <ol class="breadcrumb">


                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>

                            @if(!empty($parentMenu))<li class="breadcrumb-item active" aria-current="page">{{ $parentMenu }}</li>@else <li class="breadcrumb-item active" aria-current="page">Our Products</li> @endif
                            


                        </ol>



                    </nav>



                </div>



            </div>



        </section>



        <section class="c_overview" data-aos="fade-up">



            <div class="container">



                <div class="row">



                    <div class="col-md-12">



                        <h2>{{@$pageData->title}}</h2>


                        <p>{!! $pageData->content !!}</p>



                    </div>



                </div>



            </div>



        </section>



        <section class="product-section">



            <div class="container">


                @if($ourproducts)
                @foreach($ourproducts as $product)
                <div class="product-card" id="{{ $product->htagtitle }}">



                    <div class="row align-items-center">



                        <!-- Product Image -->



                        <div class="col-lg-4">



                            <div class="product-image">



                                <img src="{{ URL::asset('storage/media/ourproducts/'.$product->image)}}" alt="{{$product->title}}">



                            </div>



                        </div>



                        <!-- Product Content -->



                        <div class="col-lg-8">



                            <div class="product-content">



                                <div class="product-title">



                                    <div class="product-icon">



                                       {!! $product->icon  !!}


                                    </div>



                                    <div>



                                        <h5>{{ $product->title }}</h5>



                                    </div>



                                </div>

                                {!! $product->content !!}



                            </div>



                        </div>



                        <!-- Variants -->



                    </div>



                </div>
                @endforeach
                @endif












            </div>



        </section>



        <section class="h_usp">



            <div class="container">



                <div class="row justify-content-center">



                    <div class="col-md-12 text-center mb50">



                        <h3>Markets Served</h3>



                    </div>


                    @if(!empty($keyfeature))
                    @foreach($keyfeature as $fdata)
                    <div class="col-md-3" data-aos="fade-up">



                        <div class="main">



                            <img src="{{ URL::asset('storage/media/keyfeatures/'.$fdata->image)}}">



                            <h5>{{ $fdata->title }}</h5>



                            <p>{!! $fdata->content !!}</p>


                        </div>

                    </div>
                    @endforeach
                    @endif


                </div>



            </div>



        </section>



       @endsection