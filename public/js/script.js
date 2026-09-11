/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./public/front/js/script.js ***!
  \***********************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function initSLiderProduct() {
  "use strict";

  var preLoader = function preLoader() {
    var preloaderWrapper = document.getElementById("preloader");

    window.onload = function () {
      preloaderWrapper.classList.add("loaded");
    };
  };

  preLoader();

  var getSiblings = function getSiblings(elem) {
    var siblings = [];
    var sibling = elem.parentNode.firstChild;

    for (; sibling;) {
      1 === sibling.nodeType && sibling !== elem && siblings.push(sibling), sibling = sibling.nextSibling;
    }

    return siblings;
  },
      slideUp = function slideUp(target, time) {
    var duration = time || 500;
    target.style.transitionProperty = "height, margin, padding", target.style.transitionDuration = duration + "ms", target.style.boxSizing = "border-box", target.style.height = target.offsetHeight + "px", target.offsetHeight, target.style.overflow = "hidden", target.style.height = 0, window.setTimeout(function () {
      target.style.display = "none", target.style.removeProperty("height"), target.style.removeProperty("overflow"), target.style.removeProperty("transition-duration"), target.style.removeProperty("transition-property");
    }, duration);
  },
      slideDown = function slideDown(target, time) {
    var duration = time || 500;
    target.style.removeProperty("display");
    var display = window.getComputedStyle(target).display;
    "none" === display && (display = "block"), target.style.display = display;
    var height = target.offsetHeight;
    target.style.overflow = "hidden", target.style.height = 0, target.offsetHeight, target.style.boxSizing = "border-box", target.style.transitionProperty = "height, margin, padding", target.style.transitionDuration = duration + "ms", target.style.height = height + "px", window.setTimeout(function () {
      target.style.removeProperty("height"), target.style.removeProperty("overflow"), target.style.removeProperty("transition-duration"), target.style.removeProperty("transition-property");
    }, duration);
  };

  function TopOffset(el) {
    var rect = el.getBoundingClientRect(),
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return {
      top: rect.top + scrollTop
    };
  }

  var headerStickyWrapper = document.querySelector("header"),
      headerStickyTarget = document.querySelector(".header__sticky");

  if (headerStickyTarget) {
    var headerHeight = headerStickyWrapper.clientHeight;
    window.addEventListener("scroll", function () {
      var StickyTargetElement,
          TargetElementTopOffset = TopOffset(headerStickyWrapper).top;
      window.scrollY > TargetElementTopOffset ? headerStickyTarget.classList.add("sticky") : headerStickyTarget.classList.remove("sticky");
    });
  }

  var scrollTop = document.getElementById("scroll__top");
  scrollTop && (scrollTop.addEventListener("click", function () {
    window.scroll({
      top: 0,
      left: 0,
      behavior: "smooth"
    });
  }), window.addEventListener("scroll", function () {
    window.scrollY > 300 ? scrollTop.classList.add("active") : scrollTop.classList.remove("active");
  }));
  var swiper = new Swiper(".hero__slider--activation", {
    slidesPerView: 1,
    loop: !0,
    clickable: !0,
    speed: 800,
    spaceBetween: 30,
    autoplay: {
      delay: 3e3,
      disableOnInteraction: !1
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  }),
      swiper = new Swiper(".product__swiper--activation", {
    slidesPerView: 8,
    loop: !0,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false
    },
    clickable: !0,
    spaceBetween: 10,
    breakpoints: {
      1200: {
        slidesPerView: 8
      },
      992: {
        slidesPerView: 6
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      280: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      0: {
        slidesPerView: 1
      }
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  }),
      swiper = new Swiper(".product__swiper--column4__activation", {
    slidesPerView: 4,
    loop: !0,
    clickable: !0,
    spaceBetween: 30,
    breakpoints: {
      1200: {
        slidesPerView: 4
      },
      992: {
        slidesPerView: 4
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30
      },
      280: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      0: {
        slidesPerView: 1
      }
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  }),
      swiper = new Swiper(".product__sidebar--column4__activation", {
    slidesPerView: 4,
    loop: !0,
    clickable: !0,
    spaceBetween: 30,
    breakpoints: {
      1200: {
        slidesPerView: 4
      },
      992: {
        slidesPerView: 3
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30
      },
      280: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      0: {
        slidesPerView: 1
      }
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  }),
      swiper = new Swiper(".product__swiper--column3", {
    slidesPerView: 3,
    clickable: !0,
    loop: !0,
    spaceBetween: 30,
    breakpoints: {
      1200: {
        slidesPerView: 3
      },
      992: {
        slidesPerView: 2
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30
      },
      280: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      0: {
        slidesPerView: 1
      }
    },
    navigation: {
      nextEl: ".new__product--sidebar .swiper-button-next",
      prevEl: ".new__product--sidebar .swiper-button-prev"
    }
  }),
      swiper = new Swiper(".testimonial__swiper--activation", {
    slidesPerView: 1,
    loop: !0,
    clickable: !0,
    spaceBetween: 30,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false
    },
    breakpoints: {
      1200: {
        slidesPerView: 1
      },
      768: {
        spaceBetween: 30,
        slidesPerView: 1
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      0: {
        slidesPerView: 1
      }
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: !0
    }
  }),
      swiper = new Swiper(".testimonial__activation--column1", {
    slidesPerView: 1,
    loop: !0,
    clickable: !0,
    pagination: {
      el: ".swiper-pagination",
      clickable: !0
    }
  }),
      swiper = new Swiper(".blog__swiper--activation", {
    slidesPerView: 3,
    loop: !0,
    clickable: !0,
    spaceBetween: 10,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false
    },
    breakpoints: {
      1200: {
        slidesPerView: 3
      },
      992: {
        slidesPerView: 3
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      480: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      0: {
        slidesPerView: 1
      }
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  }),
      swiper = new Swiper(".quickview__swiper--activation", {
    slidesPerView: 1,
    loop: !0,
    clickable: !0,
    spaceBetween: 30,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: !0
    }
  }),
      swiper = new Swiper(".product__media--nav", {
    loop: !0,
    spaceBetween: 10,
    slidesPerView: 5,
    freeMode: !0,
    watchSlidesProgress: !0,
    breakpoints: {
      768: {
        slidesPerView: 5
      },
      480: {
        slidesPerView: 4
      },
      320: {
        slidesPerView: 3
      },
      200: {
        slidesPerView: 2
      },
      0: {
        slidesPerView: 1
      }
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  }),
      swiper2 = new Swiper(".product__media--preview", {
    loop: !0,
    spaceBetween: 10,
    thumbs: {
      swiper: swiper
    }
  });

  var tab = function tab(wrapper) {
    var tabContainer = document.querySelector(wrapper);
    tabContainer && tabContainer.addEventListener("click", function (evt) {
      var listItem = evt.target;

      if (listItem.hasAttribute("data-toggle")) {
        var targetId = listItem.dataset.target,
            targetItem = document.querySelector(targetId);
        listItem.parentElement.querySelectorAll('[data-toggle="tab"]').forEach(function (list) {
          list.classList.remove("active");
        }), listItem.classList.add("active"), targetItem.classList.add("active"), setTimeout(function () {
          targetItem.classList.add("show");
        }, 150), getSiblings(targetItem).forEach(function (pane) {
          pane.classList.remove("show"), setTimeout(function () {
            pane.classList.remove("active");
          }, 150);
        });
      }
    });
  };

  tab(".product__tab--one"), tab(".product__tab--two"), tab(".product__details--tab"), tab(".product__grid--column__buttons"), document.querySelectorAll("[data-countdown]").forEach(function (elem) {
    var countDownItem = function countDownItem(value, label) {
      return "<div class=\"countdown__item\" ".concat(label, "\"><span class=\"countdown__number\">").concat(value, "</span><p class=\"countdown__text\">").concat(label, "</p></div>");
    },
        date = new Date(elem.getAttribute("data-countdown")).getTime(),
        second = 1e3,
        minute = 6e4,
        hour = 36e5,
        day = 864e5,
        countDownInterval = setInterval(function () {
      var currentTime = new Date().getTime(),
          timeDistance = date - currentTime,
          daysValue = Math.floor(timeDistance / day),
          hoursValue = Math.floor(timeDistance % day / 36e5),
          minutesValue = Math.floor(timeDistance % 36e5 / 6e4),
          secondsValue = Math.floor(timeDistance % 6e4 / 1e3);
      elem.innerHTML = countDownItem(daysValue, "days") + countDownItem(hoursValue, "hrs") + countDownItem(minutesValue, "mins") + countDownItem(secondsValue, "secs"), timeDistance < 0 && clearInterval(countDownInterval);
    }, 1e3);
  });

  var activeClassAction = function activeClassAction(toggle, target) {
    var to = document.querySelector(toggle),
        ta = document.querySelector(target);
    to && ta && (to.addEventListener("click", function (e) {
      e.preventDefault();
      var triggerItem = e.target;
      triggerItem.classList.contains("active") ? (triggerItem.classList.remove("active"), ta.classList.remove("active")) : (triggerItem.classList.add("active"), ta.classList.add("active"));
    }), document.addEventListener("click", function (event) {
      event.target.closest(toggle) || event.target.classList.contains(toggle.replace(/\./, "")) || event.target.closest(target) || event.target.classList.contains(target.replace(/\./, "")) || (to.classList.remove("active"), ta.classList.remove("active"));
    }));
  };

  function offcanvsSidebar(openTrigger, closeTrigger, wrapper) {
    var OpenTriggerprimary__btn = document.querySelectorAll(openTrigger),
        closeTriggerprimary__btn = document.querySelector(closeTrigger),
        WrapperSidebar = document.querySelector(wrapper),
        wrapperOverlay = wrapper.replace(".", "");

    function handleBodyClass(evt) {
      var eventTarget = evt.target;
      eventTarget.closest(wrapper) || eventTarget.closest(openTrigger) || (WrapperSidebar.classList.remove("active"), document.querySelector("body").classList.remove("".concat(wrapperOverlay, "_active")));
    }

    OpenTriggerprimary__btn && WrapperSidebar && OpenTriggerprimary__btn.forEach(function (singleItem) {
      singleItem.addEventListener("click", function (e) {
        null != e.target.dataset.offcanvas && (WrapperSidebar.classList.add("active"), document.querySelector("body").classList.add("".concat(wrapperOverlay, "_active")), document.body.addEventListener("click", handleBodyClass.bind(this)));
      });
    }), closeTriggerprimary__btn && WrapperSidebar && closeTriggerprimary__btn.addEventListener("click", function (e) {
      null != e.target.dataset.offcanvas && (WrapperSidebar.classList.remove("active"), document.querySelector("body").classList.remove("".concat(wrapperOverlay, "_active")), document.body.removeEventListener("click", handleBodyClass.bind(this)));
    });
  }

  activeClassAction(".account__currency--link", ".dropdown__currency"), activeClassAction(".language__switcher", ".dropdown__language"), activeClassAction(".offcanvas__language--switcher", ".offcanvas__dropdown--language"), activeClassAction(".offcanvas__account--currency__menu", ".offcanvas__account--currency__submenu"), activeClassAction(".footer__language--link", ".footer__dropdown--language"), activeClassAction(".footer__currency--link", ".footer__dropdown--currency"), offcanvsSidebar(".minicart__open--btn", ".minicart__close--btn", ".offCanvas__minicart"), offcanvsSidebar(".search__open--btn", ".predictive__search--close__btn", ".predictive__search--box"), offcanvsSidebar(".widget__filter--btn", ".offcanvas__filter--close", ".offcanvas__filter--sidebar");

  var offcanvasHeader = function offcanvasHeader() {
    var offcanvasOpen = document.querySelector(".offcanvas__header--menu__open--btn"),
        offcanvasClose = document.querySelector(".offcanvas__close--btn"),
        offcanvasHeader = document.querySelector(".offcanvas-header"),
        offcanvasMenu = document.querySelector(".offcanvas__menu"),
        body = document.querySelector("body");
    offcanvasMenu && offcanvasMenu.querySelectorAll(".offcanvas__sub_menu").forEach(function (ul) {
      var subMenuToggle = document.createElement("button");
      subMenuToggle.classList.add("offcanvas__sub_menu_toggle"), ul.parentNode.appendChild(subMenuToggle);
    }), offcanvasOpen && offcanvasOpen.addEventListener("click", function (e) {
      e.preventDefault(), null != e.target.dataset.offcanvas && (offcanvasHeader.classList.add("open"), body.classList.add("mobile_menu_open"));
    }), offcanvasClose && offcanvasClose.addEventListener("click", function (e) {
      e.preventDefault(), null != e.target.dataset.offcanvas && (offcanvasHeader.classList.remove("open"), body.classList.remove("mobile_menu_open"));
    });
    var mobileMenuWrapper = document.querySelector(".offcanvas__menu_ul");
    mobileMenuWrapper && mobileMenuWrapper.addEventListener("click", function (e) {
      var targetElement = e.target;

      if (targetElement.classList.contains("offcanvas__sub_menu_toggle")) {
        var parent = targetElement.parentElement;
        parent.classList.contains("active") ? (targetElement.classList.remove("active"), parent.classList.remove("active"), parent.querySelectorAll(".offcanvas__sub_menu").forEach(function (subMenu) {
          subMenu.parentElement.classList.remove("active"), subMenu.nextElementSibling.classList.remove("active"), slideUp(subMenu);
        })) : (targetElement.classList.add("active"), parent.classList.add("active"), slideDown(targetElement.previousElementSibling), getSiblings(parent).forEach(function (item) {
          item.classList.remove("active"), item.querySelectorAll(".offcanvas__sub_menu").forEach(function (subMenu) {
            subMenu.parentElement.classList.remove("active"), subMenu.nextElementSibling.classList.remove("active"), slideUp(subMenu);
          });
        }));
      }
    }), offcanvasHeader && document.addEventListener("click", function (event) {
      event.target.closest(".offcanvas__header--menu__open--btn") || event.target.classList.contains(".offcanvas__header--menu__open--btn".replace(/\./, "")) || event.target.closest(".offcanvas-header") || event.target.classList.contains(".offcanvas-header".replace(/\./, "")) || (offcanvasHeader.classList.remove("open"), body.classList.remove("mobile_menu_open"));
    }), offcanvasHeader && window.addEventListener("resize", function () {
      window.outerWidth >= 992 && (offcanvasHeader.classList.remove("open"), body.classList.remove("mobile_menu_open"));
    });
  };

  offcanvasHeader();
  var quantityWrapper = document.querySelectorAll(".quantity__box");
  quantityWrapper && quantityWrapper.forEach(function (singleItem) {
    var increaseButton = singleItem.querySelector(".increase"),
        decreaseButton = singleItem.querySelector(".decrease");
    increaseButton.addEventListener("click", function (e) {
      var input = e.target.previousElementSibling.children[0];

      if (null != input.dataset.counter) {
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value, value++, input.value = value;
      }
    }), decreaseButton.addEventListener("click", function (e) {
      var input = e.target.nextElementSibling.children[0];

      if (null != input.dataset.counter) {
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value, value < 1 && (value = 1), value--, input.value = value;
      }
    });
  });
  var openEls = document.querySelectorAll("[data-open]"),
      closeEls = document.querySelectorAll("[data-close]"),
      isVisible = "is-visible";

  var _iterator = _createForOfIteratorHelper(openEls),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var el = _step.value;
      el.addEventListener("click", function () {
        var modalId = this.dataset.open;
        document.getElementById(modalId).classList.add(isVisible);
      });
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  var _iterator2 = _createForOfIteratorHelper(closeEls),
      _step2;

  try {
    for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
      var _el = _step2.value;

      _el.addEventListener("click", function () {
        this.parentElement.parentElement.parentElement.classList.remove(isVisible);
      });
    }
  } catch (err) {
    _iterator2.e(err);
  } finally {
    _iterator2.f();
  }

  function customAccordion(accordionWrapper, singleItem, accordionBody) {
    var accoridonButtons;
    document.querySelectorAll(accordionWrapper).forEach(function (item) {
      item.addEventListener("click", function (evt) {
        var itemTarget = evt.target;

        if (itemTarget.classList.contains("accordion__items--button") || itemTarget.classList.contains("widget__categories--menu__label")) {
          var singleAccordionWrapper = itemTarget.closest(singleItem),
              singleAccordionBody = singleAccordionWrapper.querySelector(accordionBody);
          singleAccordionWrapper.classList.contains("active") ? (singleAccordionWrapper.classList.remove("active"), slideUp(singleAccordionBody)) : (singleAccordionWrapper.classList.add("active"), slideDown(singleAccordionBody), getSiblings(singleAccordionWrapper).forEach(function (item) {
            var sibllingSingleAccordionBody = item.querySelector(accordionBody);
            item.classList.remove("active"), slideUp(sibllingSingleAccordionBody);
          }));
        }
      });
    });
  }

  document.addEventListener("click", function (e) {
    e.target == document.querySelector(".modal.is-visible") && document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }), document.addEventListener("keyup", function (e) {
    "Escape" == e.key && document.querySelector(".modal.is-visible") && document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }), customAccordion(".accordion__container", ".accordion__items", ".accordion__items--body"), customAccordion(".widget__categories--menu", ".widget__categories--menu__list", ".widget__categories--sub__menu");
  var accordion = !0;

  var footerWidgetAccordion = function footerWidgetAccordion() {
    var footerWidgetContainer;
    accordion = !1, document.querySelector(".main__footer").addEventListener("click", function (evt) {
      var singleItemTarget = evt.target;

      if (singleItemTarget.classList.contains("footer__widget--button")) {
        var footerWidget = singleItemTarget.closest(".footer__widget"),
            footerWidgetInner = footerWidget.querySelector(".footer__widget--inner");
        footerWidget.classList.contains("active") ? (footerWidget.classList.remove("active"), slideUp(footerWidgetInner)) : (footerWidget.classList.add("active"), slideDown(footerWidgetInner), getSiblings(footerWidget).forEach(function (item) {
          var footerWidgetInner = item.querySelector(".footer__widget--inner");
          item.classList.remove("active"), slideUp(footerWidgetInner);
        }));
      }
    });
  };

  window.addEventListener("load", function () {
    accordion && footerWidgetAccordion();
  }), window.addEventListener("resize", function () {
    document.querySelectorAll(".footer__widget").forEach(function (item) {
      window.outerWidth >= 768 && (item.classList.remove("active"), item.querySelector(".footer__widget--inner").style.display = "");
    }), accordion && footerWidgetAccordion();
  });
  var customLightboxHTML = '<div id="glightbox-body" class="glightbox-container">\n    <div class="gloader visible"></div>\n    <div class="goverlay"></div>\n    <div class="gcontainer">\n    <div id="glightbox-slider" class="gslider"></div>\n    <button class="gnext gbtn" tabindex="0" aria-label="Next" data-customattribute="example">{nextSVG}</button>\n    <button class="gprev gbtn" tabindex="1" aria-label="Previous">{prevSVG}</button>\n    <button class="gclose gbtn" tabindex="2" aria-label="Close">{closeSVG}</button>\n    </div>\n    </div>',
      lightbox = GLightbox({
    touchNavigation: !0,
    lightboxHTML: customLightboxHTML,
    loop: !0
  }),
      wrapper = document.getElementById("funfactId");

  if (wrapper) {
    var counters = wrapper.querySelectorAll(".js-counter"),
        duration = 1e3;
    var isCounted = !1;
    document.addEventListener("scroll", function () {
      var wrapperPos = wrapper.offsetTop - window.innerHeight;
      !isCounted && window.scrollY > wrapperPos && (counters.forEach(function (counter) {
        var countTo = counter.dataset.count,
            countPerMs = countTo / duration;
        var currentCount = 0;
        var countInterval = setInterval(function () {
          currentCount >= countTo && clearInterval(countInterval), counter.textContent = Math.round(currentCount), currentCount += countPerMs;
        }, 1);
      }), isCounted = !0);
    });
  }
} // const newsletterPopup = function () {
//     let newsletterWrapper = document.querySelector(".newsletter__popup"),
//         newsletterCloseButton = document.querySelector(".newsletter__popup--close__btn"),
//         dontShowPopup = document.querySelector("#newsletter__dont--show"),
//         popuDontShowMode = localStorage.getItem("newsletter__show");
//     newsletterWrapper &&
//         null == popuDontShowMode &&
//         window.addEventListener("load", (event) => {
//             setTimeout(function () {
//                 document.body.classList.add("overlay__active"),
//                     newsletterWrapper.classList.add("newsletter__show"),
//                     document.addEventListener("click", function (event) {
//                         event.target.closest(".newsletter__popup--inner") || (document.body.classList.remove("overlay__active"), newsletterWrapper.classList.remove("newsletter__show"));
//                     }),
//                     newsletterCloseButton.addEventListener("click", function () {
//                         document.body.classList.remove("overlay__active"), newsletterWrapper.classList.remove("newsletter__show");
//                     }),
//                     dontShowPopup.addEventListener("click", function () {
//                         dontShowPopup.checked ? localStorage.setItem("newsletter__show", !0) : localStorage.removeItem("newsletter__show");
//                     });
//             }, 3e3);
//         });
// };
// newsletterPopup();
/******/ })()
;