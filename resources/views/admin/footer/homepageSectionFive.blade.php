<div class="card card-dark ">
    <div class="card-header">
        <h3 class="card-title">Section Five</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="sectionFiveTitle" class="col-form-label">Section Title</label>
                <input class="form-control" type="text" name="sectionFiveTitle" id="sectionFiveTitle" value="@if (!empty($allData) && isset($allData['sectionFiveTitle']) && $allData['sectionFiveTitle'] != '')
                {{ $allData['sectionFiveTitle'] }}
                @endif">
                <label for="sectionFiveDescription" class="col-form-label">Section Description</label>
                <textarea name="sectionFiveDescription" id="sectionFiveDescription" class="summernote form-control" aria-required="true"
                    aria-invalid="false">
                    @if (!empty($allData) && isset($allData['sectionFiveDescription']) && $allData['sectionFiveDescription'] != '')
                    {{ $allData['sectionFiveDescription'] }}
                    @endif
                </textarea>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <label for="sectionFiveImageOne" class="col-form-label">Image One</label>
                        <div class="row imageSection">
                            <div class="col-md-3">
                                <label class="btn btn-sm btn-info" for="sectionFiveImageOne">Upload
                                    File</label>
                                <input id="sectionFiveImageOne" name="sectionFiveImageOne" type="file"
                                    class="form-control hide image" aria-required="true"
                                    aria-invalid="false">
                                <span class="text-danger error-text sectionFiveImageOne_err"></span>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-sm btn-info chooseFile image"
                                    id="sectionFiveImageOneId">Choose From
                                    Gallery</button>
                                <input type="hidden" name="sectionFiveImageOneGallery"
                                    class="imageGallery">
                            </div>

                            <div class="col-md-12 previewBox">
                                @if (isset($allData['sectionFiveImageOne']))
                                    <img src="{{ asset('storage/media/' . $allData['sectionFiveImageOne']) }}"
                                        class="preview-image-before-upload" width="100px" />
                                @else
                                    <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                        class="preview-image-before-upload" width="100px" />
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="sectionFiveImageOneDescription" class="col-form-label">Image One Description</label>
                        <textarea name="sectionFiveImageOneDescription" id="sectionFiveImageOneDescription" class="summernote form-control" aria-required="true"
                            aria-invalid="false">
                            @if (!empty($allData) && isset($allData['sectionFiveImageOneDescription']) && $allData['sectionFiveImageOneDescription'] != '')
                            {{ $allData['sectionFiveImageOneDescription'] }}
                            @endif
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <label for="sectionFiveImageTwo" class="col-form-label">Image Two</label>
                        <div class="row imageSection">
                            <div class="col-md-3">
                                <label class="btn btn-sm btn-info" for="sectionFiveImageTwo">Upload
                                    File</label>
                                <input id="sectionFiveImageTwo" name="sectionFiveImageTwo" type="file"
                                    class="form-control hide image" aria-required="true"
                                    aria-invalid="false">
                                <span class="text-danger error-text sectionFiveImageTwo_err"></span>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-sm btn-info chooseFile image"
                                    id="sectionFiveImageTwoId">Choose From
                                    Gallery</button>
                                <input type="hidden" name="sectionFiveImageTwoGallery"
                                    class="imageGallery">
                            </div>

                            <div class="col-md-12 previewBox">
                                @if (isset($allData['sectionFiveImageTwo']))
                                    <img src="{{ asset('storage/media/' . $allData['sectionFiveImageTwo']) }}"
                                        class="preview-image-before-upload" width="100px" />
                                @else
                                    <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                        class="preview-image-before-upload" width="100px" />
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="sectionFiveImageTwoDescription" class="col-form-label">Image Two Description</label>
                        <textarea name="sectionFiveImageTwoDescription" id="sectionFiveImageTwoDescription" class="summernote form-control" aria-required="true"
                            aria-invalid="false">
                            @if (!empty($allData) && isset($allData['sectionFiveImageTwoDescription']) && $allData['sectionFiveImageTwoDescription'] != '')
                            {{ $allData['sectionFiveImageTwoDescription'] }}
                            @endif
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <label for="sectionFiveImageThree" class="col-form-label">Image Three</label>
                        <div class="row imageSection">
                            <div class="col-md-3">
                                <label class="btn btn-sm btn-info" for="sectionFiveImageThree">Upload
                                    File</label>
                                <input id="sectionFiveImageThree" name="sectionFiveImageThree" type="file"
                                    class="form-control hide image" aria-required="true"
                                    aria-invalid="false">
                                <span class="text-danger error-text sectionFiveImageThree_err"></span>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-sm btn-info chooseFile image"
                                    id="sectionFiveImageThreeId">Choose From
                                    Gallery</button>
                                <input type="hidden" name="sectionFiveImageThreeGallery"
                                    class="imageGallery">
                            </div>

                            <div class="col-md-12 previewBox">
                                @if (isset($allData['sectionFiveImageThree']))
                                    <img src="{{ asset('storage/media/' . $allData['sectionFiveImageThree']) }}"
                                        class="preview-image-before-upload" width="100px" />
                                @else
                                    <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                        class="preview-image-before-upload" width="100px" />
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="sectionFiveImageThreeDescription" class="col-form-label">Image Three Description</label>
                        <textarea name="sectionFiveImageThreeDescription" id="sectionFiveImageThreeDescription" class="summernote form-control" aria-required="true"
                            aria-invalid="false">
                            @if (!empty($allData) && isset($allData['sectionFiveImageThreeDescription']) && $allData['sectionFiveImageThreeDescription'] != '')
                            {{ $allData['sectionFiveImageThreeDescription'] }}
                            @endif
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
