@extends('admin/layout')

@section('page_title', 'Manage Media')

@section('info', 'Manage Media.')

@section('Appearance', 'menu-open')

@section('media', 'active')

@section('container')





    <div class="content-wrapper">

        <!-- Content Header (Page header) -->



        <!-- /.content-header -->

        <div class="card">

            <div class="card-header">

                <h3 class="card-title" style="font-size: 1.6em">@yield('page_title') <sup><a href="#" data-toggle="tooltip"

                            data-placement="top" title="@yield('info')"><i class="fa fa-info-circle"></i></a></sup></h3>

                <div class="card-tools">

                    <a href="javascript:void(0)" id="uplodaButton" class="btn btn-success badge">Upload <small><i

                                class="right fas fa-plus"></i></small></a>



                    <a onClick="multidelete()" data-taskurl="{{ url('admin/media-multitask') }}"

                        class="btn btn-danger badge">Delete <small><i class="right fas fa-trash"></i></small></a>





                </div>



            </div>

            <!-- /.card-header -->

            <div class="card-body">

                <div class="row" id="uploadDiv">

                    <div class="col-md-12">

                        <form class="box " method="post" action="{{ route('admin.add-media-form') }}"

                            enctype="multipart/form-data">

                            @csrf

                            <label for="files" class="btn btn-info">Select File & Upload &nbsp;<i

                                    class="fas fa-upload"></i></label>

                            <input id="files" style="visibility:hidden;" class="multi-media-upload" type="file" name="media[]" multiple>

                            <input id="title" type="hidden" name="title">

                            <input type="submit" style="visibility: hidden">

                        </form>
                        <span class="text-danger error-text image_err"></span>
                        <div class="multi-preview mt-3"></div>
                        <small class="text-success compress-msg"></small>

                    </div>



                </div>

                <div class="row adminMediaRow">



                </div>

            </div>

            <!-- /.card-body -->

        </div>

        <!-- /.card -->

    </div>





    <div class="modal fade" id="modal-xl">

        <div class="modal-dialog modal-xl">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title float-left">Attachment details</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body modal-body-custom">

                    <div class="row" style="height: inherit">

                        <div class="col-md-8 modal-image hide">

                            <img id="modalImage" src="" />

                        </div>

                        <div class="col-md-8 modal-iframe hide">

                            <iframe id="modalIframe"></iframe>

                        </div>

                        <div class="col-md-4 detail-row">

                            <table>

                                <tr>

                                    <td>File name : </td>

                                    <td id="fileName"></td>

                                </tr>

                                <tr>

                                    <td>File type : </td>

                                    <td id="fileType"></td>

                                </tr>

                                <tr>

                                    <td>Uploaded on : </td>

                                    <td id="fileUploadDate"></td>

                                </tr>

                                <tr>

                                    <td>File size : </td>

                                    <td id="fileSize"></td>

                                </tr>

                                <tr>

                                    <td>Dimensions : </td>

                                    <td id="fileDimension"></td>

                                </tr>

                            </table>

                            <hr>

                            <table style="width: 100%">

                                <tr>

                                    <td colspan="2">File URL : <input type="text" readonly class="urlInput" /></td>

                                </tr>

                                <tr>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" align="center"><button class="btn btn-sm btn-info copyButton">Copy

                                            URL <i class="fas fa-copy"></i></button></td>

                                </tr>

                            </table>

                        </div>



                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-sm btn-danger deleteButton" data-url="">Delete Permanently <i

                            class="fas fa-trash"></i></button>

                </div>

            </div>

            <!-- /.modal-content -->

        </div>

        <!-- /.modal-dialog -->

    </div>

    <!-- /.modal -->



    <script>

        // $("#files").change(function() {

        //     filename = this.files[0].name

        //     console.log(filename);

        // });



        // $("#uplodaButton").click(function() {

        //     $("#uploadDiv").slideToggle('slow');

        // });



        // $("#files").change(function() {

        //     $("#title").val(this.files[0].name);

        //     this.form.submit();

        // });



        $(window).on("scroll", function() {

            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {

                page++;

                infinteLoadMore(page);

            }

        });

        var ENDPOINT = "{{ url('/') }}";

        var page = 1;

        infinteLoadMore(page);



        function infinteLoadMore(page) {

            $.ajax({

                    url: ENDPOINT + "/admin/media?page=" + page,

                    datatype: "html",

                    type: "get",

                    beforeSend: function() {

                        $('#loaderImage').removeClass('hide');

                    }

                })

                .done(function(response) {

                    if (response.length == 0) {

                        $('.auto-load').html("<h4>No More Data To Display!</h4>");

                        $('#loaderImage').addClass('hide');

                        return;

                    }

                    $(".adminMediaRow").append(response).show('slow');

                    $('#loaderImage').addClass('hide');

                })

                .fail(function(jqXHR, ajaxOptions, thrownError) {

                    console.log('Server error occured');

                });

        }

        // LAZY LOADING END





        function abc(e) {

            let url = $(e).children('img').data('src');

            let date = $(e).children('#uploadDate').val();

            let title = $(e).children('#title').val();

            $("#fileUploadDate").text(date);

            $("#fileName").text(title);



            //get image dimension from url 

            let img = new Image();

            img.src = $(e).children('img').data('src');

            img.onload = function() {

                $("#fileDimension").text(this.width + 'px X ' + this.height + 'px');

            }

            // end



            // get image size and type from url

            var blob = null;

            var xhr = new XMLHttpRequest();

            xhr.open('GET', img.src, true);

            xhr.responseType = 'blob';

            xhr.onload = function() {

                blob = xhr.response;

                size = niceBytes(blob.size);

                type = blob.type;

                if (type == 'application/pdf') {

                    $('.modal-image').addClass('hide');

                    $('.modal-iframe').removeClass('hide');

                    $('#modalIframe').attr('src', url);

                } else {

                    $('.modal-iframe').addClass('hide');

                    $('.modal-image').removeClass('hide');

                    $('#modalImage').attr('src', url);

                }



                $("#fileSize").text(size);

                $("#fileType").text(type);



            }

            xhr.send();

            // end

            var id = $(e).children('#dbId').val();

            var deleteUrl = "{{ url('admin/deleteMedia/') }}/" + id;

            $('.urlInput').val(url);





            $('.deleteButton').attr('data-url', deleteUrl);



            $('#modal-xl').modal('show');

        }



        // convert bytes to kb,mb etc

        function niceBytes(x) {

            const units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

            let l = 0,

                n = parseInt(x, 10) || 0;

            while (n >= 1024 && ++l) {

                n = n / 1024;

            }

            return (n.toFixed(n < 10 && l > 0 ? 1 : 0) + ' ' + units[l]);

        }

        // end



        $(".deleteButton").click(function() {

            if (confirm('Are you sure you want to delete this file?')) {

                window.location.href = $(this).data("url");

            }

        });



        $(".copyButton").click(function() {

            var copyText = $(".urlInput");

            copyText.select();

            // copyText.setSelectionRange(0, 99999);

            document.execCommand("copy");

        });


        function multidelete() {

var ids = [];

$('input[type=checkbox]:checked').each(function(i, el) {

    var id = $(this).nextAll('.adminMedia').find(':input#dbId').val();

    if (id) {
        ids.push(id);
    }

});

console.log(ids);

if (ids.length === 0) {
    alert('Please select at least one media.');
    return;
}

$.ajax({

    url: "{{ url('admin/media-multitask-del') }}",

    type: 'GET',

    dataType: 'json',

    data: {
        ids: ids
    },

    success: function(data) {

        location.reload();

    },

    error: function(xhr) {

        console.log(xhr.responseText);

        if (xhr.status === 419) {
            alert('CSRF token mismatch. Please refresh the page and try again.');
        } else {
            alert('Something went wrong.');
        }

    }

});
}

    </script>
