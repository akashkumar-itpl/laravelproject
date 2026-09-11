<div class="card card-dark ">
    <div class="card-header">
        <h3 class="card-title">SEO</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active" id="vert-tabs-seo-general-tab" data-toggle="pill"
                        href="#vert-tabs-seo-general" role="tab" aria-controls="vert-tabs-seo-general"
                        aria-selected="true"><i class="fa fa-adjust"></i>
                        SEO <i class="text-danger error-icon"></i></a>

                    {{-- <a class="nav-link" id="vert-tabs-social-tab" data-toggle="pill" href="#vert-tabs-social"
                        role="tab" aria-controls="vert-tabs-social" aria-selected="false"><i
                            class="fa fa-share-alt"></i>
                        Social <i class="text-danger error-icon"></i></a> --}}
                </div>
            </div>

            <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                    <div class="tab-pane text-left fade show active" id="vert-tabs-seo-general" role="tabpanel"
                        aria-labelledby="vert-tabs-seo-general-tab">
                        <div class="form-group row">
                            <label for="metaTitle" class="col-sm-4 col-form-label">Meta
                                Title</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input id="metaTitle"
                                        value="@if (!empty($allData) && isset($allData['metaTitle']) && $allData['metaTitle'] != '') {{ $allData['metaTitle'] }} @endif"
                                        placeholder="Meta Title" name="metaTitle" type="text" class="form-control">
                                </div>
                                <span class="text-danger error-text metaTitle_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="metaKeywords" class="col-sm-4 col-form-label">Meta
                                Keywords</label>
                            <div class="col-sm-8">
                                <input id="metaKeywords"
                                    value="@if (!empty($allData) && isset($allData['metaKeywords']) && $allData['metaKeywords'] != '') {{ $allData['metaKeywords'] }} @endif"
                                    placeholder="Meta Keywords" name="metaKeywords" type="text" class="form-control">
                                <span class="text-danger error-text metaKeywords_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="metaDescription" class="col-sm-4 col-form-label">Meta
                                Description</label>
                            <div class="col-sm-8">
                                <textarea id="metaDescription" placeholder="Meta Description" name="metaDescription" class="form-control"> @if (!empty($allData) && isset($allData['metaDescription']) && $allData['metaDescription'] != '') {{ $allData['metaDescription'] }} @endif </textarea>
                                <span class="text-danger error-text metaDescription_err"></span>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="canonicalUrl" class="col-sm-4 col-form-label">Canonical
                                URL</label>
                            <div class="col-sm-8">
                                <input id="canonicalUrl"
                                    value="@if (!empty($allData) && isset($allData['canonicalUrl']) && $allData['canonicalUrl'] != '') {{ $allData['canonicalUrl'] }} @endif"
                                    placeholder="Canonical URL" name="canonicalUrl" type="text" class="form-control">
                                <span class="text-danger error-text canonicalUrl_err"></span>
                            </div>

                        </div>



                    </div>

                    <div class="tab-pane fade" id="vert-tabs-social" role="tabpanel"
                        aria-labelledby="vert-tabs-social-tab">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" style="background: #5c5c5c">
                                        <h3 class="card-title" style="color: #fff"><i class="fa fa-facebook"></i>
                                            Facebook Preview</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="itemRegularPrice" class="col-sm-12 col-form-label">Facebook
                                                Image</label>
                                            <div class="col-sm-12">
                                                {{-- Image Section Start --}}
                                                <div class="row imageSection">
                                                    <div class="col-md-3">
                                                        <label class="btn btn-sm btn-info"
                                                            for="facebookImage">Upload</label>
                                                        <input id="facebookImage" name="facebookImage" type="file"
                                                            class="form-control hide image" aria-required="true"
                                                            aria-invalid="false"
                                                            accept="image/jpeg, image/png, image/gif,">
                                                        <span class="text-danger error-text image_err"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button"
                                                            class="btn btn-sm btn-info chooseFile image"
                                                            id="facebookImageId" style="white-space: nowrap">Choose
                                                            From
                                                            Gallery</button>
                                                        <input type="hidden" name="facebookImageGallery"
                                                            class="facebookImageGallery">
                                                    </div>

                                                    <div class="col-md-3 previewBox">
                                                        @if (!empty($allData) && isset($allData['facebookImage']) && $allData['facebookImage'] != '')
                                                            <img src="{{ asset('storage/media/' . $allData['facebookImage']) }}"
                                                                class="preview-image-before-upload image"
                                                                width="100%" />
                                                        @else
                                                            <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                                                class="preview-image-before-upload image"
                                                                width="100%" />
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- Image Section END --}}
                                            </div>
                                            <span class="text-danger error-text facebookImage_err"></span>
                                        </div>

                                        <div class="form-group row">
                                            <label for="facebookTitle" class="col-sm-12 col-form-label">Facebook
                                                Title</label>
                                            <div class="col-sm-12">
                                                <input id="facebookTitle"
                                                    value="@if (!empty($allData) && isset($allData['facebookTitle']) && $allData['facebookTitle'] != '') {{ $allData['facebookTitle'] }} @endif"
                                                    placeholder="Facebook Title" name="facebookTitle" type="text"
                                                    class="form-control">
                                            </div>
                                            <span class="text-danger error-text facebookTitle_err"></span>
                                        </div>

                                        <div class="form-group row">
                                            <label for="facebookDescription" class="col-sm-12 col-form-label">Facebook
                                                Description</label>
                                            <div class="col-sm-12">
                                                <textarea id="facebookDescription" placeholder="Facebook Description" name="facebookDescription" class="form-control"> @if (!empty($allData) && isset($allData['facebookDescription']) && $allData['facebookDescription'] != '') {{ $allData['facebookDescription'] }} @endif </textarea>
                                            </div>
                                            <span class="text-danger error-text facebookDescription_err"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" style="background: #5c5c5c">
                                        <h3 class="card-title" style="color: #fff"><i class="fa fa-twitter"></i>
                                            Twitter Preview</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="itemRegularPrice" class="col-sm-12 col-form-label">Twitter
                                                Image</label>
                                            <div class="col-sm-12">
                                                {{-- Image Section Start --}}
                                                <div class="row imageSection">
                                                    <div class="col-md-3">
                                                        <label class="btn btn-sm btn-info"
                                                            for="twitterImage">Upload</label>
                                                        <input id="twitterImage" name="twitterImage" type="file"
                                                            class="form-control hide image" aria-required="true"
                                                            aria-invalid="false"
                                                            accept="image/jpeg, image/png, image/gif,">
                                                        <span class="text-danger error-text image_err"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button"
                                                            class="btn btn-sm btn-info chooseFile image"
                                                            id="twitterImageId" style="white-space: nowrap">Choose
                                                            From
                                                            Gallery</button>
                                                        <input type="hidden" name="twitterImageGallery"
                                                            class="twitterImageGallery">
                                                    </div>

                                                    <div class="col-md-3 previewBox">
                                                        @if (!empty($allData) && isset($allData['facebookImage']) && $allData['facebookImage'] != '')
                                                            <img src="{{ asset('storage/media/' . $allData['twitterImage']) }}"
                                                                class="preview-image-before-upload image"
                                                                width="100%" />
                                                        @else
                                                            <img src="{{ asset('storage/media/admin/placeholder.png') }}"
                                                                class="preview-image-before-upload image"
                                                                width="100%" />
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- Image Section END --}}
                                            </div>
                                            <span class="text-danger error-text twitterImage_err"></span>
                                        </div>

                                        <div class="form-group row">
                                            <label for="twitterTitle" class="col-sm-12 col-form-label">Twitter
                                                Title</label>
                                            <div class="col-sm-12">
                                                <input id="twitterTitle"
                                                    value="@if (!empty($allData) && isset($allData['twitterTitle']) && $allData['twitterTitle'] != '') {{ $allData['twitterTitle'] }} @endif"
                                                    placeholder="Twitter Title" name="twitterTitle" type="text"
                                                    class="form-control">
                                            </div>
                                            <span class="text-danger error-text twitterTitle_err"></span>
                                        </div>

                                        <div class="form-group row">
                                            <label for="twitterDescription" class="col-sm-12 col-form-label">Twitter
                                                Description</label>
                                            <div class="col-sm-12">
                                                <textarea id="twitterDescription" placeholder="Twitter Description" name="twitterDescription" class="form-control"> @if (!empty($allData) && isset($allData['twitterDescription']) && $allData['twitterDescription'] != '') {{ $allData['twitterDescription'] }} @endif </textarea>

                                            </div>
                                            <span class="text-danger error-text twitterDescription_err"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
