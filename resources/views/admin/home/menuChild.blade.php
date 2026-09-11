@foreach ($childs as $index => $child)
    @php
        $menuIndex = $child->sortorder;
    @endphp
    <li class='route'>
        <h5 class='title' id='title{{ $child->id }}'> {{ $child->menuName }}
            <small>({{ $child->menytype }})</small></h5>
        <input type="hidden" class="menuid" name="menu[{{ $menuIndex }}][menuid]" value="{{ $child->id }}">

        <input type="hidden" class="menuIndex" name="menu[{{ $menuIndex }}][menuIndex]"
            value="{{ $child->sortorder }}">

        <input type="hidden" class="parent_id" name="menu[{{ $menuIndex }}][parent_id]"
            value="{{ $child->parent_id }}">

        <input type="hidden" class="menuslug" name="menu[{{ $menuIndex }}][menuslug]"
            value="{{ $child->menuslug }}">
        <input type="hidden" class="menytype" name="menu[{{ $menuIndex }}][menytype]"
            value="{{ $child->menytype }}">
        <input type="hidden" class="menuName" name="menu[{{ $menuIndex }}][menuName]"
            value="{{ $child->menuName }}">

        <span class='fas fa-expand-arrows-alt'></span>
        <p class='fa fa-angle-down float-right dropButton' style="position: absolute;left:700px"></p>

        {{-- <span class='fa fa-angle-down' ></span> --}}

        <div id="demo{{ $MenuData->id }}" class="bilus" style="display: none;width:400px">
            <div class="dormpod">
                <div class="row">
                    <div class="col-md-12"><label>Navigation
                            Label</label>
                        <input type="text" class="form-control" name="menu[{{ $menuIndex }}][NavigationLabel]"
                            value="{{ $child->NavigationLabel }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>CSS Classes</label>
                        <input type="text" value="{{ $child->CSSClasses }}" class="form-control"
                            name="menu[{{ $menuIndex }}][CSSClasses]" />
                    </div>
                    <div class="col-md-8">
                        <label>Description</label>
                        <textarea class="form-control" name="menu[{{ $menuIndex }}][Description]">{{ $child->Description }}</textarea>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">

                        <label for="categoryName" class="col-form-label">Add Image/icon</label>
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <label class="btn btn-sm btn-info" for="thumbnail">Upload File</label> --}}

                                <input id="image" name="image[{{ $menuIndex }}]" type="file" class="form-control"
                                    multiple>
                                <span class="text-danger error-text thumbnail_err"></span>
                            </div>
                            {{-- <div class="col-md-5">
    <button type="button" class="btn btn-sm btn-info chooseFile">Choose From Gallery</button>
    <input type="hidden" name="menu[{{$menuIndex}}][imageGallery]" id="imageGallery">
</div> --}}

                            <div class="col-md-3">
                                @if (isset($child->Image))
                                    <a href="{{ asset('storage/media/' . $child->Image) }}" target="_blank">
                                        <img width="60px" height="60px"
                                            src="{{ asset('storage/media/' . $child->Image) }}" />
                                    </a>
                                @endif
                                {{-- <img width="60px" height="60px" src="{{ asset('storage/media/admin/itpl-placeholder.png') }}"
        id="preview-thumbnail-image-before-upload" /> --}}
                            </div>
                        </div>


                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input type="checkbox" name="menu[{{ $menuIndex }}][OpenLink]" value="1" />
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

        <ul class='space' id='space{{ $child->id }}'>
            @if (count($child->childs))
                @include('admin.home.menuChild', ['childs' => $child->childs])
            @endif
        </ul>
    </li>
@endforeach
