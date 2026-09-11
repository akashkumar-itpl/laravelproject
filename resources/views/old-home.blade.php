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

    <!--Start Banner Area-->
    @if ($extension == 'mp4')
        <section>
            <video muted="muted" loop="" playsinline="" preload="metadata" poster="img/intro.jpg" width="100%"
                class="home_video_banner" autoplay="">
                <source type="video/mp4" src="{{ URL::asset('storage/media/' . $frontData['bannerFile']) }}">
            </video>
        </section>
    @else
        <section class="inner_banner">
            <img src="{{ URL::asset('storage/media/' . $frontData['bannerFile']) }}" class="w-100 desk">
            <img src="{{ URL::asset('storage/media/' . $frontData['bannerMobile']) }}" class="w-100 mob">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6" data-aos="fade-up">

                            <h1>Packaging the Future, Powering Industries</h1>

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
    <!--End Banner Area-->

    <section class="countersection" data-aos="fade-up">
        <div class="container text-center">
            <ul>
                @foreach ($Approaches as $item)
                    <li>
                        <div class="titleboxcount">
                            <h6>{!! $item->heading !!}</h6>
                            <div class="boxnoicon">
                                <div class="counter hidden" data-target="{{ $item->count }}">{{ $item->count }}</div>
                                <span>{!! $item->plus !!}</span>
                            </div>
                            <p>{!! $item->content !!}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

<!-- ================= BUSINESS AREAS SECTION ================= -->
<section class="business_areas" id="businessSection">
    <div class="container" data-aos="fade-up">
        <h2>{{ $frontData['sectiononeHeading'] }}</h2>
        <p class="text-center">{{ $frontData['sectiononeContent'] }}</p>
    </div>

    <div class="container text-center" data-aos="fade-up">

        <!-- ===== Tabs ===== -->
        <ul class="nav nav-tabs" role="tablist" id="v-pills-tab">
            @foreach ($FacultyCategory as $facultyItem)
                @if (!empty($facultyItem->getMembers))
                    <li class="nav-item">
                        <a class="nav-link @if ($loop->first) active @endif"
                           data-toggle="tab"
                           href="#tabs-{{ $loop->index }}"
                           role="tab">
                            {{ $facultyItem->title }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul> 

        <!-- ===== Tabs Content ===== -->
        <div class="tab-content mt-4">
            @foreach ($FacultyCategory as $item)
                @if (!empty($item->getMembers))
                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                         id="tabs-{{ $loop->index }}"
                         role="tabpanel">
                        <div class="col-md-12">
                            <div class="single-item-carousel owl-carousel owl-theme">
                                @foreach ($item->getMembers as $member)
                                    <div class="item">
                                        <div class="slide_box">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="content text-left">
                                                        <p>{!! $member->company !!}</p>
                                                        <div class="bxsh">
                                                        <h4>{!! $member->home_page_title !!}</h4>
                                                        <a href="{{ url('solutions/' . strtolower($item->title) . '/' . $member->slug) }}"
                                                           class="btn_4 learn-more">
                                                            <span class="circle">
                                                                <span class="icon arrow"></span>
                                                            </span>
                                                            <span class="button-text">View Details</span>
                                                        </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="imgbox">
                                                        <img src="{{ URL::asset('storage/media/' . $member->memberImage) }}"
                                                             alt="{{ $member->title }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- ================= CSS ================= -->

<!-- ================= JS ================= -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
  let activeTabIndex = 1;
  let tabChangeTimeout = 6000;
  let AUTO_CHANGE_TIMER = null;


  const $tabs = $("#v-pills-tab .nav-link");
  let totalTabsCount = $tabs.length;


  function tabChangeHandler() {
    activeTabIndex = activeTabIndex >= totalTabsCount ? 1 : activeTabIndex + 1;
    $tabs.eq(activeTabIndex - 1).tab("show"); // use Bootstrap tab API
  }


  function startAuto() {
    if (AUTO_CHANGE_TIMER === null) {
      AUTO_CHANGE_TIMER = setInterval(tabChangeHandler, tabChangeTimeout);
    }
  }


  function stopAuto() {
    if (AUTO_CHANGE_TIMER !== null) {
      clearInterval(AUTO_CHANGE_TIMER);
      AUTO_CHANGE_TIMER = null;
    }
  }


  // Keep index in sync if user clicks manually
  $(document).on("shown.bs.tab", "#v-pills-tab .nav-link", function () {
    activeTabIndex = $tabs.index(this) + 1;
  });


  // Pause/resume on hover
  const hoverTargets = "#v-pills-tab, #v-pills-tabContent, .tab-content";
  $(document).on("mouseenter", hoverTargets, stopAuto);
  $(document).on("mouseleave", hoverTargets, startAuto);


  // Start auto only when section is visible
  let tabSection = document.querySelector("#v-pills-tab");
  if ("IntersectionObserver" in window && tabSection) {
    let observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          startAuto();
        } else {
          stopAuto();
        }
      });
    }, { threshold: 0.3 });
    observer.observe(tabSection);
  } else {
    // Fallback for old browsers
    function inViewport(el) {
      let rect = el.getBoundingClientRect();
      return rect.top < window.innerHeight && rect.bottom > 0;
    }
    function check() {
      if (inViewport(tabSection)) startAuto(); else stopAuto();
    }
    $(window).on("scroll resize load", check);
    check();
  }
});
</script>
<script>
// $(document).ready(function() {

