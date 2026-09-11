@extends('admin/layout')
@section('page_title','Manage MediaGallery')
@section('info','Manage MediaGallery.')
@section('Appearance','menu-open')
@section('media','active')
@section('container')


<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-size: 1.6em">@yield('page_title') <sup><a href="#" data-toggle="tooltip" data-placement="top" title="@yield('info')"><i class="fa fa-info-circle"></i></a></sup></h3>
      <div class="card-tools">
        <a href="javascript:void(0)" id="uplodaButton" class="btn btn-success badge">Upload <small><i class="right fas fa-plus"></i></small></a>
        
     
    </div>
     
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row" id="uploadDiv">
            <div class="col-md-12">
                <form class="box " method="post" action="{{route('admin.add-media-gallery-form')}}" enctype="multipart/form-data">
                    @csrf
                    <label for="files" class="btn btn-info">Select File & Upload &nbsp;<i class="fas fa-upload"></i></label>
                    <input id="files" style="visibility:hidden;" type="file" name="media">
                    <input id="title"  type="hidden" name="title">
                    <input type="submit" style="visibility: hidden">
                  </form>
            </div>

        </div>
      <div class="row adminMediaGalleryRow">
       
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
                <img  id="modalImage" src=""  />
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
                        <td colspan="2">File URL : <input type="text"  readonly class="urlInput" /></td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <td colspan="2" align="center"><button class="btn btn-sm btn-info copyButton">Copy URL <i class="fas fa-copy"></i></button></td>
                    </tr>
                </table>
              </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-sm btn-danger deleteButton" data-url="">Delete Permanently <i class="fas fa-trash"></i></button>
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

    $("#uplodaButton").click(function(){
        $("#uploadDiv").slideToggle('slow');
    });

    $("#files").change(function(){
        $("#title").val(this.files[0].name);
        this.form.submit();
    });

    $(window).on("scroll",function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });
        var ENDPOINT                = "{{ url('/') }}";
        var page                    = 1;
        infinteLoadMore(page);

        function infinteLoadMore(page) {
            $.ajax({
                url: ENDPOINT + "/admin/media-gallery?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() { $('#loaderImage').removeClass('hide'); }
                })
                .done(function (response) {
                    if (response.length == 0 ) {
                        $('.auto-load').html("<h4>No More Data To Display!</h4>");
                        $('#loaderImage').addClass('hide');
                            return;
                    }
                    $(".adminMediaGalleryRow").append(response).show('slow');
                    $('#loaderImage').addClass('hide');
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
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
        let img=new Image();
        img.src=$(e).children('img').data('src');
        img.onload = function() {
            $("#fileDimension").text(this.width+'px X '+this.height+'px');
        }
        // end

        // get image size and type from url
        var blob = null;
        var xhr = new XMLHttpRequest(); 
        xhr.open('GET', img.src, true); 
        xhr.responseType = 'blob';
        xhr.onload = function() 
        {
            blob = xhr.response;
            size = niceBytes(blob.size);
            type=blob.type;
            if(type=='application/pdf'){
                $('.modal-image').addClass('hide');
                $('.modal-iframe').removeClass('hide');
                $('#modalIframe').attr('src',url);
            }
            else{
                $('.modal-iframe').addClass('hide');
                $('.modal-image').removeClass('hide');
                $('#modalImage').attr('src',url);
            }

            $("#fileSize").text(size);
            $("#fileType").text(type);

        }
        xhr.send();
        // end
        var id = $(e).children('#dbId').val();
        var deleteUrl = "{{url('admin/deleteMediaGallery/')}}/"+id;
        $('.urlInput').val(url);
        
        
        $('.deleteButton').attr('data-url',deleteUrl);
        
        $('#modal-xl').modal('show');
    }

    // convert bytes to kb,mb etc
    function niceBytes(x){
        const units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        let l = 0, n = parseInt(x, 10) || 0;
        while(n >= 1024 && ++l){
            n = n/1024;
        }
        return(n.toFixed(n < 10 && l > 0 ? 1 : 0) + ' ' + units[l]);
    }
    // end

    $(".deleteButton").click(function(){
        if (confirm('Are you sure you want to delete this file?')) {
            window.location.href = $(this).data("url");
        } 
    });

    $(".copyButton").click(function(){
        var copyText = $(".urlInput");
        copyText.select();
        // copyText.setSelectionRange(0, 99999);
        document.execCommand("copy"); 
    });
    
    
</script>
@endsection