<style>

.multi-preview .file-item{
    border:1px solid #ddd;
    padding:10px;
    border-radius:5px;
    margin-bottom:10px;
}

</style>



<script>



// SHOW/HIDE UPLOAD BOX
$("#uplodaButton").click(function () {

    $("#uploadDiv").slideToggle('slow');

});






// FILE UPLOAD + COMPRESS
$("#files").change(async function () {

    let input = this;

    let files = Array.from(input.files);

    if (!files.length) return;

    let previewBox = $('.multi-preview');

    previewBox.html('');

    let finalFiles = [];

    for (let i = 0; i < files.length; i++) {

        let file = files[i];

        let originalSize = (
            file.size / 1024 / 1024
        ).toFixed(2);

        // FILE BOX
        let box = $(`
            <div class="file-item">

                <div>
                    <strong>${file.name}</strong>
                </div>

                <div class="progress mt-2"
                     style="height:22px;">

                    <div class="
                        progress-bar
                        progress-bar-striped
                        progress-bar-animated
                    "
                    style="width:0%">
                        0%
                    </div>

                </div>

                <small class="result-msg"></small>

            </div>
        `);

        previewBox.append(box);

        let progressBar = box.find(
            '.progress-bar'
        );

        let resultMsg = box.find(
            '.result-msg'
        );

        try {

            let finalFile = file;

            // IMAGE
            if (
                file.type.startsWith(
                    'image/'
                )
            ) {

                let extension =
                    file.name
                    .split('.')
                    .pop()
                    .toLowerCase();

                // TIFF NOT SUPPORTED
                if (
                    extension == 'tif' ||
                    extension == 'tiff'
                ) {

                    progressBar.css(
                        'width',
                        '100%'
                    );

                    progressBar
                        .removeClass(
                            'bg-success'
                        )
                        .addClass(
                            'bg-danger'
                        );

                    progressBar.text(
                        'ERROR'
                    );

                    resultMsg.html(`
                        <span class="text-danger">
                            TIFF not supported
                        </span>
                    `);

                    continue;
                }

                // COMPRESS IMAGE > 1MB
                if (
                    file.size >
                    1024 * 1024
                ) {

                    finalFile =
                        await compressImage(
                            file,
                            progressBar
                        );
                }

                else {

                    progressBar.css(
                        'width',
                        '100%'
                    );

                    progressBar.text(
                        '100%'
                    );
                }

            }

            // VIDEO
            else if (
                file.type.startsWith(
                    'video/'
                )
            ) {

                // COMPRESS VIDEO > 5MB
                if (
                    file.size >
                    5 *
                        1024 *
                        1024
                ) {

                    finalFile =
                        await compressVideo(
                            file,
                            progressBar
                        );
                }

                else {

                    progressBar.css(
                        'width',
                        '100%'
                    );

                    progressBar.text(
                        '100%'
                    );
                }

            }

            // OTHER FILES
            else {

                progressBar.css(
                    'width',
                    '100%'
                );

                progressBar.text(
                    '100%'
                );
            }

            finalFiles.push(
                finalFile
            );

            let finalSize = (
                finalFile.size /
                1024 /
                1024
            ).toFixed(2);

            resultMsg.html(`
                <span class="text-success">
                    Original:
                    ${originalSize} MB
                    |
                    Final:
                    ${finalSize} MB
                </span>
            `);

        } catch (e) {

            console.log(e);

            progressBar
                .removeClass(
                    'bg-success'
                )
                .addClass(
                    'bg-danger'
                );

            progressBar.css(
                'width',
                '100%'
            );

            progressBar.text(
                'FAILED'
            );

            resultMsg.html(`
                <span class="text-danger">
                    Compression failed
                </span>
            `);
        }

    }

    // UPDATE INPUT FILES
    let dataTransfer =
        new DataTransfer();

    finalFiles.forEach(file => {

        dataTransfer.items.add(
            file
        );

    });

    input.files =
        dataTransfer.files;

    // TITLE
    if (finalFiles.length > 0) {

        $("#title").val(
            finalFiles[0].name
        );
    }

    // AUTO SUBMIT
    input.form.submit();

});









