@extends('layouts.site')
@section('metaTitle', '404 Page Note Found')
@section('metaKey', '404 Page Note Found')
@section('metaDescription', '404 Page Note Found')
@section('canonicalUrl', '404 Page Note Found')
@section('content')

    <div class="row gimage"></div>
    <div class="row mb20">
        <div class="container page_404 text-center">
            <h2 class="text-center" style="text-align: center;">
                <img src="{{ asset('front/img/maintenance.jpg') }}" width="500px" alt="">
            </h2>
            <h2 class="text-center" style="text-align: center;">Site is under maintenance. Please check
                after sometime</h2>
        </div>
    </div>


@endsection
