<!DOCTYPE html>

<html lang="en">



<head>

@php

$lastSegment = request()->segment(count(request()->segments()));

$currentUrl = url()->current();

$SEOData = getSEOData($lastSegment);

$siteData = getSiteData();

$gettopbar = gettopbar();

$getQuickLinks = getQuickLinks();

$footerData = getFooterData();
$homedata=gethomedata();

@endphp



    <meta charset="UTF-8">



     @if(!empty($SEOData))

    <title>{{@$SEOData->metaTitle}}</title>

    <meta name="description" content="{{@$SEOData->metaDescription}}" />

    <meta name="keywords" content="{{@$SEOData->metaKeywords}}" />

    <link rel="canonical" href="{{@$currentUrl}}" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('storage/media/' . $siteData['favicon']) }}">

    @else

    <title>{{@$homedata['metaTitle']}}</title>
    <meta name="description" content="{{@$homedata['metaKeywords']}}" />
    <meta name="keywords" content="{{@$homedata['metaDescription']}}" />
    <link rel="canonical" href="{{@$homedata['canonicalUrl']}}" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('storage/media/' . $siteData['favicon']) }}">

    <!-- Open Graph / Facebook -->

    <meta property="og:locale" content="en_US" />

    <meta property="og:type" content="website" />

    <meta property="og:title" content="GLS Group" />

    <meta property="og:description" content="GLS Group offers high quality, innovative, and sustainable solutions in Packaging, Chemicals, Aluminium, Industrial Films, and Infrastructure." />

    <meta property="og:url" content="https://www.glsind.com" />

    <meta property="og:site_name" content="GLS Group" />

    <meta property="og:image" content="https://www.glsind.com/public/storage/media/176286039873.png" />

    <meta property="og:image:secure_url" content="https://www.glsind.com/public/storage/media/176286039873.png" />

    

    <!-- Twitter Meta Tags -->

    <meta name="twitter:card" content="summary_large_image">

    <meta property="twitter:domain" content="glsind.com">

    <meta property="twitter:url" content="https://www.glsind.com">

    <meta name="twitter:title" content="GLS Group">

    <meta name="twitter:description" content="GLS Group offers high quality, innovative, and sustainable solutions in Packaging, Chemicals, Aluminium, Industrial Films, and Infrastructure.">

    <meta name="twitter:image" content="https://www.glsind.com/public/storage/media/176286039873.png">

    @endif



    <meta charset="utf-8">

    <!--<script src="{{ URL::asset('front/js/customone.js') }}"></script>-->

    <link href="{{ URL::asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href="{{ URL::asset('front/css/aos.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('front/css/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('front/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('front/css/slick.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('front/css/classy-nav.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('front/css/style.css') }}" />





<!-- Google tag (gtag.js) lodu lalit -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-EDVKCF7JLM"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'G-EDVKCF7JLM');

</script>

  

</head>



<body>

    <!-- Start header area -->

    <!-- header -->

    <a id="bottom_top"></a>

   

<header class="header-area stickyHeader">



    <!-- Main Header Area -->



    <div class="container">



        <div class="main-header-area ">



            <!-- Top Header Area -->



            <div class="classy-nav-container breakpoint-off">



                <!-- Classy Menu -->



                <!---tagline-->



                <nav class="classy-navbar justify-content-between" id="ourNav">



                    <!-- Logo -->



                    <div class="logo-se">



                    <a class="nav-brand" href="{{ url('/') }}"><img

                    src="{{ URL::asset('storage/media/' . @$siteData['logo']) }}" alt="GLS Group"></a>



                    </div>



                    <!-- Navbar Toggler -->



                    <div class="classy-navbar-toggler">



                        <span class="navbarToggler"><span></span><span></span><span></span></span>



                    </div>



                    



                    <!-- Menu -->



                    <div class="classy-menu">



                        <!-- close btn -->



                        <!-- Nav Start -->



                        <div class="classynav">



                            <ul>



                            {!! getFrontMenu() !!}



                            </ul>



                        </div>



                        <!-- Nav End -->



                    </div>



                </nav>



            </div>



        </div>



    </div>



</header>

    @yield('content')

    <section class="footer_section">

<div class="container">

    <div class="row">

        <div class="col-md-3">

            <h5>Quick Links</h5>

            <ul class="quick_links">

              
            @foreach ($getQuickLinks as $item)

            <li><a href="{{ $item->content }}">{{ $item->heading }}</a></li>

            @endforeach

            </ul>

        </div>

        <div class="col-md-4 offset-md-1">

            <h5>Contact Us</h5>

            <ul class="contact">


                <li><i class="fa fa-home"></i> {{ $footerData['address'] }} </li>

                <li><i class="fa fa-phone"></i> {{ $footerData['contact'] }} </li>

                <li><i class="fa fa-envelope"></i> {{ $footerData['email'] }}</li>

            </ul>

        </div>

  <div class="col-md-3  offset-md-1">

         {!! $footerData['map'] !!}
  </div>

</div>

<div class="row text-center">

  <div class="social-media">

  @if($footerData['facebookurl']=="#")

@else

<a href="{{ $footerData['facebookurl'] }}" target="_blank"><i class="fab fa-facebook"></i></a>

@endif

@if($footerData['instaurl']=="#")

@else

<a href="{{ $footerData['instaurl'] }}" target="_blank"><i class="fab fa-instagram"></i></a>

@endif

@if($footerData['twiterurl']=="#")

@else

<a href="{{ $footerData['twiterurl'] }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>

@endif

@if($footerData['linkedinurl']=="#")



@else

<a href="{{ $footerData['linkedinurl'] }}" target="_blank"><i class="fab fa-linkedin"></i></a>

@endif

@if($footerData['whatsappurl']=="#")



@else

<a href="{{ $footerData['whatsappurl'] }}" target="_blank"><i class="fab fa-whatsapp"></i></a>

@endif

</div>

</div>

<div class="container">

<hr />

</div>

<div class="container text-center">

<p>&#169; GLS Speciality Chemicals. All Right Reserved. <br>

  Powered by <a href="https://www.iknoortech.com" target="_blank" style="color:#fff;">ITPL</a></p>

</div>

</section>

<script src="{{ URL::asset('front/js/jquery-owl.js') }}"></script>

<script src="{{ URL::asset('front/js/jquery.min.js') }}"></script>

<script src="{{ URL::asset('front/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ URL::asset('front/js/bootstrap.min.js') }}"></script>

<script src="{{ URL::asset('front/js/aos.js') }}"></script>

<script src="{{ URL::asset('front/js/classy-nav.min.js') }}"></script>

<script src="{{ URL::asset('front/js/active.js') }}"></script>

<script>

 AOS.init();

</script>

<script src="{{ URL::asset('front/js/custom.js') }}"></script>

<script src="{{ URL::asset('front/js/owl.js') }}"></script>

<script src="{{ URL::asset('front/js/owlscript.js') }}"></script>





<script>



var owl = $('.owl-carousel');



owl.owlCarousel({



   items:1, 



 // items change number for slider display on desktop



   nav:true,



   loop:true,



   center: true,



   margin:10,



   dots:false,



   autoplay:false,



   autoplayTimeout:3000,



   autoplayHoverPause:true,



});







</script>











<script>



$('.moreless-button .button-text').click(function() {



 $('.moretext').slideToggle();



 if ($('.moreless-button .button-text').text() == "Read more") {



   $(this).text("Read less")



 } else {



   $(this).text("Read more")



 }



});



</script>











<script src="js/slick.min.js"></script>











<script>



var btn = $('#bottom_top');







$(window).scroll(function() {



 if ($(window).scrollTop() > 300) {



   btn.addClass('show');



 } else {



   btn.removeClass('show');



 }



});







btn.on('click', function(e) {



 e.preventDefault();



 $('html, body').animate({scrollTop:0}, '300');



});











</script>











<script>



$(document).ready(function(){







   $('.timeline-year').click(function(){







       let year = $(this).data('target');







       $('.timeline-year').removeClass('active');



       $(this).addClass('active');







       $('.timeline-item').removeClass('active');







       $('.timeline-item[data-year="'+year+'"]')



       .addClass('active');







   });







});



</script>







<script>



$(document).ready(function(){







   const itemHeight = 58;



   const visibleItems = 5;







   let startIndex = 0;



   let currentIndex = 0;







   const years = $('.timeline-year');



   const totalItems = years.length;







   function showTimeline(index){







       years.removeClass('active');



       $(years[index]).addClass('active');







       let year = $(years[index]).data('target');







       $('.timeline-item').removeClass('active');



       $('.timeline-item[data-year="'+year+'"]').addClass('active');







       currentIndex = index;







       // Auto scroll nav when active item goes out of visible area



       if(currentIndex >= startIndex + visibleItems){



           startIndex = currentIndex - visibleItems + 1;



           updateNav();



       }







       if(currentIndex < startIndex){



           startIndex = currentIndex;



           updateNav();



       }



   }







   function updateNav(){



       if($(window).width() > 991){



           $('.timeline-years-wrapper').css(



               'transform',



               'translateY(-'+ (startIndex * itemHeight) +'px)'



           );



       }



   }







   years.click(function(){



       showTimeline(years.index(this));



   });







   $('.next').click(function(){



       if(currentIndex < totalItems - 1){



           showTimeline(currentIndex + 1);



       }



   });







   $('.prev').click(function(){



       if(currentIndex > 0){



           showTimeline(currentIndex - 1);



       }



   });







   // ===== AUTOPLAY =====







   let autoplay = setInterval(function(){







       let nextIndex = currentIndex + 1;







       if(nextIndex >= totalItems){



           nextIndex = 0; // restart from first



           startIndex = 0;



           updateNav();



       }







       showTimeline(nextIndex);







   }, 4000); // 4 sec







   // Pause autoplay on hover



   $('.company-timeline').hover(



       function(){



           clearInterval(autoplay);



       },



       function(){







           autoplay = setInterval(function(){







               let nextIndex = currentIndex + 1;







               if(nextIndex >= totalItems){



                   nextIndex = 0;



                   startIndex = 0;



                   updateNav();



               }







               showTimeline(nextIndex);







           }, 4000);







       }



   );







});



</script>









</div>



</body>



</html>