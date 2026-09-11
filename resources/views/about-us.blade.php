@extends('layouts.site')

@section('content')


		<style>



			.h_usp .leadership-ul{



                text-align: left;



                box-shadow: 0 12px 35px rgba(0,0,0,.08);



            }



            .leadership-ul h5{



                color: #000;



                font-size: 20px;



            }



            .leadership-ul ul{



                padding-left: 20px;



                /*padding: 0px;*/



            }



            .leadership-ul ul li{



                list-style: disc;



            }



            .certificate-image img{



                height: auto !important;



            }



		</style>



		<section class="inner-page-banner">



			<div class="container-fluid">



				<img src="{{ URL::asset('storage/media/'.$pageData->banner)}}">



			</div>



			<div class="container">



				<div class="col-md-12">



					<nav aria-label="breadcrumb">



						<ol class="breadcrumb">



							<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>



							<li class="breadcrumb-item active" aria-current="page">About Us</li>



						</ol>



					</nav>



				</div>



			</div>



		</section>



		<!------------About Us Section Start----------------->



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



		<!------------About Us Section End----------------->



		<!------------Capability Section Start----------------->



		<section class="h_usp">



			<div class="container">



				<div class="row">



					<div class="col-md-12 text-center mb50">



						<h3>Capability</h3>



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



		<!------------Capability Section End----------------->



		<!------------Vision Section Start----------------->



		<section class="vision-mission">



			<div class="container">



				<div class="row">



					<div class="col-md-6" data-aos="fade-up">



						<img src="{{ URL::asset('storage/media/'.$frontData['vissionImage'])}}">



					</div>



					<div class="col-md-6" data-aos="fade-up">



						<h3>{{$frontData['visionHeading']}}</h3>



						<p>{!! $frontData['visionContent'] !!}</p>



					</div>



				</div>



			</div>



		</section>



		<!------------Vision Section End----------------->



		<!------------Mission Section Start----------------->



		<section class="vision-mission">



			<div class="container">



				<div class="row">



					<div class="col-md-6 order-2" data-aos="fade-up">



						<img src="{{ URL::asset('storage/media/'.$frontData['missionImage'])}}">



					</div>



					<div class="col-md-6" data-aos="fade-up">



					
					<h3>{{$frontData['missionHeading']}}</h3>



					<p>{!! $frontData['missionContent'] !!}</p>



					</div>



				</div>



			</div>



		</section>



		<!------------Mission Section End----------------->



		<!------------Values Section Start----------------->



		<section class="vision-mission">



			<div class="container">



				<div class="row">



					<div class="col-md-6" data-aos="fade-up">



						<img src="{{ URL::asset('storage/media/'.$frontData['ourvaluesImage'])}}">



					</div>



					<div class="col-md-6" data-aos="fade-up">



						
					<h3>{{$frontData['ourvalues']}}</h3>



					<p>{!! $frontData['ourvaluescontent'] !!}</p>


					</div>



				</div>



			</div>



		</section>



		<!------------Values Section End----------------->







		<!------------Business Model Section Start----------------->



		<section class="leadership h_usp">



			<div class="container top" data-aos="fade-up">



			<h3>{{$frontData['sectionthreeHeading']}}</h3>



			<p>{!! $frontData['sectionthreeContent'] !!}</p>



			</div>



			@if(!empty($businessmodels))
			<div class="container mt-5">



				<div class="row">



				   @foreach($businessmodels as $bdata)


					<div class="col-md-3" data-aos="fade-up">



						<div class="main leadership-ul">



							<h5>{{$bdata->business_heading}}</h5>



							{!! $bdata->business_content !!}



						</div>



					</div>
					@endforeach
					








				</div>



			</div>
			@endif


		</section>



		<!------------Business Model Section End----------------->







		<!------------Certificate Section Start----------------->



		<section class="compliance d-none">



			<div class="container top" data-aos="fade-up">



				<h3>Our Certifications</h3>



			</div>



			<div class="container">



				<div class="row">



					<div class="col-md-2 col-6" data-aos="fade-up">



						<a href="#">



							<div class="certificate-card">



								<div class="certificate-image">



									<img src="{{ URL::asset('front/img/certifications/1.png')}}" alt="Certificate">



								</div>



								<div class="certificate-footer">



									<p class="certificate-btn">



										View PDF<i class="fas fa-arrow-right"></i>



									</p>



								</div>



							</div>



						</a>



					</div>



					<div class="col-md-2 col-6" data-aos="fade-up">



						<a href="#">



							<div class="certificate-card">



								<div class="certificate-image">



									<img src="{{ URL::asset('front/img/certifications/2.png')}}" alt="Certificate">



								</div>



								<div class="certificate-footer">



									<p class="certificate-btn">



										View PDF<i class="fas fa-arrow-right"></i>



									</p>



								</div>



							</div>



						</a>



					</div>



					<div class="col-md-2 col-6" data-aos="fade-up">



						<a href="#">



							<div class="certificate-card">



								<div class="certificate-image">



									<img src="{{ URL::asset('front/img/certifications/3.png')}}" alt="Certificate">



								</div>



								<div class="certificate-footer">



									<p class="certificate-btn">



										View PDF<i class="fas fa-arrow-right"></i>



									</p>



								</div>



							</div>



						</a>



					</div>



					<div class="col-md-2 col-6" data-aos="fade-up">



						<a href="#">



							<div class="certificate-card">



								<div class="certificate-image">



									<img src="{{ URL::asset('front/img/certifications/4.png')}}" alt="Certificate">



								</div>



								<div class="certificate-footer">



									<p class="certificate-btn">



										View PDF<i class="fas fa-arrow-right"></i>



									</p>



								</div>



							</div>



						</a>



					</div>



					<div class="col-md-2 col-6" data-aos="fade-up">



						<a href="#">



							<div class="certificate-card">



								<div class="certificate-image">



									<img src="{{ URL::asset('front/img/certifications/5.png')}}" alt="Certificate">



								</div>



								<div class="certificate-footer">



									<p class="certificate-btn">



										View PDF<i class="fas fa-arrow-right"></i>



									</p>



								</div>



							</div>



						</a>



					</div>



					<div class="col-md-2 col-6" data-aos="fade-up">



						<a href="#">



							<div class="certificate-card">



								<div class="certificate-image">



									<img src="{{ URL::asset('front/img/certifications/6.png')}}" alt="Certificate">



								</div>



								<div class="certificate-footer">



									<p class="certificate-btn">



										View PDF<i class="fas fa-arrow-right"></i>



									</p>



								</div>



							</div>



						</a>



					</div>



				</div>



			</div>



		</section>



		<!------------Certificate Section End----------------->



		<!------------Country Served Section Start----------------->



		<section class=" ">



			<div class="container top" data-aos="fade-up">


			<h3>{{$frontData['sectionfourHeading']}}</h3>



            <p>{!! $frontData['sectionfourContent'] !!}</p>



			</div>



			<div class="container">



    <div class="row">



      <div class="col-md-10 offset-md-1"> <img src="{{ URL::asset('storage/media/'.$frontData['sectionfourImage'])}}"> </div>



      <div class="col-md-12">



        <section class="export-usp">



          <div class="row">





		    @if(!empty($ourcorestrengths))
			@foreach($ourcorestrengths as $odata)
            <div class="col-lg-3 mb-4">



              <div class="usp-box">



                <div class="usp-icon"> {{$odata->image}} </div>



                <div class="usp-content">



                  <p>{{$odata->title}}</p>



                </div>



              </div>



            </div>
			@endforeach
            @endif








          </div>



          <div class="usp-footer">



            <p> {!! $frontData['sectionthreeContentLast'] !!}</p>



          </div>



        </section>



      </div>



    </div>



  </div>



		</section>



		<!------------Country Served Section End----------------->



	@endsection