/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./public/front/js/wishlist.js ***!
  \*************************************/
loadWishlist();
$("body").on("click", '.AddToWishList', function () {
  var dataId = $(this).attr("data-id");
  addToWishlist(dataId);
});
$("body").on("click", '.removeWishList', function () {
  var formValues = $(this).val();
  wishlistRemoveData(formValues);
});
$("body").on("submit", '.variableProductForm', function (event) {
  event.preventDefault();
  var formValues = $(this).serialize();

  if (buttonClicked == 'addToCart') {
    addToCart(formValues);
  } else {
    wishlistRemove(formValues);
  }
});

function addToCart(formValues) {
  var url = ENDPOINT + "add-to-cart";
  $.post(url, formValues, function (dataValues) {
    var cartData = dataValues.data;
    var totalQuantity = 0;
    $.each(cartData, function (key, value) {
      totalQuantity = parseInt(totalQuantity) + parseInt(value.quantity);
    });
    $(".cartCount").text(totalQuantity); // console.log(cartData);

    $.ajax({
      type: "POST",
      dataType: 'html',
      data: {
        "_token": excy
      },
      url: ENDPOINT + "miniCart",
      success: function success(response) {
        var data = JSON.parse(response);
        $(".miniCartBox").empty();
        $(".miniCartBox").append(data.html);
        $('.subTotal').html('&#8377;' + data.subTotalCart);
        $('.gTotal').html('&#8377;' + data.actualTotalCart);

        if (data.actualTotalCart != 0) {
          $('.hidevalues').removeClass('hide');
        } else {
          $('.hidevalues').addClass('hide');
        }

        Toast.fire({
          icon: 'success',
          title: 'Item Added To Cart Successfully'
        });
      }
    });

    if (dataValues.isWishlist) {
      $("#wishlistCount").text(dataValues.dataCount);
      $("#wishlistCountMob").text(dataValues.dataCount);
      loadWishlist();
    }
  });
  return true;
}

function loadWishlist() {
  $("#wishlistBox").empty();
  $.ajax({
    url: ENDPOINT + "get-wishlist",
    datatype: "html",
    type: "get"
  }).done(function (response) {
    // console.log(response.html);
    $("#wishlistBox").append(response.html);
  }).fail(function (jqXHR, ajaxOptions, thrownError) {
    console.log('Server error occured');
  });
}

function addToWishlist(numberCount) {
  var url = ENDPOINT + "add_to_wishlist";
  var itemId = $(".itemIdProduct-" + numberCount).val();
  var variationId = $(".variationIdProduct-" + numberCount).val();
  var itemName = $(".itemNameProduct-" + numberCount).val();
  var itemPrice = $(".itemPriceProduct-" + numberCount).val();
  var itemType = $(".itemTypeProduct-" + numberCount).val();
  var image = $(".imageProduct-" + numberCount).val();
  $.ajax({
    type: "POST",
    data: {
      "_token": excy,
      "itemId": itemId,
      "variationId": variationId,
      "itemName": itemName,
      "itemPrice": itemPrice,
      "itemType": itemType,
      "image": image
    },
    url: url,
    success: function success(response) {
      Toast.fire({
        icon: 'success',
        title: response.message
      });
      $("#wishlistCount").text(response.dataCount);
      $("#wishlistCountMob").text(response.dataCount);

      if (response.keyVal == 'add') {
        $(".wishlistChange-" + numberCount).addClass('wactive');
      } else {
        $(".wishlistChange-" + numberCount).removeClass('wactive');
      }
    }
  });
}

function wishlistRemove(formValues) {
  var url = ENDPOINT + "add_to_wishlist";
  $.post(url, formValues, function (data) {
    $("#wishlistCount").text(data.dataCount);
    $("#wishlistCountMob").text(data.dataCount);
    loadWishlist();
  });
  return true;
}

function wishlistRemoveData(formValues) {
  alert(formValues);
  var url = ENDPOINT + "remove-wish-list";
  $.ajax({
    type: "POST",
    data: {
      "_token": excy,
      "itemId": itemId,
      "variationId": variationId,
      "itemName": itemName,
      "itemPrice": itemPrice,
      "itemType": itemType,
      "image": image
    },
    url: url,
    success: function success(response) {
      Toast.fire({
        icon: 'success',
        title: response.message
      });
      $("#wishlistCount").text(response.dataCount);
      $("#wishlistCountMob").text(response.dataCount);

      if (response.keyVal == 'add') {
        $(".wishlistChange-" + numberCount).addClass('wactive');
      } else {
        $(".wishlistChange-" + numberCount).removeClass('wactive');
      }
    }
  });
}
/******/ })()
;