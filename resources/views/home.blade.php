@extends('layouts.site')

@section('metaTitle', $frontData['metaTitle'])

@section('metaKey', $frontData['metaKeywords'])

@section('metaDescription', $frontData['metaDescription'])

@section('canonicalUrl', $frontData['canonicalUrl'])

@section('content')

    @php

        use Carbon\Carbon;

        $extension = Str::afterLast($frontData['bannerFile'], '.');

    @endphp



    <!-- main-area -->

    <div class="main">

    <!--Start Banner Area-->

    @if ($extension == 'mp4')

    <div>

            <video muted="muted" loop="" playsinline="" preload="metadata" poster="img/videoframe_1603.png" width="100%" class="home_video_banner" autoplay="">

                <source type="video/mp4" src="{{ URL::asset('storage/media/' . $frontData['bannerFile']) }}">

            </video>

       </div>

    @else

        <section class="inner_banner">

            <img src="{{ URL::asset('storage/media/' . $frontData['bannerFile']) }}" class="w-100 desk">

            <img src="{{ URL::asset('storage/media/' . $frontData['bannerMobile']) }}" class="w-100 mob">

            <div class="content">

                <div class="container">

                    <div class="row">

                        <div class="col-md-6"></div>

                        <div class="col-md-6" data-aos="fade-up">

                            <nav aria-label="breadcrumb">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">About Us</li>

                                </ol>

                            </nav>



                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif



			<!------------Hero Banner Section End----------------->



			<!------------About Us Section Start----------------->



			<section class="c_overview" data-aos="fade-up">



				<div class="container">



					<div class="row">



						<div class="col-md-9">



							<h2>{{ $aboutData['homesectionHeading'] }}</h2>



							<p>{!! $aboutData['homesectionContent'] !!}</p>



							<a href="{{ url($aboutData['homesectionlink']) }}" class="btn_4 learn-more">



								<span class="circle"><span class="icon arrow"></span></span>



								<span class="button-text">Read More</span>



							</a>



						</div>



						<div class="col-md-3">

							<img src="{{ URL::asset('storage/media/'.$aboutData['homesectionImage'])}}" alt="{{ $aboutData['homesectionHeading'] }}">

						</div>



					</div>



				</div>
			</section>

			<!------------About Us Section End----------------->
			<!------------Why Choose Section Start----------------->
			@if(!empty($keyfeature))
			<section class="h_usp">

				<div class="container">

					<div class="row">
                        
						@foreach($keyfeature as $fdata)
					
						<div class="col-md-3 mset" data-aos="fade-up">

							<div class="main">

								<img src="{{ URL::asset('storage/media/keyfeatures/'.$fdata->image)}}">

								<h5>{{ $fdata->title }}</h5>

								<p>{!! $fdata->content !!}</p>

							</div>
						</div>
						@endforeach

					</div>

				</div>

			</section>
			@endif
			<!------------Why Choose Section End----------------->

			<!------------Product Section Start----------------->

			<section class="product_services">

				<div class="container">

					<div class="col-md-12 top_head" data-aos="fade-up">

						<h2>{{ $frontData['pands'] }}</h2>

						<p>{!! $frontData['pandscontent'] !!}</p>

					</div>

					@if(!empty($ourproducts))
					<div class="col-md-12" data-aos="fade-up">



						<div class="product-carousel owl-carousel owl-theme">


                            @foreach($ourproducts as $product)
							<div class="item">

								<div class="main">

									<div class="left"><img src="{{ URL::asset('storage/media/ourproducts/'.$product->home_image)}}"></div>

									<div class="right">

										<h5>{{ $product->title }}</h5>

										<p>{!! $product->home_content !!}</p>

										<a href="{{ url('our-products#'.$product->htagtitle) }}" class="btn_4 learn-more">
											<span class="circle"><span class="icon arrow"></span></span>
											<span class="button-text">Read More</span>
										</a>

									</div>
								</div>
							</div>
                            @endforeach



						</div>



					</div>
					@endif



				</div>



			</section>



			<!------------Product Section End----------------->



			<!------------Timeline Section Start----------------->



			<section class="company-timeline">

    <div class="timeline-container">

        <!-- Left Content -->
        <div class="timeline-content">

            @if($achievement && $achievement->count())

                @foreach($achievement as $key => $adata)

                    <div class="timeline-item {{ $key == 0 ? 'active' : '' }}"
                         data-year="timeline-{{ $key }}">

                        <div class="timeline-img">

                            @if($adata->filename)
                                <img src="{{ asset('storage/media/'.$adata->filename) }}"
                                     alt="{{ $adata->heading }}">
                            @endif

                        </div>

                        <div class="timeline-text">

                            <h2>{{ $adata->heading }}</h2>

                            <div>
                                {!! $adata->content !!}
                            </div>

                        </div>

                    </div>

                @endforeach

            @endif

        </div>


        <!-- Right Navigation -->
        <div class="timeline-nav">

            <div class="timeline-arrow prev">
                <i class="fas fa-chevron-up"></i>
            </div>


            <div class="timeline-years-container">

                <div class="timeline-years-wrapper">

                    @if($achievement && $achievement->count())

                        @foreach($achievement as $key => $adata)

                            @php
                                // Example: 2020 - 2021
                                $years = preg_replace('/\s+/', '', $adata->heading);

                                // Get first and second year
                                $yearArray = preg_split('/[-–]/', $years);

                                if(count($yearArray) >= 2) {
                                    $shortYear = substr($yearArray[0], -2) . '-' . substr($yearArray[1], -2);
                                } else {
                                    $shortYear = $adata->heading;
                                }
                            @endphp

                            <div class="timeline-year {{ $key == 0 ? 'active' : '' }}"
                                 data-target="timeline-{{ $key }}">

                                {{ $shortYear }}

                            </div>

                        @endforeach

                    @endif

                </div>

            </div>


            <div class="timeline-arrow next">
                <i class="fas fa-chevron-down"></i>
            </div>

        </div>

    </div>

