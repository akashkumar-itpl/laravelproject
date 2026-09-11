$(function () {

  // multiimage upload start
  // *************************************



  var imagesloader = $('[data-type=imagesloader]').imagesloader({
    // animation speed
    fadeTime: 'slow',
    // input ID
    inputID: 'files',
    // maximum number of files
    maxfiles: 15,
    // max image bytes
    maxSize: 5000 * 1024,
    // min image count
    minSelect: 1,
    // allowed file types
    filesType: ["image/jpeg", "image/png", "image/gif"],
    // max/min height
    maxWidth: 1280,
    maxHeight: 1024,
    // image type
    imgType: "image/jpeg",
    // image quality from 0 to 1
    imgQuality: 0.9,
    // error messages
    errorformat: "Accepted format",
    errorsize: "Max size allowed",
    errorduplicate: "File already uploaded",
    errormaxfiles: "Max images you can upload",
    errorminfiles: "Minimum number of images to upload",
    // text for modify image button
    modifyimagetext: "Modify image",
    // angle of each rotation
    rotation: 90
  });
  // *************************************
  // multiimage upload end


  $("#adminForm").on('submit', function (e) {
    e.preventDefault();
    if (typeof (CKEDITOR) !== "undefined") {
      $('.summernote').each(function () {
        id = $(this).attr('name');
        var editor = CKEDITOR.instances[id];
        if (typeof (editor) !== "undefined") {
          document.getElementById(id).value = editor.getData();
        }
      });
    }

    $(".error-text").empty();
    $(".error-icon").removeClass('fa fa-close');
    $(this).find(':submit').attr('disabled', true);
    let actionUrl = $(this).attr('action');

    let data = new FormData(this);

    if (typeof (imagesloader.data('format.imagesloader')) !== 'undefined') {
      let multiImageData = imagesloader.data('format.imagesloader').AttachmentArray;
      data.append('multiImages', JSON.stringify(multiImageData));
    }

    // console.log(JSON.stringify(data));

    $.ajax({
      url: actionUrl,
      type: 'POST',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
        if (data.status == 200) {
          $('#adminForm').trigger('reset')
          if (data.redirect) {
            Toast.fire({
              icon: 'success',
              title: data.message
            });
            window.location.href = APP_URL + data.redirectUrl;
          }
          else {

            $('html, body').animate({ scrollTop: $(document).height() }, 1000);
            $(".success-message").removeClass('hide');
            // $('form').trigger("reset");
            $('.preview-image-before-upload').attr('src', APP_URL+"/public/storage/media/admin/placeholder.png");

            Toast.fire({
              icon: 'success',
              title: data.message
            });
            $('#example1').DataTable().ajax.reload();
            $("#adminForm").find(':submit').attr('disabled', false);

          }

        } else {
          $("#adminForm").find(':submit').attr('disabled', false);
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





  // Change Statues ACTIVE INACTIVE

  $(document).on('click', '.changeStatus', function () {
    let currenturl = $(this).data('url');
    $.ajax({
      url: currenturl,
      type: 'get',
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
        Toast.fire({
          icon: 'success',
          title: data.message
        });
        $('#example1').DataTable().ajax.reload();
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