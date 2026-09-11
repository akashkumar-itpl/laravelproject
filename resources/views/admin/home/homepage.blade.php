@extends('admin/layout')

@section('page_title', $pageTitle)

@section('info',

'Manage All sections of the homepage other than BANNER,GUESTBOOK,USP,SOCIAL ICON from here including

SEO tags')

@section('Appearance', 'menu-open')

@section('homepage', 'active')

@section('container')



<div class="content-wrapper">

    <!-- Content Header (Page header) -->



    <!-- /.content-header -->

    <form action="{{ route('admin.homepage-form') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

        @csrf

        <div class="card">

            <div class="card-header card-header-sticky">

                <h3 class="card-title" style="font-size: 1.6em">@yield('page_title') <sup><a href="#"

                            data-toggle="tooltip" data-placement="top" title="@yield('info')"><i

                                class="fa fa-info-circle"></i></a></sup></h3>

                <div class="card-tools">

                    <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i

                            class="fa fa-check"></i></button>

                    |

                    <a href="{{ url('admin/homepage') }}" class="btn btn-warning btn-sm btn-badge"><i

                            class="right fas fa-angle-left"></i> Back </a>



                </div>

            </div>

            <!-- /.card-header -->

            <div class="card-body">

                <div class="card card-info">

                    <div class="card-body">

                        <div class="card card-dark">

                            <div class="card-header">

                                <h3 class="card-title">General</h3>

                                <div class="card-tools">

                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                            class="fas fa-minus"></i>

                                    </button>

                                </div>

                            </div>



                            <div class="card-body">

                                <div class="form-group row">

                                    <div class="col-sm-3">

                                        <label for="logo" class="col-form-label">Site Logo</label>

                                        {{-- Image Section Start --}}

                                        <div class="row imageSection">

                                            <div class="col-md-3">

                                                <label class="btn btn-sm btn-info" for="logo">Upload File</label>

                                                <input id="logo" name="logo" type="file"

                                                    class="form-control hide image" aria-required="true"

                                                    aria-invalid="false">

                                                <span class="text-danger error-text logo_err"></span>

                                            </div>

                                            <div class="col-md-12 previewBox">

                                                @if (isset($allData['logo']))

                                                <img src="{{ asset('storage/media/' . $allData['logo']) }}"

                                                    class="preview-image-before-upload logo" width="100px"

                                                    height="100px" />

                                                @else

                                                <img src="{{ asset('storage/media/placeholder.png') }}"

                                                    class="preview-image-before-upload logo" width="100px"

                                                    height="100px" />

                                                @endif

                                            </div>

                                        </div>

                                        {{-- Image Section END --}}

                                    </div>



                                    <div class="col-sm-3">



                                        <label for="favicon" class="col-form-label">Favicon</label>

                                        {{-- Image Section Start --}}

                                        <div class="row imageSection">

                                            <div class="col-md-3">

                                                <label class="btn btn-sm btn-info" for="favicon">Upload File</label>

                                                <input id="favicon" name="favicon" type="file"

                                                    class="form-control hide image" aria-required="true"

                                                    aria-invalid="false">

                                                <span class="text-danger error-text favicon_err"></span>

                                            </div>



                                            <div class="col-md-12 previewBox">

                                                @if (isset($allData['favicon']))

                                                <img src="{{ asset('storage/media/' . $allData['favicon']) }}"

                                                    class="preview-image-before-upload" width="100px"

                                                    height="100px" />

                                                @else

                                                <img src="{{ asset('storage/media/admin/placeholder.png') }}"

                                                    class="preview-image-before-upload" width="100px"

                                                    height="100px" />

                                                @endif



                                            </div>

                                        </div>

                                        {{-- Image Section END --}}



                                    </div>

                                   @php $extension = Str::afterLast($allData['bannerFile'], '.');@endphp

                                    <div class="col-sm-3">

                                        <label for="bannerFile" class="col-form-label">Desktop Banner File</label>

                                        {{-- Image Section Start --}}

                                        <div class="row imageSection">

                                            <div class="col-md-3">

                                                <label class="btn btn-sm btn-info" for="bannerFile">Upload File</label>

                                                <input id="bannerFile" name="bannerFile" type="file"

                                                    class="form-control hide image" aria-required="true"

                                                    aria-invalid="false" accept="video/*">

                                                <span class="text-danger error-text bannerFile_err"></span>

                                            </div>

                                            <div class="col-md-12 previewBox">

                                                        @if ($extension == 'mp4')

                                                        <section>

                                                        <video muted="muted" loop="" playsinline="" preload="metadata" poster="img/intro.jpg" width="100%"

                                                        class="home_video_banner" autoplay="">

                                                        <source type="video/mp4" src="{{ URL::asset('storage/media/' . $allData['bannerFile']) }}">

                                                        </video>

                                                        </section>

                                                        @else

                                                        @if (isset($allData['bannerFile']))

                                                        <img src="{{ asset('storage/media/' . $allData['bannerFile']) }}"

                                                        class="preview-image-before-upload bannerFile" width="100px"

                                                        height="100px" />

                                                        @else

                                                        <img src="{{ asset('storage/media/placeholder.png') }}"

                                                        class="preview-image-before-upload bannerFile" width="100px"

                                                        height="100px" />

                                                        @endif

                                                        @endif

                                            </div>

                                        </div>

                                        {{-- Image Section END --}}

                                    </div>



                                    <div class="col-sm-3">

                                        <label for="bannerMobile" class="col-form-label">Mobile Banner File</label>

                                        {{-- Image Section Start --}}

                                        <div class="row imageSection">

                                            <div class="col-md-3">

                                                <label class="btn btn-sm btn-info" for="bannerMobile">Upload File</label>

                                                <input id="bannerMobile" name="bannerMobile" type="file"

                                                    class="form-control hide image" aria-required="true"

                                                    aria-invalid="false" accept="video/*">

                                                <span class="text-danger error-text bannerMobile_err"></span>

                                            </div>

                                            <div class="col-md-12 previewBox">

                                            @if ($extension == 'mp4')

                                                        <section>

                                                        <video muted="muted" loop="" playsinline="" preload="metadata" poster="img/intro.jpg" width="100%"

                                                        class="home_video_banner" autoplay="">

                                                        <source type="video/mp4" src="{{ URL::asset('storage/media/' . $allData['bannerFile']) }}">

                                                        </video>

                                                        </section>

                                                        @else

                                                @if (isset($allData['bannerMobile']))

                                                <img src="{{ asset('storage/media/' . $allData['bannerMobile']) }}"

                                                    class="preview-image-before-upload bannerMobile" width="100px"

                                                    height="100px" />

                                                @else

                                                <img src="{{ asset('storage/media/placeholder.png') }}"

                                                    class="preview-image-before-upload bannerMobile" width="100px"

                                                    height="100px" />

                                                @endif

                                                @endif

                                            </div>

                                        </div>

                                        {{-- Image Section END --}}

                                    </div>

                                </div>

                            </div>

                        </div>




                        <div class="card card-dark ">
                        <div class="card-header">
                        <h3 class="card-title">Products and Services</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                        </button>
                        </div>
                        </div>

                        <div class="card-body">
                        <div class="form-group col-sm-12">
                        <div class="row">
                        <div class="col-sm-6">
                        <label for="pands" class="col-form-label">Heading</label>
                        <input type="text" class="form-control" name="pands"
                        id="pands"
                        value=" @if (!empty($allData) && isset($allData['pands']) && $allData['pands'] != '') {{ $allData['pands'] }} @endif">
                        </div>
                        <div class="col-sm-6">
                        <label for="pandscontent" class="col-form-label">Content</label>
                        <textarea name="pandscontent" id="pandscontent" class="form-control" aria-required="true" aria-invalid="false">
                        @if (!empty($allData) && isset($allData['pandscontent']) && $allData['pandscontent'] != '')
                        {{ $allData['pandscontent'] }}
                        @endif
                        </textarea>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>


                        <div class="card card-dark">

<div class="card-header">

    <h3 class="card-title">
    Every Step, A Story of Success
    </h3>

    <div class="card-tools">

        <button type="button"
                class="btn btn-tool"
                data-card-widget="collapse">

            <i class="fas fa-minus"></i>

        </button>

    </div>

</div>


<div class="card-body">

    <div class="form-group row">


        @if (isset($achievement_details) && !empty($achievement_details))

            {{-- =========================================
                ADD NEW ACHIEVEMENT
            ========================================== --}}
            <div class="form-group col-sm-12">

                <label class="control-label col-md-2 text-left">
                    Achievement Year
                </label>


                {{-- IMPORTANT:
                     Separate wrapper for NEW entries only --}}
                <div class="achievement_add_wrapper">

                    <div class="row achievement_new_row">

                        {{-- Heading --}}
                        <div class="col-sm-3 mb-2">

                            <input type="text"
                                   placeholder="Year"
                                   class="form-control"
                                   name="achievement_heading[]">

                        </div>

                        {{-- Content --}}
                        <div class="col-sm-6 mb-2">

                            <textarea
                                placeholder="Content"
                                class="form-control"
                                name="achievement_content[]"
                                rows="3"></textarea>

                        </div>


                        {{-- Image --}}
                        <div class="col-sm-2 mb-2">

                            <input type="file"
                                   class="form-control"
                                   name="achievement_image[]">

                        </div>


                        {{-- Add --}}
                        <div class="col-sm-1 mb-2">

                            <a href="javascript:void(0);"
                               class="btn btn-primary achievement_add_button">

                                Add

                            </a>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =========================================
                EXISTING ACHIEVEMENTS
            ========================================== --}}
            <div class="form-group col-sm-12">

                {{-- IMPORTANT:
                     Different wrapper for EXISTING entries --}}
                <div class="achievement_existing_wrapper">

                    @foreach ($achievement_details as $achievementkItem)

                        <div class="row achievement_existing_row">


                            {{-- Heading --}}
                            <div class="col-sm-3 mb-2">

                                <input type="text"
                                       placeholder="Year"
                                       class="form-control"
                                       name="achievement_existing_heading[]"
                                       value="{{ $achievementkItem->heading }}">

                            </div>

                            {{-- Content --}}
                            <div class="col-sm-6 mb-2">

                                <textarea
                                    placeholder="Content"
                                    class="form-control"
                                    name="achievement_existing_content[]"
                                    rows="3">{{ $achievementkItem->content }}</textarea>

                            </div>


                            {{-- Existing Image --}}
                            <div class="col-sm-2 mb-2">

                                <input type="hidden"
                                       name="existing_achievement_image[]"
                                       value="{{ $achievementkItem->filename }}">


                                @if (!empty($achievementkItem->filename))

                                    <img
                                        src="{{ asset('storage/media/' . $achievementkItem->filename) }}"
                                        style="height:144px; max-width:100%;"
                                        alt="Achievement Image">

                                @endif

                            </div>


                            {{-- Remove --}}
                            <div class="col-sm-1 mb-2">

                                <a href="javascript:void(0);"
                                   class="btn btn-danger achievement_remove_button">

                                    Remove

                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


        @else


            {{-- =========================================
                NO EXISTING ACHIEVEMENTS
            ========================================== --}}
            <div class="form-group col-sm-12">

                <label class="control-label col-md-2 text-left">
                    Achievement Year
                </label>


                {{-- New achievement wrapper --}}
                <div class="achievement_add_wrapper">

                    <div class="row achievement_new_row">


                        {{-- Heading --}}
                        <div class="col-sm-3 mb-2">

                            <input type="text"
                                   placeholder="Year"
                                   class="form-control"
                                   name="achievement_heading[]">

                        </div>


                        {{-- Sub Heading --}}
                       
                        {{-- Content --}}
                        <div class="col-sm-6 mb-2">

                            <textarea
                                placeholder="Content"
                                class="form-control"
                                name="achievement_content[]"
                                rows="3"></textarea>

                        </div>


                        {{-- Image --}}
                        <div class="col-sm-2 mb-2">

                            <input type="file"
                                   class="form-control"
                                   name="achievement_image[]">

                        </div>


                        {{-- Add --}}
                        <div class="col-sm-1 mb-2">

                            <a href="javascript:void(0);"
                               class="btn btn-primary achievement_add_button">

                                Add

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @endif


    </div>

