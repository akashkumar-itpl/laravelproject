@extends('layouts.site')
@section('metaTitle', $data->metaTitle)
@section('metaKey', $data->metaKeywords)
@section('metaDescription', $data->metaDescription)
@section('canonicalUrl', $data->canonicalUrl)
@section('content')
    {{-- @php
    prx($data->toArray());
@endphp --}}
    <main>

        <div class="page-banner-area bg-2" style="background-image: url({{ URL::asset('storage/media/' . $bannerImage) }});">
            <div class="container">
                <div class="page-banner-content">
                    <h1>{{ $data->title }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        @if (!empty($parentMenu))
                            <li>{{ $parentMenu }}</li>
                        @else
                        @endif
                        <li>{{ $data->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--End Page Banner-->

        @if ($data->type == 'image')
            <div class="events-area pt-100 pb-70">
                <div class="container">
                    {!! $data->content !!}
                    <div class="row justify-content-center">
                        @foreach ($fileData as $value)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-events-card style-4">
                                    <div class="events-image">
                                        <a target="_blank" href="{{ URL::asset('storage/media/' . $value->file) }}"><img
                                                src="{{ URL::asset('storage/media/' . $value->file) }}"></a>
                                    </div>
                                    <div class="events-content">
                                        <a target="_blank" href="{{ URL::asset('storage/media/' . $value->file) }}">
                                            <h3>{{ $value->title }}</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!--Start About Section-->
            <div class="rte-area ptb-70">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $data->title }}</h2>
                    </div>
                    <div class="row card-row justify-content-center">
                        @foreach ($fileData as $value)
                            <div class="col-sm-2">
                                <a target="_blank" href="{{ URL::asset('storage/media/' . $value->file) }}">
                                    <div class="card">
                                        <div class="card-body download">
                                            <h5 class="card-title">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </h5>
                                            <h6 class="card-subtitle mb-2">{{ $value->title }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </main>

@endsection
