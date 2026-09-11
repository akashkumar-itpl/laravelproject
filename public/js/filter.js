/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./public/front/js/filter.js ***!
  \***********************************/
var page = 1;
checkAllChecked();
productVariationData();
// infinteLoadMore(page);
quantityNumberStop($(".quantity__number1").val());
$("body").on("click", ".increase1", function (e) {
  // console.log($(".quantity__number").val());
  quantityNumberStop($(".quantity__number1").val());
});
$("body").on("click", ".decrease1", function (e) {
  // console.log($(".quantity__number").val());
  quantityNumberStop($(".quantity__number1").val());
}); // LAZY LOADING START

$(".shop1").on("click", ".loading__button", function (e) {
  page++;
  infinteLoadMore(page);
});
$("#sortProduct").on('change', function (e) {
  $('#loaderImage').removeClass('hide');
  page = 1;
  $(".productAjaxDiv").empty();
  infinteLoadMore(page);
});
$(".shop1").on("click", '.filters', function () {
  page = 1;
  var dataCurrentCheck = $(this).is(':checked');

  if (!dataCurrentCheck) {
    dataCurrent = $(this).data('current');
    $("." + dataCurrent).removeAttr('checked');
  } else {
    dataCurrent = $(this).data('current');
    $("." + dataCurrent).attr('checked', true);
    checkAllChecked();
  }

  $(".productAjaxDiv").empty();
  infinteLoadMore(page);
});
$(".shop1").on("click", '.filterByPrice', function () {
  page = 1;
  $(".productAjaxDiv").empty();
  infinteLoadMore(page);
});
$(".shop1").on("click", '.attributesFilter', function () {
  page = 1;
  $(".productAjaxDiv").empty();
  infinteLoadMore(page);
});
$(".shop1").on("submit", 'form', function (event) {
  event.preventDefault();
  var formValues = $(this).serialize();
  var productType = $(this).children('#productType').val();

  if (productType != 'variable') {
    console.log(productType);
    addToCart(formValues);
  } else {
    selectProductVariation($(this).data("prodid"));
  }
});
$("body").on("click", '.buyNowButton', function (event) {
  // event.preventDefault();
  var formValues = $("#dataForm").serialize();
  var productType = $(this).children('#productType').val(); // console.log(formValues);

  addToCart(formValues, 'checkout');
});
$("body").on("submit", '.variableProductForm', function (event) {
  event.preventDefault();
  var formValues = $(this).serialize();
  var productType = $(this).children('#productType').val();
  addToCart(formValues);
});
$("body").on("click", '.attributeSelect', function (event) {
  productVariationData();
});
$("body").on("click", '.variationQtyMinus', function (event) {
  qtyVal = $(".product-qty").val();

  if (qtyVal > 1) {
    newQty = parseInt(qtyVal) - 1;
    $(".product-qty").val(newQty);
    if (newQty == 1) $(".variationQtyMinus").addClass("invisible");else $(".variationQtyMinus").removeClass("invisible");
  } else {
    $(".variationQtyMinus").addClass("invisible");
  }
});
$("body").on("click", '.variationQtyPlus', function (event) {
  qtyVal = $(".product-qty").val();
  newQty = parseInt(qtyVal) + 1;
  $(".product-qty").val(newQty);
  if (newQty > 1) $(".variationQtyMinus").removeClass("invisible");
}); // $("body").on("input", "#minamount", function() {
//     console.log($(this).val());
// });

function quantityNumberStop(Value) {
  // alert(Value);
  if (Value <= '1') {
    $(".decrease1").attr('disabled', true);
  } else {
    $(".decrease1").attr('disabled', false);
  }
}

function checkAllChecked() {
  $('.filters:checkbox:checked').each(function () {
    var dataCurrentCheck = $(this).is(':checked');

    if (dataCurrentCheck) {
      dataCurrent = $(this).data('current');
      $("." + dataCurrent).attr('checked', true);
    }
  });
}

function selectProductVariation(prodId) {
  var url = ENDPOINT + "variable-product";
  $.ajax({
    type: "GET",
    dataType: 'html',
    data: {
      id: prodId
    },
    url: url,
    success: function success(response) {
      $(".productPopupBody").empty();
      $(".productPopupBody").append(response).show('slow'); // console.log("dddd");

      productVariationData();
      $('body').addClass('overlay__active');
      $('.newsletter__popup').addClass('newsletter__show');
      $('.add__to--cart').attr('disabled', false); // $('#productPopupForm').modal({
      //     backdrop: 'static',
      //     keyboard: false
      // });
    }
  });
}