</div>

</div>



<div class="card card-dark ">
                            <div class="card-header">
                                <h3 class="card-title">Section Four, Quality & Product</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="sectionfourHeading" class="col-form-label">Section Four Heading</label>
                                            <input type="text" class="form-control" name="sectionfourHeading"
                                                id="sectionfourHeading"
                                                value=" @if (!empty($allData) && isset($allData['sectionfourHeading']) && $allData['sectionfourHeading'] != '') {{ $allData['sectionfourHeading'] }} @endif">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="sectionfourContent" class="col-form-label">Section four Content</label>
                                            <textarea name="sectionfourContent" id="sectionfourContent" class="form-control" aria-required="true" aria-invalid="false">
                                                @if (!empty($allData) && isset($allData['sectionfourContent']) && $allData['sectionfourContent'] != '')
                                                    {{ $allData['sectionfourContent'] }}
                                                @endif
                                                </textarea>
                                        </div>

                                        <div class="col-sm-6">
    <label for="sectionfourImage" class="col-form-label">
        Section Four Image
    </label>

    <div class="row imageSection">

        <div class="col-md-3">

            <label class="btn btn-sm btn-info" for="sectionfourImage">
                Upload File
            </label>

            <input
                id="sectionfourImage"
                name="sectionfourImage"
                type="file"
                class="form-control hide image"
                accept="image/*"
            >

            <span class="text-danger error-text sectionfourImage_err"></span>

        </div>

        {{-- Existing image --}}
        <input
            type="hidden"
            name="oldsectionfourImage"
            value="{{ $allData['sectionfourImage'] ?? '' }}"
        >

        <div class="col-md-12 previewBox mt-2">

            @if (!empty($allData['sectionfourImage']))

                <img
                    src="{{ asset('storage/media/' . $allData['sectionfourImage']) }}"
                    class="preview-image-before-upload popup"
                    width="100"
                    height="100"
                    alt="Section Four Image"
                >

            @else

                <img
                    src="{{ asset('storage/media/placeholder.png') }}"
                    class="preview-image-before-upload popup"
                    width="100"
                    height="100"
                    alt="Placeholder"
                >

            @endif

        </div>

    </div>
