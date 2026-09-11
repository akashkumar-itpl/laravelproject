 $(window).scroll(function () {
  if ($(this).scrollTop() > 1) {
    $('.stickyHeader').addClass("sticky");
  }
  else {
    $('.stickyHeader').removeClass("sticky");
  }
});

  $(document).ready(function() {

// Swiper: Slider Testimonilas 
    new Swiper('.testi-w-sliderarea', {
        loop: true,
       navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
        paginationClickable: true,
        spaceBetween: 15,
        simulateTouch: true,
        autoplay: {
            delay: 3000,
            stopOnLastSlide: false,
            disableOnInteraction: false
          },
        breakpoints: {
            1028: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            480: {
                autoHeight: true,
                slidesPerView: 1
            }
        }
    });
});

  $(document).ready(function() {
// Swiper: Slider Services 
    new Swiper('.services-sliderarea', {
        loop: true,
       navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
        paginationClickable: true,
        spaceBetween: 15,
        simulateTouch: true,
        autoplay: {
            delay: 3000,
            stopOnLastSlide: false,
            disableOnInteraction: false
          },
        breakpoints: {
            1028: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            480: {
                autoHeight: true,
                slidesPerView: 1
            }
        }
    });
});
  

  $(document).ready(function() {
// Swiper: Slider Logo 
    new Swiper('.clientlogo-sliderarea', {
        loop: true,
       navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
        paginationClickable: true,
        spaceBetween: 15,
        simulateTouch: true,
        autoplay: {
            delay: 3000,
            stopOnLastSlide: false,
            disableOnInteraction: false
          },
        breakpoints: {
            1028: {
                slidesPerView: 4
            },
            768: {
                slidesPerView: 2
            },
            480: {
                autoHeight: true,
                slidesPerView: 1
            }
        }
    });
});


window.onload = function () {
  document.getElementById("button").onclick = function () {
    document.getElementById("modalOverlay").style.display = "none";
  };
};


// Counter Section

const counters = document.querySelectorAll('.counter');
        const speed = 50; // The higher the slower

        const startCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            let count = 0;
            const increment = Math.ceil(target / speed);

            const updateCounter = () => {
                count += increment;
                if (count < target) {
                    counter.textContent = count;
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            updateCounter();
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCounter(entry.target);
                    entry.target.classList.remove('hidden');
                    observer.unobserve(entry.target);
                }
            });
        });

        counters.forEach(counter => {
            observer.observe(counter);
        });



window.addEventListener("load", function () {
  // store tabs variable
  var myTabs = document.querySelectorAll("ul.nav-tabs > li");
  function myTabClicks(tabClickEvent) {
    for (var i = 0; i < myTabs.length; i++) {
      myTabs[i].classList.remove("active");
    }
    var clickedTab = tabClickEvent.currentTarget;
    clickedTab.classList.add("active");
    tabClickEvent.preventDefault();
    var myContentPanes = document.querySelectorAll(".tab-pane");
    for (i = 0; i < myContentPanes.length; i++) {
      myContentPanes[i].classList.remove("active");
    }
    var anchorReference = tabClickEvent.target;
    var activePaneId = anchorReference.getAttribute("href");
    var activePane = document.querySelector(activePaneId);
    activePane.classList.add("active");
  }
  for (i = 0; i < myTabs.length; i++) {
    myTabs[i].addEventListener("click", myTabClicks);
  }
});


// Banner Slider
    $(document).ready(function () {
    const progressFill = document.querySelector(".progress-fill");
    var swiper = new Swiper(".parallax-slider", {
    speed: 1000,
    parallax: true,
    loop: true,
    autoplay: {
    delay: 10000, // Adjust autoplay delay as needed
    disableOnInteraction: false
    },
    grabCursor: true,
    effect: "creative",
    creativeEffect: {
    prev: {
    shadow: true,
    translate: [0, 0, -1000]
    },
    next: {
    translate: ["100%", 0, 0]
    }
    },
    pagination: {
    el: ".swiper-pagination",
    clickable: true
    },
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
    },
    on: {
    slideChange: function () {
    // Reset progress bar when slide changes
    progressFill.style.width = "0%";
    },
    autoplayTimeLeft(s, time, progress) {
    // Update progress bar width based on autoplay time left
    progressFill.style.width = (1 - progress) * 100 + "%";
    }
    }
    });
    });