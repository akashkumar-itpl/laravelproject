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

                            <li class="breadcrumb-item active" aria-current="page">R&D </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </section>

        <section class="c_overview" data-aos="fade-up">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <h2>{{ $pageData->title }} </h2>

                    <p>{!! $pageData->content !!}</p>

                    </div>

                </div>

            </div>

        </section>

        <section class="reserch_dev">

            <div class="container">

                <div class="row">


                  @if(!empty($development))
                  @foreach($development as $dev)
                    <div class="col-md-6">

                        <div class="main">

                            <div class="mg">

                                <img src="{{ URL::asset('storage/media/researchdevelopments/'.$dev->image)}}">

                            </div>

                            <div class="content">

                                <h5>{{ $dev->title }}</h5>

                               {!! $dev->content !!}

                            </div>

                        </div>

                    </div>
                 @endforeach
                 @endif
                </div>

            </div>

        </section>

       @endsection