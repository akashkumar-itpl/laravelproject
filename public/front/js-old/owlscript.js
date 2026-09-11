(function ($) {

   "use strict";


   // banner-carousel
   if ($('.banner-carousel').length) {
      $('.banner-carousel').owlCarousel({
         loop: true,
         margin: 0,
         nav: true,
         animateOut: 'fadeOut',
         animateIn: 'fadeIn',
         active: true,
         smartSpeed: 1000,
         autoplay: 6000,
         navText: ['<span class="icon-2"></span>', '<span class="icon-3"></span>'],
         responsive: {
            0: {
               items: 1
            },
            600: {
               items: 1
            },
            800: {
               items: 1
            },
            1024: {
               items: 1
            }
         }
      });
   }


   // single-item-carousel
   if ($('.single-item-carousel').length) {
      $('.single-item-carousel').owlCarousel({
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
   }


//three-item-carousel
   if ($('.career-business-carousel').length) {
      $('.career-business-carousel').owlCarousel({
         loop: true,
         margin:0,
         nav: false,
         smartSpeed: 300,
         dots:true,
         autoplay: 100,
         autoplayHoverPause:true,
         responsive: {
            0: {
               items: 1
            },
            480: {
               items: 1
            },
            600: {
               items: 1
            },
            800: {
               items: 1
            },
            1024: {
               items: 1
            }
         }
      });
   }

   //two-column-carousel
   if ($('.two-column-carousel').length) {
      $('.two-column-carousel').owlCarousel({
         loop: true,
         margin: 30,
         nav: true,
         smartSpeed: 500,
         autoplay: 1000,
         navText: ['<span class="far fa-long-arrow-left"></span>', '<span class="far fa-long-arrow-right"></span>'],
         responsive: {
            0: {
               items: 1
            },
            480: {
               items: 1
            },
            600: {
               items: 1
            },
            800: {
               items: 2
            },
            1024: {
               items: 2
            }
         }
      });
   }
   
   
   //two-column-carousel
   if ($('.product-carousel').length) {
      $('.product-carousel').owlCarousel({
         loop: true,
         margin: 30,
         nav: true,
		 dots:false,
		 autoplayHoverPause: true,
         smartSpeed: 500,
         autoplay:3000,
         navText: ['<span class="far fa-long-arrow-left"></span>', '<span class="far fa-long-arrow-right"></span>'],
         responsive: {
            0: {
               items: 1
            },
            480: {
               items: 1
            },
            600: {
               items: 1
            },
            800: {
               items: 1
            },
            1024: {
               items: 1
            }
         }
      });
   }
   
   
   
   //two-column-carousel
   if ($('.blur-carousel').length) {
      $('.blur-carousel').owlCarousel({
         loop: true,
         margin: 30,
         nav: false,
		 dots:true,
		 center: true,
         smartSpeed: 500,
         autoplay:2000,
         navText: ['<span class="far fa-long-arrow-left"></span>', '<span class="far fa-long-arrow-right"></span>'],
         responsive: {
            0: {
               items: 1
            },
            480: {
               items: 1
            },
            600: {
               items: 1
            },
            800: {
               items: 3
            },
            1024: {
               items: 3
            }
         }
      });
   }


   //three-item-carousel
   if ($('.three-item-carousel').length) {
      $('.three-item-carousel').owlCarousel({
         loop: true,
         margin: 30,
         nav: false,
         smartSpeed: 300,
         autoplay: 100,
		 autoplayHoverPause:true,
         responsive: {
            0: {
               items: 1
            },
            480: {
               items: 1
            },
            600: {
               items: 2
            },
            800: {
               items: 2
            },
            1024: {
               items: 3
            }
         }
      });
   }
   
   
   
   //three-item-carousel
   if ($('.career-item-carousel').length) {
      $('.career-item-carousel').owlCarousel({
         loop: true,
         margin:20,
         nav: false,
         smartSpeed: 300,
		 dots:true,
         autoplay: 100,
		 autoplayHoverPause:true,
         responsive: {
            0: {
               items: 1
            },
            480: {
               items: 1
            },
            600: {
               items: 1
            },
            800: {
               items: 1
            },
            1024: {
               items: 1
            }
         }
      });
   }
   
   
   
   //three-item-carousel
   if ($('.team-item-carousel').length) {
      $('.team-item-carousel').owlCarousel({
         loop: true,
         margin: 30,
         nav: true,
		 dots:false,
         smartSpeed: 300,
         autoplay: 100,
		 autoplayHoverPause:true,
         responsive: {
            0: {
               items: 1
            },
            480: {
               items: 1
            },
            600: {
               items: 2
            },
            800: {
               items: 2
            },
            1024: {
               items: 3
            }
         }
      });
   }


   //four-item-carousel
   if ($('.four-item-carousel').length) {
      $('.four-item-carousel').owlCarousel({
         loop: true,
         margin:40,
         nav: false,
         smartSpeed: 50,
         autoplay:3000,
         slideBy:4,
         autoplayHoverPause:true,
         responsive: {
            0: {
               items: 2
            },
            480: {
               items: 2
            },
            600: {
               items: 2
            },
            800: {
               items: 3
            },
            1024: {
               items: 4
            }
         }
      });
   }


   //five-item-carousel
   if ($('.five-item-carousel').length) {
      $('.five-item-carousel').owlCarousel({
         loop: true,
         margin: 10,
         nav: true,
         smartSpeed: 500,
         autoplay: 1000,
         navText: ['<span class="fas fa-angle-left"></span>', '<span class="fas fa-angle-right"></span>'],
         responsive: {
            0: {
               items: 1
            },
            480: {
               items: 2
            },
            600: {
               items: 3
            },
            800: {
               items: 4
            },
            1024: {
               items: 5
            }
         }
      });
   }


   if ($('.theme_carousel').length) {
      $(".theme_carousel").each(function (index) {
         var $owlAttr = {},
            $extraAttr = $(this).data("options");
         $.extend($owlAttr, $extraAttr);
         $(this).owlCarousel($owlAttr);
      });
   }


  
   //Sortable Masonary with Filters
   function enableMasonry() {
      if ($('.sortable-masonry').length) {

         var winDow = $(window);
         // Needed variables
         var $container = $('.sortable-masonry .items-container');
         var $filter = $('.filter-btns');

         $container.isotope({
            filter: '*',
            masonry: {
               columnWidth: '.masonry-item.small-column'
            },
            animationOptions: {
               duration: 500,
               easing: 'linear'
            }
         });


         // Isotope Filter 
         $filter.find('li').on('click', function () {
            var selector = $(this).attr('data-filter');

            try {
               $container.isotope({
                  filter: selector,
                  animationOptions: {
                     duration: 500,
                     easing: 'linear',
                     queue: false
                  }
               });
            } catch (err) {

            }
            return false;
         });


         winDow.on('resize', function () {
            var selector = $filter.find('li.active').attr('data-filter');

            $container.isotope({
               filter: selector,
               animationOptions: {
                  duration: 500,
                  easing: 'linear',
                  queue: false
               }
            });
         });


         var filterItemA = $('.filter-btns li');

         filterItemA.on('click', function () {
            var $this = $(this);
            if (!$this.hasClass('active')) {
               filterItemA.removeClass('active');
               $this.addClass('active');
            }
         });
      }
   }

   enableMasonry();



})(window.jQuery);


/*	=========================================================================
	Our Team Section, do
	========================================================================== */




// Select all »a« elements with a parent class »links« and add a function that is executed on click
$( '.f41-tab a' ).on( 'click', function(e){
	
  // Define variable of the clicked »a« element (»this«) and get its href value.
  var href = $(this).attr( 'href' );
  
  // Run a scroll animation to the position of the element which has the same id like the href value.
  $( 'html, body' ).animate({
		scrollTop: $( href ).offset().top
  }, '' );
	
  // Prevent the browser from showing the attribute name of the clicked link in the address bar
  e.preventDefault();

});


