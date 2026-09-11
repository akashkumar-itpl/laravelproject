@extends('layouts.site')
@section('metaTitle', 'Thankyou')
@section('metaKey', 'Thankyou')
@section('metaDescription', 'Thankyou')
@section('canonicalUrl', url('thank-you'))
@section('content')
    

    <style>
      .thankyou {
    padding-top:100px;
}

.thankyou img{ margin-bottom:20px;}
    </style>
    
<section class="thankyou">



	<div class="container">

	    

		  

		  <div class="col-md-12 text-center">



		   <img src="public/front/img/thankmark.png" class="center-block">

          

           <h1 style="font-size:50px;"><strong>Thank You!</strong></h1>

           

           <p>Your request has been received. Our team will get in touch with you shortly.</p>

           

           <a href="{{url('/')}}" target="_blank" class="btn_4 learn-more">

			 <span class="circle"><span class="icon arrow"></span></span>

			 <span class="button-text">Go to home</span>

	       </a>

		  

		  </div>



		 

	</div>

	

	

	

</section>

    <!--<section id="recent-blog-posts" class="recent-blog-posts">-->
    <!--     <div class=content>-->
    <!--        <div class="wrapper-1" id="wrapper-1">-->
    <!--           <div class="wrapper-2">-->
    <!--              <h1 class="h1">Thank you !</h1>-->
    <!--              <p class="text-center text-dark">Your query is received and we will contact you soon.</p>-->
    <!--              <a href="{{url('/')}}">-->
    <!--              <button class="go-home">-->
    <!--              Back to home-->
    <!--              </button>-->
    <!--              </a>-->
    <!--           </div>-->
               
    <!--        </div>-->
    <!--     </div>-->
    <!--     <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">-->
    <!--  </section>-->
      <br>
    
@endsection
