<div class="productCategory">
    <h5>Add New Banner</h5>
    <hr>
    <form action="{{ route('admin.add-homebanner-form') }}" class="form-horizontal" name="ApplyOnlineForm" id="adminForm"
        method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <div class="col-sm-12">
                <label for="title" class="col-form-label">Select Page</label>
                <select name="menu_id" id="menu_id"
                    class="form-control @error('menu_id') is-invalid @enderror">
                    <option value="">Select Page </option>
                    @foreach ($menu as $key => $val)
                            <option value="{{ $val->id }}">{{ $val->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="title" class="col-form-label">Banner Title*</label>
                <input id="title" value="{{ old('title', $title) }}" name="title" type="text"
                    class="form-control">
                <span class="text-danger error-text title_err"></span>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <label for="bannerImage" class="col-form-label">Desktop Banner Image* <small>( 1280*500
                        )</small></label>
                {{-- Image Section Start --}}
                <div class="row imageSection">
                    <div class="col-md-4">
                        <label class="btn btn-sm btn-info" for="bannerImage">Upload File</label>
                        <input id="bannerImage" name="bannerImage" type="file" class="form-control hide image"
                            aria-required="true" aria-invalid="false">

                    </div>
                    <div class="col-md-8">
                        <button type="button" class="btn btn-sm btn-info chooseFile image" id="bannerImageId">Choose
                            From
                            Gallery</button>
                        <input type="hidden" name="bannerImageGallery" class="bannerImageGallery">
                    </div>

                    <div class="col-md-12 previewBox">
                        @if (isset($allData['bannerImage']))
                            <img src="{{ asset('storage/media/' . $allData['bannerImage']) }}"
                                class="preview-image-before-upload image" width="100px" />
                        @else
                            <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                class="preview-image-before-upload image" width="100px" />
                        @endif
                    </div>
                </div>
                <span class="text-danger error-text bannerImage_err"></span>
                {{-- Image Section END --}}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <label for="mobImage" class="col-form-label">Mobile Banner Image <small>( 400*500 )</small></label>
                {{-- Image Section Start --}}
                <div class="row imageSection">
                    <div class="col-md-4">
                        <label class="btn btn-sm btn-info" for="mobImage">Upload File</label>
                        <input id="mobImage" name="mobImage" type="file" class="form-control hide image"
                            aria-required="true" aria-invalid="false">
                        <span class="text-danger error-text mobImage_err"></span>
                    </div>
                    <div class="col-md-8">
                        <button type="button" class="btn btn-sm btn-info chooseFile image" id="mobImageId">Choose
                            From
                            Gallery</button>
                        <input type="hidden" name="mobImageGallery" class="mobImageGallery">
                    </div>

                    <div class="col-md-12 previewBox">
                        @if (isset($allData['mobImage']))
                            <img src="{{ asset('storage/media/' . $allData['mobImage']) }}"
                                class="preview-image-before-upload image" width="100px" />
                        @else
                            <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                class="preview-image-before-upload image" width="100px" />
                        @endif
                    </div>
                </div>
                {{-- Image Section END --}}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <label for="content" class="col-form-label">Content Over Banner</label>
                <textarea id="content" name="content" type="text"
                    class="summernote form-control @error('content') is-invalid @enderror">{{ old('content', $content) }}</textarea>
                <span class="text-danger error-text content_err"></span>
            </div>
        </div>

        {{-- <div class="form-group row">
            <div class="col-sm-12">
                <label for="redirectUrl" class="col-form-label">Redirect To</label>
                <input id="redirectUrl" value="{{ old('redirectUrl', $redirectUrl) }}" name="redirectUrl"
                    type="text" class="form-control">
                <span class="text-danger error-text redirectUrl_err"></span>
            </div>
        </div> --}}


        <div class="form-group row">
            <div class="col-sm-12">
                <label for="sortOrder" class="col-form-label">Display Order</label>
                <input id="sortOrder" value="{{ old('sortOrder', $sortOrder) }}" name="sortOrder" type="number"
                    class="form-control">
                <span class="text-danger error-text sortOrder_err"></span>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                        class="fa fa-check"></i></button>
            </div>
        </div>


    </form>
</div>