//     let carouselStarted = false; // flag to prevent re-initialization

//     // Function to start carousel + tab auto-switch
//     function startBusinessCarousel() {
//         if (carouselStarted) return; // run only once
//         carouselStarted = true;

//         // Initialize Owl Carousels
//         $('.single-item-carousel').owlCarousel({
//             items: 1,
//             loop: true,
//             margin: 30,
//             autoplay: true,
//             autoplayTimeout: 2000, // each slide 4 sec
//             autoplayHoverPause: true,
//             smartSpeed: 600,
//             nav: true,
//             dots: false
//         });

//         // Auto Tab Switch
//         let tabInterval = 4000; // each tab 8 sec
//         let $tabs = $('.nav-tabs .nav-link');
//         let currentIndex = 0;

//         setInterval(function() {
//             currentIndex = (currentIndex + 1) % $tabs.length;
//             $tabs.eq(currentIndex).tab('show');
//         }, tabInterval);
//     }

//     // Detect when section comes into view
//     let observer = new IntersectionObserver(function(entries) {
//         entries.forEach(entry => {
//             if (entry.isIntersecting) {
//                 startBusinessCarousel();
//             }
//         });
//     }, { threshold: 0.3 }); // trigger when 30% visible

//     observer.observe(document.querySelector('#businessSection'));

// });
</script>



    <section class="clients_section">
    <div class="container text-center" data-aos="fade-up">
        <h2>{{ $frontData['sectiontwoHeading'] }}</h2>
        <p>{{ $frontData['sectiontwoContent'] }}</p>
    </div>

    <div class="container" data-aos="fade-up">
        <div class="four-item-carousel owl-carousel owl-theme">
            @foreach ($Clients as $key => $itemClient)
                @if ($loop->index % 2 == 0)
                    <div class="item">
                @endif

                <div class="logo_box @if($loop->index % 2 == 1) mt30 @endif">
                    <img src="{{ URL::asset('storage/media/' . $itemClient->filename) }}" alt="Client Logo">
                </div>

                @if ($loop->index % 2 == 1 || $loop->last)
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>



    <section class="csr_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="position:relative" data-aos="zoom-in">
                    <img src="{{ URL::asset('front/img/csr.png') }}">
                    <div class="bird"><img src="{{ URL::asset('front/img/bird.png') }}" class="vert-move"></div>
                </div>
                <div class="col-md-6" data-aos="fade-up">
                    <div class="content">
                        <h3>{{ $frontData['sectionthreeHeading'] }}</h3>
                        <p>{{ $frontData['sectionthreeContent'] }}</p>

                        <a href="{{ url('whatmatters') }}#csr" class="btn_4 learn-more">
                            <span class="circle"><span class="icon arrow"></span></span>
                            <span class="button-text">Read More</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="sustainability_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-2" style="position:relative" data-aos="zoom-in">
                    <img src="{{ URL::asset('front/img/sustainability.png') }}">
                    <div class="cloud"><img src="{{ URL::asset('front/img/cloud.png') }}" class="vert-move1"></div>
                </div>
                <div class="col-md-6" data-aos="fade-up">
                    <div class="content">
                        <h3>{{ $frontData['sectionfourHeading'] }}</h3>
                        <p>{{ $frontData['sectionfourContent'] }}</p>

                        <a href="{{ url('whatmatters') }}#sustainability" class="btn_4 learn-more">
                            <span class="circle"><span class="icon arrow"></span></span>
                            <span class="button-text">Read More</span>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="media_section">

        <div class="container text-center" data-aos="fade-up">
            <h2>Media Updates</h2>
        </div>

        <div class="container" data-aos="fade-up">
            <div class="three-item-carousel owl-carousel owl-theme">
                @foreach ($blogsRecent as $item)
                    <div class="item">
                        <div class="news">
                            <div class="mg"><img src="{{ URL::asset('storage/media/' . $item->memberImage) }}"></div>
                            <div class="content">
                                <p>{{ Carbon::parse($item->created_at)->format('F j, Y') }}</p>
                                <h5>{{ $item->title }}</h5>
                                <a href="{{ url('news/' . $item->slug) }}" class="btn_4 learn-more">
                                    <span class="circle"><span class="icon arrow"></span></span>
                                    <span class="button-text">Read more</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
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
@endsection
