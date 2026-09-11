@extends('layouts.site')

@section('content')

        <section class="inner-page-banner">

            <div class="container-fluid">

                <img src="{{ URL::asset('storage/media/'.$pageData->banner)}}">

            </div>

            <div class="container"> 

                <div class="col-md-12">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Compliance & Certifications</li>

                        </ol>

                    </nav>

                </div>

            </div>

        </section>

        <section class="c_overview" data-aos="fade-up">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <h2>{{$pageData->title}}</h2>

                        {!! $pageData->content !!}

                    </div>

                </div>

            </div>

        </section>

        <!------------Certificate Section Start----------------->

        <section class="compliance">

            <div class="container top" data-aos="fade-up">

                <h3>Our Certifications</h3>

            </div>

            <div class="container">

                <div class="row">




                   @if(!empty($development))
                   @foreach($development as $dev)
                    <div class="col-md-3 col-6" data-aos="fade-up">

                        <a href="{{asset('storage/media/certifications/' . $dev->pdf)}}" target="_blank">

                            <div class="certificate-card">

                                <div class="certificate-image">

                                    <img src="{{ URL::asset('storage/media/certifications/'.$dev->image)}}" alt="Certificate">

                                </div>

                                <div class="certificate-footer">

                                    <p class="certificate-btn">

                                        View PDF<i class="fas fa-arrow-right"></i>

                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>
                    @endforeach
                    @endif





                </div>

            </div>

        </section>

        <!------------Certificate Section End----------------->

        @endsection