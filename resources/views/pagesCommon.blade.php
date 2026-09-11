@extends('layouts.site')
@section('metaTitle', $data->metaTitle)
@section('metaKey', $data->metaKeywords)
@section('metaDescription', $data->metaDescription)
@section('canonicalUrl', $data->canonicalUrl)
@section('content')

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
        <!--Start About Section-->

        {!! $data->content !!}

    </main>

@endsection