</div>







                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- section seo start --}}

                        @include('admin.home.homepageSeo')

                        {{-- section seo end --}}



                        <div class="card card-dark">

  <div class="card-header">

    <h3 class="card-title">Popup Home Page</h3>

    <div class="card-tools">

      <button type="button" class="btn btn-tool" data-card-widget="collapse">

        <i class="fas fa-minus"></i>

      </button>

    </div>

  </div>



  <div class="card-body">

    <div class="form-group row">

      <div class="col-sm-3">

        <label for="popup_status" class="col-form-label">Popup Enable/Disable</label>

        <select name="popup_displayOn" class="form-control">

          <option value="">Select YES/NO</option>

          <option value="1" {{ @$popup['popup_displayOn'] == '1' ? 'selected' : '' }}>YES</option>

          <option value="0" {{ @$popup['popup_displayOn'] == '0' ? 'selected' : '' }}>NO</option>

        </select>

      </div>



      <div class="col-sm-3">

        <label for="popup_active_date" class="col-form-label">Auto Inactive Date</label>

        <input id="popup_active_date" name="popup_active_date" type="date" class="form-control"

          value="{{ @$popup['popup_active_date'] }}" >

          <!-- min="{{ date('Y-m-d') }}" -->

      </div>

      <div class="col-sm-12">

        <label for="popup_link" class="col-form-label">Popup Link</label>

        <input id="popup_link" name="popup_link" type="text" class="form-control"

          value="{{ @$popup['popup_link'] }}" >

      </div>

      <div class="col-sm-6">

        <label for="home_popup" class="col-form-label">Popup Image</label>

        <div class="row imageSection">

          <div class="col-md-3">

            <label class="btn btn-sm btn-info" for="home_popup">Upload File</label>

            <input id="home_popup" name="home_popup" type="file" class="form-control hide image">

            <span class="text-danger error-text popup_err"></span>

          </div>

          <input name="oldhome_popup" type="hidden" value="{{ @$popup['home_popup'] }}">



          <div class="col-md-12 previewBox mt-2">

            @if (!empty($popup['home_popup']))

              <img src="{{ asset('storage/media/' . $popup['home_popup']) }}"

                   class="preview-image-before-upload popup" width="100px" height="100px" />

            @else

              <img src="{{ asset('storage/media/placeholder.png') }}"

                   class="preview-image-before-upload popup" width="100px" height="100px" />

            @endif

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