// IMAGE COMPRESS FUNCTION
async function compressImage(
    file,
    progressBar
) {

    return new Promise((resolve, reject) => {

        let reader =
            new FileReader();

        reader.readAsDataURL(
            file
        );

        reader.onload =
            function (e) {

            let img =
                new Image();

            img.src =
                e.target.result;

            img.onload =
                async function () {

                let canvas =
                    document.createElement(
                        'canvas'
                    );

                let ctx =
                    canvas.getContext(
                        '2d'
                    );

                let width =
                    img.width;

                let height =
                    img.height;

                let maxWidth =
                    1600;

                // RESIZE
                if (
                    width >
                    maxWidth
                ) {

                    height =
                        height *
                        (
                            maxWidth /
                            width
                        );

                    width =
                        maxWidth;
                }

                canvas.width =
                    width;

                canvas.height =
                    height;

                ctx.fillStyle =
                    "#fff";

                ctx.fillRect(
                    0,
                    0,
                    width,
                    height
                );

                ctx.drawImage(
                    img,
                    0,
                    0,
                    width,
                    height
                );

                let quality =
                    0.9;

                let progress =
                    0;

                async function generateBlob() {

                    return new Promise(
                        (
                            res
                        ) => {

                            canvas.toBlob(
                                function (
                                    blob
                                ) {

                                    res(
                                        blob
                                    );

                                },
                                'image/jpeg',
                                quality
                            );

                        }
                    );

                }

                let blob =
                    await generateBlob();

                while (
                    blob.size >
                        1024 *
                            1024 &&
                    quality >
                        0.1
                ) {

                    quality -=
                        0.1;

                    progress +=
                        10;

                    progressBar.css(
                        'width',
                        progress +
                            '%'
                    );

                    progressBar.text(
                        progress +
                            '%'
                    );

                    blob =
                        await generateBlob();
                }

                progressBar.css(
                    'width',
                    '100%'
                );

                progressBar.text(
                    '100%'
                );

                resolve(
                    new File(
                        [blob],
                        file.name.replace(
                            /\.[^/.]+$/,
                            ".jpg"
                        ),
                        {
                            type:
                                'image/jpeg',
                            lastModified:
                                Date.now()
                        }
                    )
                );

            };

            img.onerror =
                function () {

                reject(
                    'Invalid image'
                );
            };

        };

        reader.onerror =
            function () {

            reject(
                'File read failed'
            );
        };

    });

}