function productVariationData() {
  attributeId = new Array();
  attributeValId = new Array();
  $('.attributeSelect:checked').each(function () {
    attributeId.push($(this).data("attributeid"));
    attributeValId.push($(this).val());
  });
  productId = $(".productId").val(); // console.log(attributeValId);

  var url = ENDPOINT + "variableProductData";
  $.ajax({
    type: "GET",
    dataType: 'json',
    data: {
      attributeId: attributeId,
      attributeValId: attributeValId,
      productId: productId
    },
    url: url,
    success: function success(response) {
      var variationData = response.variationData;
      var regularPrice = parseFloat(variationData.regularPrice).toFixed(2);
      var salePrice = parseFloat(variationData.salePrice).toFixed(2);
      var variationImage = variationData.variation_image;

      if (variationImage !== null) {
        var variationImageName = variationImage.image;
        $("#variationImageCart").val(variationImageName);
        var variationImageSrc = ASSETENDPOINT + variationImageName;
        $(".variationImage").attr("src", variationImageSrc);
      }

      var priceHtml = salePrice > 0 ? '<i class="fa fa-rupee"></i>' + salePrice + ' &nbsp;<small><s><i class="fa fa-rupee"></i>' + regularPrice + '</s></small>' : '<i class="fa fa-rupee"></i>' + regularPrice + '';
      console.log(regularPrice);
      $("#itemPrice1").val(regularPrice);
      $(".product__details__price").empty();
      $(".product__details__price").html(priceHtml);
      $("#salePrice").val(salePrice);
      $("#itemId1").val(variationData.product_id);
      $("#variationId").val(variationData.id);
    }
  });
}

function addToCart(formValues) {
  var dataWhere = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var url = ENDPOINT + "add-to-cart";
  $.post(url, formValues, function (data) {
    var cartData = data.data;
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
        $('.add__to--cart').attr('disabled', false);
        $('.variant__buy--now__btn').attr('disabled', false);
        var data = JSON.parse(response);
        $(".miniCartBox").empty();
        $(".miniCartBox").append(data.html);
        $('.subTotal').html('&#8377;' + data.subTotalCart);
        $('.gTotal').html('&#8377;' + data.actualTotalCart);

        if (data.subTotalCart != 0) {
          $('.hidevalues').removeClass('hide');
        } else {
          $('.hidevalues').addClass('hide');
        }

        Toast.fire({
          icon: 'success',
          title: 'Item Added To Cart Successfully'
        });

        if (dataWhere == 'checkout') {
          window.location.href = ENDPOINT + "checkout";
        }
      }
    });
  });
  return true;
}

function infinteLoadMore(page) {
  $(".noProduct").remove();
  var categoryVals = $("#blackCategory1").val();
  var sortProduct = $("#sortProduct").val(); // var categoryVals = $('.CategoryFilter:checkbox:checked').map(function () {
  //     return this.value;
  // }).get();
  // console.log(categoryVals);

  var brandVals = $('.BrandFilter:checkbox:checked').map(function () {
    return this.value;
  }).get();
  var attrVals = {}; // note this

  $('.attributesFilter:checkbox:checked').each(function () {
    attr = $(this).data('id');
    if (attrVals[attr]) attrVals[attr].push($(this).val());else attrVals[attr] = [$(this).val()];
  });
  var attrValsJson = JSON.stringify(attrVals);
  var priceRange = $("#minamount").val() + "-" + $("#maxamount").val();
  $.ajax({
    url: ENDPOINT + "product-get",
    datatype: "html",
    data: {
      "_token": excy,
      "page": page,
      "sortProduct": sortProduct,
      "categoryVals": categoryVals,
      "brandVals": brandVals,
      "attrVals": attrValsJson,
      "priceRange": priceRange // "inputCategory": inputCategory,

    },
    type: "post"
  }).done(function (response) {
    response.count ? $(".load-more").slideDown() : $(".load-more").slideUp();
    $(".productAjaxDiv").append(response.html).show('slow');
    $('#AAAA').removeClass('active');
    $('body').removeClass('offcanvas__filter--sidebar_active');
    $('.attributeRadio:checked').each(function () {
      var attributeValueId = $(this).val();
      var productId = $(this).data('product');
      loadVariableProduct(attributeValueId, productId);
    });
  }).fail(function (jqXHR, ajaxOptions, thrownError) {
    console.log('Server error occured');
  });
} // LAZY LOADING END


function loadVariableProduct(attributeValueId, productId) {
  $.ajax({
    url: ENDPOINT + "variable-product?attribute=" + attributeValueId + "&product=" + productId,
    datatype: "json",
    type: "get"
  }).done(function (response) {
    console.log(response);
  }).fail(function (jqXHR, ajaxOptions, thrownError) {
    console.log('Server error occured');
  });
}
/******/ })()
;