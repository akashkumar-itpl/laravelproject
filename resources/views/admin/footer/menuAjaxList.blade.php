@foreach ($MenuData as $index => $MenuData)
    <li class='route ui-sortable-handle'>
        <h5 class='title' id='title{{ $MenuData['id'] }}'>{{ $MenuData['menuName'] }}
            <small>({{ $MenuData['menytype'] }})</small></h5>
        <input type="hidden" class="menuIndex" name="menu[{{ $menuIndex }}][menuIndex]" value="{{ $menuIndex }}">

        <input type="hidden" class="menuid" name="menu[{{ $menuIndex }}][menuid]" value="{{ $MenuData['id'] }}">

        <input type="hidden" class="parent_id" name="menu[{{ $menuIndex }}][parent_id]" value="0">

        <input type="hidden" class="menuslug" name="menu[{{ $menuIndex }}][menuslug]"
            value="{{ $MenuData['menuslug'] }}">
        <input type="hidden" class="menytype" name="menu[{{ $menuIndex }}][menytype]"
            value="{{ $MenuData['menytype'] }}">
        <input type="hidden" class="menuName" name="menu[{{ $menuIndex }}][menuName]"
            value="{{ $MenuData['menuName'] }}">



        <span class='fas fa-expand-arrows-alt'></span>
        <p class='fa fa-angle-down float-right dropButton' style="position: absolute;"></p>

        <div id="demo{{ $MenuData['id'] }}" class="bilus" style="display: none;width:400px">
            <div class="dormpod">
                <div class="row">
                    <div class="col-md-12"><label>Navigation Label</label>
                        <input type="text" class="form-control" name="menu[{{ $menuIndex }}][NavigationLabel]"
                            value="{{ $MenuData['menuName'] }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>CSS Classes</label>
                        <input type="text" class="form-control" name="menu[{{ $menuIndex }}][CSSClasses]" />
                    </div>
                    <div class="col-md-8">
                        <label>Description</label>
                        <textarea class="form-control" name="menu[{{ $menuIndex }}][Description]"></textarea>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">

                        <label for="categoryName" class="col-form-label">Add Image/icon</label>
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <label class="btn btn-sm btn-info" for="image">Upload File</label> --}}
                                <input id="image" name="image[{{ $menuIndex }}]" type="file"
                                    class="form-control">
                                <span class="text-danger error-text image_err"></span>
                            </div>
                            {{-- <div class="col-md-5">
                                <button type="button" class="btn btn-sm btn-info chooseFile">Choose From Gallery</button>
                                <input type="hidden" name="menu[{{$menuIndex}}][imageGallery]" id="imageGallery">  
                            </div> --}}

                            <div class="col-md-3">
                                {{-- @if (isset($allData['thumbnail']))
                                    <a href="{{ asset('storage/media/' . $allData['thumbnail']) }}" target="_blank">
                                        <img width="60px" height="60px"
                                            src="{{ asset('storage/media/' . $allData['thumbnail']) }}" />
                                    </a>
                                @endif --}}
                                <img width="60px" height="60px"
                                    src="{{ asset('storage/media/admin/itpl-placeholder.png') }}"
                                    id="preview-thumbnail-image-before-upload" />
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input type="checkbox" name="menu[{{ $menuIndex }}]['OpenLink']" value="1" />
                        <label>Open link in a new tab</label>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-danger btn-sm btn-badge remove">Remove</a> &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-default btn-sm btn-badge cancel">Cancel</a>

                    </div>

                </div>


            </div>
        </div>

        <ul class='space' id='space{{ $MenuData['id'] }}'>

        </ul>

    </li>
    @php
        $menuIndex++;
    @endphp
@endforeach

<script>
    $(document).ready(function() {


        calcWidth($('#title0'));

        window.onresize = function(event) {
            console.log("window resized");

            //method to execute one time after a timer

        };

        //recursively calculate the Width all titles
        function calcWidth(obj) {
            console.log('---- calcWidth -----');

            var titles =
                $(obj).siblings('.space').children('.route').children('.title');




            $(titles).each(function(index, element) {
                var pTitleWidth = parseInt($(obj).css('width'));
                var leftOffset = parseInt($(obj).siblings('.space').css('margin-left'));

                var newWidth = pTitleWidth - leftOffset;



                if ($(obj).attr('id') == 'title0') {
                    console.log("called");

                    newWidth = newWidth - 10;
                }
                let pwidth = newWidth - 20;
                $(this).siblings('p').css('left', pwidth + 'px');

                $(element).css({
                    'width': newWidth,
                })

                calcWidth(element);
            });

        }




        $('.space').sortable({

            connectWith: '.space',
            // handle:'.title',
            // placeholder: ....,
            tolerance: 'intersect',
            create: function(event, ui) {
                calcWidth($(this).siblings('.title'));
            },
            over: function(event, ui) {

                // //Recaculate width of all children
                // var pTitleWidth = parseInt($(this).siblings('.title').css('width').replace('px', ''));

                // if ($(this).siblings('.title').attr('id') == 'title0'){
                // 	var newWidth = (pTitleWidth-20).toString().concat('px');
                // }
                // else {
                // 	var newWidth = (pTitleWidth-70).toString().concat('px');
                // }

                // console.log(pTitleWidth + ', ' + newWidth);

                // $(ui.item).children('.title').css({
                // 	'width': newWidth,
                // });
            },
            update: function(event, ui) {

                console.clear();
                //console.log($(this).parent('.ui-sortable-handle').children('.menuid').val());

                //	let parentmenuid = $(this).parent('.ui-sortable-handle').children('.menuid').val();

                let parentmenuid = $(this).parent('.ui-sortable-handle').children('.menuIndex')
                .val();



                //console.log()

                if (parentmenuid == undefined) {
                    $(ui.item).children('.parent_id').val(0);
                } else {
                    $(ui.item).children('.parent_id').val(parentmenuid);

                }

            },
            receive: function(event, ui) {

                calcWidth($(this).siblings('.title'));
            },
        });

        $('.space').disableSelection();

        $(".title").each(function() {
            calcWidth(this);
        });
    });
</script>