</div>

<!-- /.card-body -->

<div class="card-footer">

    <p class="text-right"><small><strong>Last Updated On:

                {{ $updated_at }}</strong></small>

    </p>

</div>

<!-- /.card-footer -->

</div>

</div>

</form>

<!-- /.card-body -->

</div>

<!-- /.card -->

</div>



<script>
$(document).ready(function () {

/*
|--------------------------------------------------------------------------
| Achievement - Add More
|--------------------------------------------------------------------------
*/

$('.achievement_add_wrapper').on(
    'click',
    '.achievement_add_button',
    function (e) {

        e.preventDefault();

        var achievement_fieldHTML =
            '<div class="row achievement_new_row">' +

                /*
                |--------------------------------------------------------------------------
                | Heading
                |--------------------------------------------------------------------------
                */
                '<div class="col-sm-3 mb-2">' +
                    '<input type="text" ' +
                        'placeholder="Heading" ' +
                        'class="form-control" ' +
                        'name="achievement_heading[]">' +
                '</div>' +

                /*
                |--------------------------------------------------------------------------
                | Content
                |--------------------------------------------------------------------------
                */
                '<div class="col-sm-6 mb-2">' +
                    '<textarea ' +
                        'placeholder="Content" ' +
                        'class="form-control" ' +
                        'name="achievement_content[]" ' +
                        'rows="3"></textarea>' +
                '</div>' +

                /*
                |--------------------------------------------------------------------------
                | Image
                |--------------------------------------------------------------------------
                */
                '<div class="col-sm-2 mb-2">' +
                    '<input type="file" ' +
                        'class="form-control" ' +
                        'name="achievement_image[]">' +
                '</div>' +

                /*
                |--------------------------------------------------------------------------
                | Remove Button
                |--------------------------------------------------------------------------
                */
                '<div class="col-sm-1 mb-2">' +
                    '<a href="javascript:void(0);" ' +
                       'class="btn btn-danger achievement_remove_button">' +
                        'Remove' +
                    '</a>' +
                '</div>' +

            '</div>';


        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        | Append ONLY to achievement_add_wrapper.
        | Do NOT use .achievement_field_wrapper because there are
        | multiple wrappers when existing records are available.
        |--------------------------------------------------------------------------
        */

        $(this)
            .closest('.achievement_add_wrapper')
            .append(achievement_fieldHTML);

    }
);


/*
|--------------------------------------------------------------------------
| Achievement - Remove
|--------------------------------------------------------------------------
*/

$(document).on(
    'click',
    '.achievement_remove_button',
    function (e) {

        e.preventDefault();

        /*
        | Remove only the row containing this button
        */
        $(this).closest('.row').remove();

    }
);

});
</script>



@include('admin.home.homepageJs')



@endsection