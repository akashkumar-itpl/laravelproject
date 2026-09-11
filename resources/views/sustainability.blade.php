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

                            <li class="breadcrumb-item active" aria-current="page">Sustainability & ESG</li>

                        </ol>

                    </nav>

                </div>

            </div>

        </section>
        

        <section class="sustainability" data-aos="fade-up">

            <div class="container">

                <!-- Card 1 -->


                @if(!empty($sustainability))

@foreach($sustainability as $sus)

    <div class="esg-card" data-aos="fade-up">

        <div class="row align-items-center">

            <div class="col-lg-6 {{ $loop->even ? 'order-lg-2 order-1' : '' }}">
                <div class="esg-content">
                    <h3>{{ $sus->title }}</h3>

                    {!! $sus->content !!}
                </div>
            </div>

            <div class="col-lg-6 {{ $loop->even ? 'order-lg-1 order-2' : '' }}">
                <div class="esg-image">
                    <img
                        src="{{ URL::asset('storage/media/sustainabilitys/' . $sus->image) }}"
                        alt="{{ $sus->title }}"
                    >
                </div>
            </div>

        </div>

    </div>

@endforeach

@endif





            </div>

        </section>

        @endsection