// VIDEO COMPRESS FUNCTION
async function compressVideo(
    file,
    progressBar
) {

    return new Promise((resolve, reject) => {

        if (
            typeof MediaRecorder ===
            'undefined'
        ) {

            reject(
                'MediaRecorder not supported'
            );

            return;
        }

        let video =
            document.createElement(
                'video'
            );

        video.preload =
            'metadata';

        video.muted = true;

        video.src =
            URL.createObjectURL(
                file
            );

        video.onloadedmetadata =
            function () {

            let canvas =
                document.createElement(
                    'canvas'
                );

            let ctx =
                canvas.getContext(
                    '2d'
                );

            let width =
                video.videoWidth;

            let height =
                video.videoHeight;

            // REDUCE RESOLUTION
            let maxWidth =
                854;

            if (
                width >
                maxWidth
            ) {

                height =
                    height *
                    (
                        maxWidth /
                        width
                    );

                width =
                    maxWidth;
            }

            canvas.width =
                width;

            canvas.height =
                height;

            // LOWER FPS
            let stream =
                canvas.captureStream(
                    15
                );

            // LOWER BITRATE
            let recorder =
                new MediaRecorder(
                    stream,
                    {
                        mimeType:
                            'video/webm;codecs=vp8',

                        videoBitsPerSecond:
                            250000
                    }
                );

            let chunks = [];

            let duration =
                video.duration;

            recorder.ondataavailable =
                function (e) {

                if (
                    e.data.size >
                    0
                ) {

                    chunks.push(
                        e.data
                    );
                }
            };

            recorder.onstop =
                function () {

                let blob =
                    new Blob(
                        chunks,
                        {
                            type:
                                'video/webm'
                        }
                    );

                progressBar.css(
                    'width',
                    '100%'
                );

                progressBar.text(
                    '100%'
                );

                resolve(
                    new File(
                        [blob],
                        file.name.replace(
                            /\.[^/.]+$/,
                            ".webm"
                        ),
                        {
                            type:
                                'video/webm',
                            lastModified:
                                Date.now()
                        }
                    )
                );

            };

            recorder.start();

            video.play();

            function drawFrame() {

                if (
                    video.paused ||
                    video.ended
                ) {

                    recorder.stop();

                    return;
                }

                ctx.drawImage(
                    video,
                    0,
                    0,
                    width,
                    height
                );

                let progress =
                    Math.min(
                        99,
                        parseInt(
                            (
                                video.currentTime /
                                duration
                            ) * 100
                        )
                    );

                progressBar.css(
                    'width',
                    progress +
                        '%'
                );

                progressBar.text(
                    progress +
                        '%'
                );

                requestAnimationFrame(
                    drawFrame
                );
            }

            drawFrame();

        };

        video.onerror =
            function () {

            reject(
                'Video load failed'
            );
        };

    });

}

</script>
@endsection