</section>



			<!------------Timeline Section End----------------->



			<!------------Research Section Start----------------->



			<section class="reserch" style="background: url('public/storage/media/<?php echo @$frontData['sectionfourImage']; ?>') no-repeat; background-size: cover; padding: 500px 0px 0px 0px;">



				<div class="container">



					<div class="main" data-aos="fade-up">



						<h2>Quality & Product Safety Policy</h2>



						<p>At GLS Aluminium, quality is not a checkpoint in the process — it is the foundation of our manufacturing philosophy. We are committed to producing aluminium foil solutions that consistently meet and exceed customer expectations, statutory regulations, and international standards. </p>



						<a href="#" class="btn_4 learn-more">



							<span class="circle"><span class="icon arrow"></span></span>



							<span class="button-text">Read More</span>



						</a>



					</div>



				</div>



			</section>



			<!------------Research Section End----------------->





    <!--End Banner Area-->

    @if(@$frontData['popup_displayOn']=='1')

    <div class="modal out_team_pop on_load_modal" id="onload_pop">



         <div class="modal-dialog">



            <div class="modal-content">



               <div class="modal-body">



			      <button type="button" class="close" data-dismiss="modal">&times;</button>



                  <div class="auto-container">



                     <a href="{{@$frontData['popup_link']}}" target="_blank"><img src="{{ URL::asset('storage/media/' . @$frontData['home_popup']) }}" class="img-fluid"></a>



                  </div>



               </div>



            </div>



         </div>



      </div>

      @endif



	  <script>

window.addEventListener('load', function () {



    const firstModalEl = document.getElementById('onload_pop');



    const firstModal = firstModalEl

        ? new bootstrap.Modal(firstModalEl, {

            backdrop: 'static',

            keyboard: false

        })

        : null;

    // First -> Second

    if (firstModal) {

        firstModal.show();

        firstModalEl.addEventListener('hidden.bs.modal', function () {

            if (secondModal) {

                secondModal.show();

            } else if (thirdModal) {

                thirdModal.show();

            }

        });

    }



});

</script>

@endsection