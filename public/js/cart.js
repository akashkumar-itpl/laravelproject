/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./public/front/js/cart.js ***!
  \*********************************/
loadCart();
var buttonClicked;
$("body").on("click", '.addToCart', function () {
  buttonClicked = $(this).val();
});
$("body").on("focus", ".couponCode", function () {
  $('.couponCode_err').empty();
});
$("body").on("submit", '.formCart', function (event) {
  event.preventDefault();
  var formValues = $(this).serialize();
  var url = buttonClicked == 'increment' ? ENDPOINT + "incrementcart" : buttonClicked == 'decrement' ? ENDPOINT + "decrementcart" : buttonClicked == 'remove' ? ENDPOINT + "remove" : '';
  $.ajax({
    type: "POST",
    dataType: 'html',
    data: formValues,
    url: url,
    success: function success(response) {
      $(".cartBox").empty();
      $(".cartBox").append(response);
      $.ajax({
        type: "POST",
        dataType: 'html',
        data: {
          "_token": excy
        },
        url: ENDPOINT + "miniCart",
        success: function success(responseInner) {
          var data = JSON.parse(responseInner);
          var cartData = data.cartData;
          var totalQuantity = 0;
          $.each(cartData, function (key, value) {
            totalQuantity = parseInt(totalQuantity) + parseInt(value.quantity);
          });
          $(".cartCount").text(totalQuantity);
          $(".miniCartBox").empty();
          $(".miniCartBox").append(data.html);
          $('.subTotal').html('&#8377;' + data.subTotalCart);
          $('.gTotal').html('&#8377;' + data.actualTotalCart);

          if (totalQuantity != 0) {
            $('.hidevalues').removeClass('hide');
          } else {
            $('.hidevalues').addClass('hide');
          }

          Toast.fire({
            icon: 'success',
            title: 'Cart Updated Successfully'
          });
        }
      });
    }
  });
});
$("body").on("click", '.removeCoupon', function (e) {
  window.location.href = ENDPOINT + "removeCoupon";
});
$("body").on("submit", '.formCoupon', function (e) {
  e.preventDefault();
  $(this).find(':submit').attr('disabled', true);
  $('.couponCode_err').empty();
  var userLogin = $(this).attr("user");
  var couponCode = $("#couponCode").val();

  if (couponCode.length > 0) {
    if (userLogin) {
      var url = ENDPOINT + "applyCoupon";
      var formValues = $(this).serialize();
      $.ajax({
        type: "POST",
        dataType: 'json',
        data: formValues,
        url: url,
        success: function success(response) {
          if (response.status == 200) {
            $(".cartBox").empty();
            $(".cartBox").append(response.html);
            Toast.fire({
              icon: 'success',
              title: response.message
            });
            $('.applyCoupon').attr('disabled', false);
          } else {
            $('.site-btn').attr('disabled', false);
            Toast.fire({
              icon: 'error',
              title: response.message
            });
            $('.couponCode_err').html(response.message);

            if (response.error) {
              $('.couponCode_err').html(response.error);
            }

            $('.applyCoupon').attr('disabled', false);
          }

          $('.applyCoupon').attr('disabled', false);
        }
      });
    } else {
      Toast.fire({
        icon: 'error',
        title: ' Login to Apply Coupon'
      });
      $('.couponCode_err').html('Please <a href="' + ENDPOINT + 'login">login</a> to apply coupon');
      $(this).find(':submit').attr('disabled', false);
    }
  } else {
    Toast.fire({
      icon: 'error',
      title: ' Enter a coupon code'
    });
    $('.couponCode_err').html('Please enter a coupon code to continue');
    $(this).find(':submit').attr('disabled', false);
  }
});
$("body").on("click", "#checkout", function (e) {
  var formValues = $("#checkoutForm").serialize();
  var url = ENDPOINT + "place_order";
  $("#checkout").attr('disabled', false);
  $.ajax({
    type: "POST",
    data: formValues,
    url: url,
    success: function success(response) {
      if (response.status == 200) {
        window.location.href = response.redirectUrl;
      } else {
        Toast.fire({
          icon: 'error',
          title: response.message
        });

        if (response.error) {
          $.each(response.error, function (key, value) {
            $('.' + key + '_err').text(value);
          });
          $('html, body').animate({
            scrollTop: $('.' + Object.keys(response.error)[0] + '_err').parent().offset().top - 80
          }, 1500);
        }
      }

      $("#checkout").attr('disabled', false);
    }
  });
});
$("body").on("click", "#sameAsAbove", function () {
  billingAddress();
}); // $("body").on("input", "input", function () {
//     billingAddress()
// });

$("body").on("click", ".paymentType", function () {
  dataId = $(this).data("id");
  $(".paymentTypeHidden").attr('checked', false);
  $("#" + dataId).attr('checked', true);
});

function loadCart() {
  $(".cartBox").empty();
  var pageSlug = $("#pageSlug").val();
  $.ajax({
    url: ENDPOINT + "cart",
    datatype: "html",
    data: {
      "pageSlug": pageSlug
    },
    type: "get"
  }).done(function (response) {
    $(".cartBox").append(response);
  }).fail(function (jqXHR, ajaxOptions, thrownError) {
    console.log('Server error occured');
  });
}

function billingAddress() {
  if ($("#sameAsAbove").prop("checked") == true) {
    $("#firstNameBilling").val($("#firstName").val());
    $("#lastNameBilling").val($("#lastName").val());
    $("#streetAddressBilling").val($("#streetAddress").val());
    $("#addressSectionTwoBilling").val($("#addressSectionTwo").val());
    $("#cityBilling").val($("#city").val());
    $("#stateBilling").val($("#state").val());
     $("#cityBillingdemo").val($("#city").val());
        $("#stateBillingdemo").val($("#state").val());
    $("#pinCodeBilling").val($("#pinCode").val());
    $("#phoneNumberBilling").val($("#phoneNumber").val());
    $("#emailIdBilling").val($("#emailId").val());
  } else {
    $("#firstNameBilling").val("");
    $("#lastNameBilling").val("");
    $("#streetAddressBilling").val("");
    $("#addressSectionTwoBilling").val("");
    $("#cityBilling").val("");
    $("#stateBilling").val("");
    $("#pinCodeBilling").val("");
    $("#phoneNumberBilling").val("");
    $("#emailIdBilling").val("");
  }
}
/******/ })()
;