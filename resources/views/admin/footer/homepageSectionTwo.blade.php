<div class="card card-dark ">
    <div class="card-header">
        <h3 class="card-title">Section Two</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-4">
                <div>
                    <label for="oneIcon" class="col-form-label">Icon</label>
                    <div class="row imageSection">
                        <div class="col-md-3">
                            <label class="btn btn-sm btn-info" for="oneIcon">Upload
                                File</label>
                            <input id="oneIcon" name="oneIcon" type="file"
                                class="form-control hide image" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger error-text oneIcon_err"></span>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                id="oneIconId">Choose From
                                Gallery</button>
                            <input type="hidden" name="oneIconGallery"
                                class="imageGallery">
                        </div>
                        <div class="col-md-12 previewBox">
                            @if (isset($allData['oneIcon']))
                                <img src="{{ asset('storage/media/' . $allData['oneIcon']) }}"
                                    class="preview-image-before-upload" width="100px" />
                            @else
                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                    class="preview-image-before-upload" width="100px" />
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <label for="oneTitle" class="col-form-label">Title</label>
                    <input type="text" id="oneTitle" name="oneTitle" class="form-control" value="@if (!empty($allData) && isset($allData['oneTitle']) && $allData['oneTitle'] != ''){{ $allData['oneTitle'] }}@endif">
                </div>
                <div>
                    <label for="oneDescription" class="col-form-label">Description</label>
                    <input type="text" id="oneDescription" name="oneDescription" class="form-control" value="@if (!empty($allData) && isset($allData['oneDescription']) && $allData['oneDescription'] != ''){{ $allData['oneDescription'] }}@endif">
                </div>
            </div>
            <div class="col-sm-4">
                <div>
                    <label for="twoIcon" class="col-form-label">Icon</label>
                    <div class="row imageSection">
                        <div class="col-md-3">
                            <label class="btn btn-sm btn-info" for="twoIcon">Upload
                                File</label>
                            <input id="twoIcon" name="twoIcon" type="file"
                                class="form-control hide image" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger error-text twoIcon_err"></span>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                id="twoIconId">Choose From
                                Gallery</button>
                            <input type="hidden" name="twoIconGallery"
                                class="imageGallery">
                        </div>
                        <div class="col-md-12 previewBox">
                            @if (isset($allData['twoIcon']))
                                <img src="{{ asset('storage/media/' . $allData['twoIcon']) }}"
                                    class="preview-image-before-upload" width="100px" />
                            @else
                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                    class="preview-image-before-upload" width="100px" />
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <label for="twoTitle" class="col-form-label">Title</label>
                    <input type="text" id="twoTitle" name="twoTitle" class="form-control" value="@if (!empty($allData) && isset($allData['twoTitle']) && $allData['twoTitle'] != ''){{ $allData['twoTitle'] }}@endif">
                </div>
                <div>
                    <label for="twoDescription" class="col-form-label">Description</label>
                    <input type="text" id="twoDescription" name="twoDescription" class="form-control" value="@if (!empty($allData) && isset($allData['twoDescription']) && $allData['twoDescription'] != ''){{ $allData['twoDescription'] }}@endif">
                </div>
            </div>
            <div class="col-sm-4">
                <div>
                    <label for="threeIcon" class="col-form-label">Icon</label>
                    <div class="row imageSection">
                        <div class="col-md-3">
                            <label class="btn btn-sm btn-info" for="threeIcon">Upload
                                File</label>
                            <input id="threeIcon" name="threeIcon" type="file"
                                class="form-control hide image" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger error-text threeIcon_err"></span>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                id="threeIconId">Choose From
                                Gallery</button>
                            <input type="hidden" name="threeIconGallery"
                                class="imageGallery">
                        </div>
                        <div class="col-md-12 previewBox">
                            @if (isset($allData['threeIcon']))
                                <img src="{{ asset('storage/media/' . $allData['threeIcon']) }}"
                                    class="preview-image-before-upload" width="100px" />
                            @else
                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                    class="preview-image-before-upload" width="100px" />
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <label for="threeTitle" class="col-form-label">Title</label>
                    <input type="text" id="threeTitle" name="threeTitle" class="form-control" value="@if (!empty($allData) && isset($allData['threeTitle']) && $allData['threeTitle'] != ''){{ $allData['threeTitle'] }}@endif">
                </div>
                <div>
                    <label for="threeDescription" class="col-form-label">Description</label>
                    <input type="text" id="threeDescription" name="threeDescription" class="form-control" value="@if (!empty($allData) && isset($allData['threeDescription']) && $allData['threeDescription'] != ''){{ $allData['threeDescription'] }}@endif">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                <div>
                    <label for="fourIcon" class="col-form-label">Icon</label>
                    <div class="row imageSection">
                        <div class="col-md-3">
                            <label class="btn btn-sm btn-info" for="fourIcon">Upload
                                File</label>
                            <input id="fourIcon" name="fourIcon" type="file"
                                class="form-control hide image" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger error-text fourIcon_err"></span>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                id="fourIconId">Choose From
                                Gallery</button>
                            <input type="hidden" name="fourIconGallery"
                                class="imageGallery">
                        </div>
                        <div class="col-md-12 previewBox">
                            @if (isset($allData['fourIcon']))
                                <img src="{{ asset('storage/media/' . $allData['fourIcon']) }}"
                                    class="preview-image-before-upload" width="100px" />
                            @else
                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                    class="preview-image-before-upload" width="100px" />
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <label for="fourTitle" class="col-form-label">Title</label>
                    <input type="text" id="fourTitle" name="fourTitle" class="form-control" value="@if (!empty($allData) && isset($allData['fourTitle']) && $allData['fourTitle'] != ''){{ $allData['fourTitle'] }}@endif">
                </div>
                <div>
                    <label for="fourDescription" class="col-form-label">Description</label>
                    <input type="text" id="fourDescription" name="fourDescription" class="form-control" value="@if (!empty($allData) && isset($allData['fourDescription']) && $allData['fourDescription'] != ''){{ $allData['fourDescription'] }}@endif">
                </div>
            </div>
            <div class="col-sm-4">
                <div>
                    <label for="fiveIcon" class="col-form-label">Icon</label>
                    <div class="row imageSection">
                        <div class="col-md-3">
                            <label class="btn btn-sm btn-info" for="fiveIcon">Upload
                                File</label>
                            <input id="fiveIcon" name="fiveIcon" type="file"
                                class="form-control hide image" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger error-text fiveIcon_err"></span>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                id="fiveIconId">Choose From
                                Gallery</button>
                            <input type="hidden" name="fiveIconGallery"
                                class="imageGallery">
                        </div>
                        <div class="col-md-12 previewBox">
                            @if (isset($allData['fiveIcon']))
                                <img src="{{ asset('storage/media/' . $allData['fiveIcon']) }}"
                                    class="preview-image-before-upload" width="100px" />
                            @else
                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                    class="preview-image-before-upload" width="100px" />
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <label for="fiveTitle" class="col-form-label">Title</label>
                    <input type="text" id="fiveTitle" name="fiveTitle" class="form-control" value="@if (!empty($allData) && isset($allData['fiveTitle']) && $allData['fiveTitle'] != ''){{ $allData['fiveTitle'] }}@endif">
                </div>
                <div>
                    <label for="fiveDescription" class="col-form-label">Description</label>
                    <input type="text" id="fiveDescription" name="fiveDescription" class="form-control" value="@if (!empty($allData) && isset($allData['fiveDescription']) && $allData['fiveDescription'] != ''){{ $allData['fiveDescription'] }}@endif">
                </div>
            </div>
            <div class="col-sm-4">
                <div>
                    <label for="sixIcon" class="col-form-label">Icon</label>
                    <div class="row imageSection">
                        <div class="col-md-3">
                            <label class="btn btn-sm btn-info" for="sixIcon">Upload
                                File</label>
                            <input id="sixIcon" name="sixIcon" type="file"
                                class="form-control hide image" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger error-text sixIcon_err"></span>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-sm btn-info chooseFile image"
                                id="sixIconId">Choose From
                                Gallery</button>
                            <input type="hidden" name="sixIconGallery"
                                class="imageGallery">
                        </div>
                        <div class="col-md-12 previewBox">
                            @if (isset($allData['sixIcon']))
                                <img src="{{ asset('storage/media/' . $allData['sixIcon']) }}"
                                    class="preview-image-before-upload" width="100px" />
                            @else
                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                    class="preview-image-before-upload" width="100px" />
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <label for="sixTitle" class="col-form-label">Title</label>
                    <input type="text" id="sixTitle" name="sixTitle" class="form-control" value="@if (!empty($allData) && isset($allData['sixTitle']) && $allData['sixTitle'] != ''){{ $allData['sixTitle'] }}@endif">
                </div>
                <div>
                    <label for="sixDescription" class="col-form-label">Description</label>
                    <input type="text" id="sixDescription" name="sixDescription" class="form-control" value="@if (!empty($allData) && isset($allData['sixDescription']) && $allData['sixDescription'] != ''){{ $allData['sixDescription'] }}@endif">
                </div>
            </div>
        </div>
    </div>
</div>
