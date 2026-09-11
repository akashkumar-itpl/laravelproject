@extends('layouts.site')

@section('metaTitle', $data->metaTitle)

@section('metaKey', $data->metaKeywords)

@section('metaDescription', $data->metaDescription)

@section('canonicalUrl', $data->canonicalUrl)



@section('content')

    {{-- <main class="main__content_wrapper"> --}}

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 innerbread">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $data->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid inner__slider">
        <div class="row">
            <img src="{{ URL::asset('storage/media/Images/' . $data->Image) }}" alt="{{ $data->ImageAlt }}"
                title="{{ $data->ImageTitle }}" class="img-fluid w100" />
            <div class="details">
                <div class="mt10 mb10" data-aos="fade-up">
                    <h1>{{ $data->title }}</h1>
                    <a href="{{ url('/contact-us') }}" class="common_btn1 mt30">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid section-padding mutual__fund">

        <div class="container">

            <div class="row">

                <div class="col-md-2"></div>

                <div class="col-md-8">

                    <p>{!! $data->content !!}</p>


                </div>

            </div>

        </div>

    </div>

    @if (!empty($data->imageone))
        <div class="container-fluid section-padding mutual__fund1">

            <div class="container">

                <div class="row text-center">

                    <div class="col-md-12" data-aos="fade-up">

                        @if (!empty($data->heading))
                            <h2 class="mb40">{{$data->heading}}</h2>
                        @endif

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4 mb50" data-aos="fade-up">

                        <div class="usp_box">

                            <h3><span><img src="{{ URL::asset('storage/media/Images/' . $data->imageone) }}" /></span>{{$data->titleone}}</h3>

                            @if (!empty($data->descriptionone))
                                <p>{{$data->descriptionone}}</p>
                            @endif

                        </div>

                    </div>

                    <div class="col-md-4 mb50" data-aos="fade-up">

                        <div class="usp_box">

                            <h3><span><img src="{{ URL::asset('storage/media/Images/' . $data->imagetwo) }}" /></span>{{$data->titletwo}}</h3>

                            @if (!empty($data->descriptiontwo))
                                <p>{{$data->descriptiontwo}}</p>
                            @endif

                        </div>

                    </div>

                    <div class="col-md-4 mb50" data-aos="fade-up">

                        <div class="usp_box bor0">

                            <h3><span><img src="{{ URL::asset('storage/media/Images/' . $data->imagethree) }}" /></span>{{$data->titlethree}}</h3>

                            @if (!empty($data->descriptionthree))
                                <p>{{$data->descriptionthree}}</p>
                            @endif

                        </div>

                    </div>

                    <div class="col-md-4" data-aos="fade-up">

                        <div class="usp_box">

                            <h3><span><img src="{{ URL::asset('storage/media/Images/' . $data->imagefour) }}" /></span>{{$data->titlefour}}</h3>

                            @if (!empty($data->descriptionfour))
                                <p>{{$data->descriptionfour}}</p>
                            @endif

                        </div>

                    </div>

                    <div class="col-md-4" data-aos="fade-up">

                        <div class="usp_box">

                            <h3><span><img src="{{ URL::asset('storage/media/Images/' . $data->imagefive) }}" /></span>{{$data->titlefive}}</h3>

                            @if (!empty($data->descriptionfive))
                                <p>{{$data->descriptionfive}}</p>
                            @endif

                        </div>

                    </div>

                    <div class="col-md-4" data-aos="fade-up">

                        <div class="usp_box bor0">

                            <h3><span><img src="{{ URL::asset('storage/media/Images/' . $data->imagesix) }}" /></span>{{$data->titlesix}}</h3>

                            @if (!empty($data->descriptionsix))
                                <p>{{$data->descriptionsix}}</p>
                            @endif

                        </div>

                    </div>


                </div>

            </div>

        </div>
    @endif

    @if (!empty($faqData->toArray()))
        <div class="container-fluid section-padding bg_a1">

            <div class="container">

                <div class="row" data-aos="fade-up">

                    <div class="col-md-12">

                        <div id="accordion" class="myaccordion">

                            @foreach ($faqData as $faq)
                                <div class="card">
                                    <div class="card-header" id="heading{{ $faq->id }}">
                                        <h2 class="mb-0">
                                            <button class="d-flex align-items-center justify-content-between btn btn-link"
                                                data-toggle="collapse" data-target="#collapse{{ $faq->id }}"
                                                aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                                {{ $faq->title }}
                                                <span class="fa-stack fa-2x">
                                                    <i class="fa fa-circle fa-stack-2x"></i>
                                                    <i class="fa {{ $loop->first ? 'fa-minus' : 'fa-plus' }} fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse{{ $faq->id }}"
                                        class="collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $faq->id }}" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>{!! $faq->content !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endif

    @if (!empty($data->content2))
        <div class="container-fluid section-padding mutual__fund">

            <div class="container">

                <div class="row">

                    <div class="col-md-8 offset-md-2">

                        <p>{!! $data->content2 !!}</p>


                    </div>

                </div>

            </div>

        </div>
    @endif

    {{-- </main> --}}

@endsection
