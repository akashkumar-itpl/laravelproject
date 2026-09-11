(function ($) {
    'use strict';

    var $window = $(window);


    // :: Search Form Active
    var searchbtnI = $(".searchbtn i");
    var searchbtn = $(".searchbtn");

    searchbtnI.addClass('fa-search');
    searchbtn.on('click', function () {
        $("body").toggleClass('search-close');
        searchbtnI.toggleClass('fa-times');
    });

    // :: More Filter Active Code
    $("#moreFilter").on('click', function () {
        $(".search-form-second-steps").slideToggle('1000');
    });

    // :: Nav Active Code
    if ($.fn.classyNav) {
        $('#ourNav').classyNav({
            theme: 'dark'
        });
    }

    // :: Sticky Active Code
    if ($.fn.sticky) {
        $("#stickyHeader").sticky({
            topSpacing: 0
        });
    }

    // :: Tooltip Active Code
    if ($.fn.tooltip) {
        $('[data-toggle="tooltip"]').tooltip()
    }

    // :: Nice Select Active Code
    if ($.fn.niceSelect) {
        $('select').niceSelect();
    }

    // :: Owl Carousel Active Code
    if ($.fn.owlCarousel) {

        var welcomeSlide = $('.hero-slides');

        welcomeSlide.owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            dots: true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            smartSpeed: 1000
        });

        welcomeSlide.on('translate.owl.carousel', function () {
            var slideLayer = $("[data-animation]");
            slideLayer.each(function () {
                var anim_name = $(this).data('animation');
                $(this).removeClass('animated ' + anim_name).css('opacity', '0');
            });
        });

        welcomeSlide.on('translated.owl.carousel', function () {
            var slideLayer = welcomeSlide.find('.owl-item.active').find("[data-animation]");
            slideLayer.each(function () {
                var anim_name = $(this).data('animation');
                $(this).addClass('animated ' + anim_name).css('opacity', '1');
            });
        });

        $("[data-delay]").each(function () {
            var anim_del = $(this).data('delay');
            $(this).css('animation-delay', anim_del);
        });

        $("[data-duration]").each(function () {
            var anim_dur = $(this).data('duration');
            $(this).css('animation-duration', anim_dur);
        });

        // Dots Showing Number
        var dot = $('.hero-slides .owl-dot');

        dot.each(function () {
            var dotnumber = $(this).index() + 1;
            if (dotnumber <= 9) {
                $(this).html('0').append(dotnumber);
            } else {
                $(this).html(dotnumber);
            }
        });

        $('.testimonials-slides').owlCarousel({
            items: 1,
            margin: 50,
            loop: true,
            center: true,
            nav: true,
            navText: [('<i class="fa fa-angle-left" aria-hidden="true"></i>'), ('<i class="fa fa-angle-right" aria-hidden="true"></i>')],
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                }
            }
        });

        $('.brands-slides').owlCarousel({
            items: 3,
            margin: 50,
            loop: true,
            center: true,
            nav: true,
            navText: [('<i class="fa fa-angle-left" aria-hidden="true"></i>'), ('<i class="fa fa-angle-right" aria-hidden="true"></i>')],
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 3
                }
            }
        });
        
        $('.gallery-slides ').owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000,
        });

        $('.featured-properties-slides, .single-listings-sliders').owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000,
            nav: true,
            navText: [('<i class="fa fa-angle-left" aria-hidden="true"></i>'), ('<i class="fa fa-angle-right" aria-hidden="true"></i>')],
        });
    }


    // :: ScrollUp Active Code
    if ($.fn.scrollUp) {
        $.scrollUp({
            scrollSpeed: 1000,
            easingType: 'easeInOutQuart',
            scrollText: '<i class="fa fa-angle-up" aria-hidden="true"></i>'
        });
    }

    // :: PreventDefault a Click
    $("a[href='#']").on('click', function ($) {
        $.preventDefault();
    });

    // :: wow Active Code
    if ($window.width() > 767) {
        new WOW().init();
    }



    // :: whishlist 

    $(document).ready(function(){
        $("#heart").click(function(){
          if($("#heart").hasClass("liked")){
            $("#heart").html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
            $("#heart").removeClass("liked");
          }else{
            $("#heart").html('<i class="fa fa-heart" aria-hidden="true"></i>');
            $("#heart").addClass("liked");
          }
        });
      });
    

         function toggleIcon(e) {
         $(e.target)
         .prev('.panel-heading')
         .find(".more-less")
         .toggleClass('glyphicon-plus glyphicon-minus');
         }
         $('.panel-group').on('hidden.bs.collapse', toggleIcon);
         $('.panel-group').on('shown.bs.collapse', toggleIcon);
 

})(jQuery);