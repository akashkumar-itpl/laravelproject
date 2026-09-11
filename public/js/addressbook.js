/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./public/front/js/addressbook.js ***!
  \****************************************/
getAddress();
$("body").on("change", "#state", function () {
  var stateId = $(this).val();
  getcity(stateId, 0);
});
$('#checkoutForm').ready(function () {
  loadDefaultAddress();
}); // $("body").on("load", "#checkoutForm", function () {
//     // var stateId = $(this).val();
//     loadDefaultAddress();
// });

function getcity(stateId, cityId) {
  // alert('functoni run');
  var base_path = $("#siteUrl").val();
  var state = stateId;
  var city = cityId;

  if (state) {
    $.ajax({
      type: "POST",
      data: {
        "_token": excy,
        "stateId": state
      },
      url: base_path + '/getcity',
      success: function success(res) {
        // console.log(res);
        if (res) {
          $("#cityId").empty();
          $("#cityId").append('<option>Select City</option>');
          $.each(res, function (key, value) {
            var selected = "";

            if (key == city) {
              selected = 'selected';
            }

            $("#cityId").append('<option value="' + key + '" ' + selected + '  > ' + value + '</option>');
          });
        } else {
          $("#cityId").empty();
        }
      }
    });
  } else {
    $("#cityId").empty();
  }
}

$("body").on("click", "#addrssdefault", function (e) {
  var addrsssId = $(this).data('id');
  var base_path = $("#siteUrl").val();
  var pageSlug = $("#pageSlug").val();
  console.log(pageSlug);

  if (addrsssId) {
    $.ajax({
      type: "POST",
      data: {
        "_token": excy,
        "addrsssId": addrsssId,
        "pageSlug": pageSlug
      },
      url: base_path + '/dafaul-address',
      success: function success(res) {
        if (pageSlug == 'checkout') {
          console.log(res.mobile);
          var name = res.fullName.split(" ");
          $('#emailId').val(res.email);
          $('#phoneNumber').val(res.mobile);
          $('#firstName').val(name[0]);
          $('#lastName').val(name[1]);
          $('#streetAddress').val(res.address); // $('#addressSectionTwo').val(res.mobile);

          $('#city').val(res.cityName);
          $('#state').val(res.stateName);
          $('#pinCode').val(res.pincode);
          closepopup();
          Toast.fire({
            icon: 'success',
            title: 'Address selected as shipping address.'
          });
        } else {
          Toast.fire({
            icon: 'success',
            title: 'This Address Set as Default'
          });
          getAddress();
        }
      }
    });
  }
});

function getAddress() {
  var base_path = $("#siteUrl").val();
  var pageSlug = $("#pageSlug").val(); // console.log(pageSlug+"sss");

  $.ajax({
    type: "POST",
    data: {
      "_token": excy,
      "pageSlug": pageSlug
    },
    url: base_path + "/get-address"
  }).done(function (response) {
    $("#addressBook").empty().append(response.html);
  });
}

$("body").on("click", "#addAddress", function (e) {
  $("form").trigger("reset");
  $('.newsletter__popup').addClass('newsletter__show');
  $('body').addClass('overlay__active');
});
$("body").on("click", "#delAddress", function () {
  var delId = $(this).data('id');
  var base_path = $("#siteUrl").val();
  $.ajax({
    type: "POST",
    data: {
      "_token": excy,
      "delId": delId
    },
    url: base_path + "/del-address"
  }).done(function (response) {
    Toast.fire({
      icon: 'success',
      title: 'Address Delete Successfully'
    });
    getAddress();
  });
});
$("body").on("click", "#edditaddress", function () {
  var addrsssId = $(this).data('id');
  $('#edditid').val(addrsssId.id);
  $('#fullName').val(addrsssId.fullName);
  $('#email').val(addrsssId.email);
  $('#mobile').val(addrsssId.mobile);
  $('#address').val(addrsssId.address);
  $('#state').val(addrsssId.state); // $('#cityId').val(addrsssId.city);

  $('#pincode').val(addrsssId.pincode);
  getcity(addrsssId.state, addrsssId.city);
  $('.newsletter__popup').addClass('newsletter__show');
  $('body').addClass('overlay__active');
});

function loadDefaultAddress() {
  var base_path = $("#siteUrl").val();
  var pageSlug = $("#pageSlug").val();
  $.ajax({
    type: "POST",
    data: {
      "_token": excy,
      "pageSlug": pageSlug
    },
    url: base_path + "/get-default-address"
  }).done(function (response) {
    // console.log(response); 
    var name = response.addressList.fullName.split(" ");
    // console.log(response.addressList.fullName);
    $("#firstName").val(name[0]);
    $("#lastName").val(name[1]);
    $("#streetAddress").val(response.addressList.address);
    $("#city").val(response.addressList.cityName);
    $("#state").val(response.addressList.stateName);
    $("#pinCode").val(response.addressList.pincode);
    $("#phoneNumber").val(response.addressList.mobile);
    $("#emailId").val(response.addressList.email);
  });
}

$("body").on("click", "#CheckAddress", function (e) {
  var formValues = $("#addressForm").serialize();
  var url = ENDPOINT + "add-address";
  $("#CheckAddress").attr('disabled', false);
  $.ajax({
    type: "POST",
    data: formValues,
    url: url,
    success: function success(response) {
      if (response.status == 200) {
        Toast.fire({
          icon: 'success',
          title: response.message
        });
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

      $("#CheckAddress").attr('disabled', false);
    }
  });
});
/******/ })()
;