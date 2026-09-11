/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./public/front/js/frontform.js ***!
  \**************************************/
/******/
(function () {
  // webpackBootstrap
  var __webpack_exports__ = {};
  /*!**************************************!*\
    !*** ./public/front/js/frontform.js ***!
    \**************************************/

  $(function () {
    $("form").submit(function (e) {
      e.preventDefault();
      var data = new FormData(this);
      $(".error-text").empty();
      $(".error-icon").removeClass('fa fa-close');
      $(this).find(':submit').attr('disabled', true);
      var actionUrl = $(this).attr('action'); // data.append("_token", "{{ csrf_token() }}");
      // alert(JSON.stringify(data));

      $.ajax({
        url: actionUrl,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function success(data) {
          if (data.status == 200) {
            if (data.openmodel == true) {
              //alert('function run');
              // $('#squarespaceModal').modal('show');
              $('#email_otp').val(data.userData.email);
              $('#phone_otp').val(data.userData.phoneNumber);
              $('#name_otp').val(data.userData.username);
              $('#password_otp').val(data.userData.password);
              $('#role_otp').val(data.userData.role_id); // newsletterPopupNew();

              $('body').addClass('overlay__active');
              $('.newsletter__popup').addClass('newsletter__show');
            }

            if (data.redirect) {
              var base_path = $("#siteUrl").val();
              window.location.href = base_path + '/' + data.redirectUrl;
            }

            Toast.fire({
              icon: 'success',
              title: data.message
            });
          } else {
            $("#ajaxForm1").find(':submit').attr('disabled', false);
            $("#ajaxForm").find(':submit').attr('disabled', false);
            $("#ajaxForm3").find(':submit').attr('disabled', false);
            Toast.fire({
              icon: 'error',
              title: data.message
            });

            if (data.error) {
              printErrorMsg(data.error);
            }
          }
        }
      });
    });
  });

  function printErrorMsg(msg) {
    $.each(msg, function (key, value) {
      $('.' + key + '_err').text(value);
      var inventoryErrorFirstTabId = $('.' + key + '_err').closest('.tab-pane').attr('id');
      $("#" + inventoryErrorFirstTabId + "-tab > .error-icon").addClass('fa fa-close');
    });
    $('html, body').animate({
      scrollTop: $('.' + Object.keys(msg)[0] + '_err').parent().offset().top - 80
    }, 1500);
  }
  /******/

})();
/******/ })()
;