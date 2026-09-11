$(function () {

    selectRefresh();
    tooltipRefresh();

    // DARK MODE
    if (localStorage.getItem("data-theme") && localStorage.getItem("data-theme") == "dark") {
        $("#checkboxDarkMode").prop("checked", true);
        $('body').toggleClass('dark-mode');
        $('aside').toggleClass('sidebar-light-primary');
        $('aside').toggleClass('sidebar-dark-primary');
        $('.main-header').toggleClass('navbar-light');
        $('.main-header').toggleClass('navbar-dark');
        $('.card-header-sticky').toggleClass('card-header-dark');
        $('.content-wrapper').toggleClass('content-wrapper-dark');
        $('.select2-container--bootstrap4 .select2-selection').attr('style', 'background: #000 !important');
    }

    $("#checkboxDarkMode").change(function () {
        if ($(this).prop('checked') == true) {
            localStorage.setItem("data-theme", "dark");
        }
        else {
            localStorage.removeItem("data-theme");
        }
        $('body').toggleClass('dark-mode');
        $('aside').toggleClass('sidebar-light-primary');
        $('aside').toggleClass('sidebar-dark-primary');
        $('.main-header').toggleClass('navbar-light');
        $('.main-header').toggleClass('navbar-dark');
        $('.card-header-sticky').toggleClass('card-header-dark');
        $('.content-wrapper').toggleClass('content-wrapper-dark');
    });
    // DARK MODE END

    $('.summernote').each(function () {
        id = $(this).attr('name');
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.protectedSource.push(/<i[^>]*><\/i>/g);
        CKEDITOR.replace(id,
            {
                enterMode: Number(2),
            });
    });

    // DASHBOARD CLOCK
    var clockElement = document.getElementById('clock');

    function clock() {
        clockElement.textContent = new Date().toLocaleTimeString();
    }
    setInterval(clock, 1000);

    // DASHBOARD CLOCK END

    // Page load loader
    setTimeout(function () {
        $('.loaderDiv').hide();
    }, 1000);

    // end


    // loader on ajax request
    $(document)
        .ajaxStart(function () {
            $(".loaderDiv").show();
        })
        .ajaxStop(function () {
            selectRefresh();
            tooltipRefresh();
            $(".loaderDiv").hide();
        });

    // end

    // loader on form submit

    $('form').on("submit", function () {
        if ($(this).attr('id') != 'downld')
            $(".loaderDiv").show();
    });



    // end

    // Sidebar menu selected

    $(".nav-link").each(function () {
        if ($(this).hasClass("active")) {
            if ($(this).hasClass("dashboard")) {
            }
            else {
                $(this).parent().parent().prev().addClass('active');
                $(this).parent().parent().parent().addClass('menu-open menu-is-opening');
            }
        }
    });

    // end

    // Image gallery And Preview start
    $("body").on('change', '.image', function (e) {
        let reader = new FileReader();
        let previewTag = $(this).parentsUntil(".imageSection").siblings(".previewBox").children();

        reader.onload = (e) => {
            $(previewTag).attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $("body").on('click', '.chooseFile', function (e) {
        $(".adminMediaRow").empty();
        currentId = $(this).attr('id');
        element = $(this);
        $('#galleryDiv').modal('show');
        $(".modal").on('click', '#loadMore', function () {
            page++;
            infinteLoadMore(page);
        });
        $(".modal").on('click', '.adminMedia', function () {
            let srcVal = $(this).children("#media").val();
            let srcAttr = $(this).children("img").attr('src');
            $(element).parentsUntil(".imageSection").siblings(".previewBox").children().attr('src', srcAttr);
            $("#" + currentId).next().val(srcVal);
            $('#galleryDiv').modal('hide');
        });

        var ENDPOINT = APP_URL;
        var page = 1;
        infinteLoadMore(page);

        function infinteLoadMore(page) {
            $.ajax({
                url: ENDPOINT + "/admin/media?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('#loaderImage').removeClass('hide');
                }
            })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("<h4>No More Data To Display!</h4>");
                        $('#loaderImage').addClass('hide');
                        return;
                    }
                    $(".adminMediaRow").append(response).show('slow');
                    $('#loaderImage').addClass('hide');

                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    });

    $(".card").on('keypress', '.onlyNumbers', function (e) {
        var charCode = (e.which) ? e.which : e.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });

    $(".card").on('keypress', '.onlyNumbersWithDecimal', function (e) {
        var charCode = (e.which) ? e.which : e.keyCode;
        var val = $(this).val();
        if (val.split('.').length > 2) {
            val = val.replace(/\.+$/, "");
            return $(this).val(val);
        }
        if (String.fromCharCode(charCode).match(/[^0-9\.]/g))
            return false;
    });

});

function selectRefresh() {
    $('select:not(.groupProducts,.productType,.swal2-select,.custom-select)').select2({
        theme: 'bootstrap4',
    });

}

function tooltipRefresh() {
    $('[data-toggle="tooltip"]').tooltip();
}

// Image gallery And Preview end