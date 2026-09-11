@extends('admin/layout')

@section('page_title', $pageTitle)

@section('info','Manage Pages including SEO')

@section('Appearance', 'menu-open')

@section('aboutus', 'active')

@section('container')

    @php

        // prx($allData['popupGallery']);

    @endphp

<style>

    textarea.form-control {

    height: 123px;

}

</style>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->



        <!-- /.content-header -->

        <form action="{{ route('admin.aboutus-form') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

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

                        <a href="{{ url('admin/aboutus') }}" class="btn btn-warning btn-sm btn-badge"><i

                                class="right fas fa-angle-left"></i> Back </a>



                    </div>

                </div>

                <!-- /.card-header -->

                <div class="card-body">

                    <div class="card card-info">



                    <div class="card card-dark ">

<div class="card-header">

    <h3 class="card-title">Home Section About</h3>

    <div class="card-tools">

        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                class="fas fa-minus"></i>

        </button>

    </div>

</div>



<div class="card-body">

    <div class="form-group row">

        <div class="col-sm-6">

            <label for="homesectionHeading" class="col-form-label">Heading</label>

            <input type="text" class="form-control" name="homesectionHeading"

                id="homesectionHeading"

                value=" @if (!empty($allData) && isset($allData['homesectionHeading']) && $allData['homesectionHeading'] != '') {{ $allData['homesectionHeading'] }} @endif">

        </div>



        <div class="col-sm-6">

            <label for="homesectionContent" class="col-form-label">Content</label>

            <textarea name="homesectionContent" id="homesectionContent" class="form-control" aria-required="true"

                aria-invalid="false">

            @if (!empty($allData) && isset($allData['homesectionContent']) && $allData['homesectionContent'] != '')

{{ $allData['homesectionContent'] }}

@endif

        </textarea>

        </div>

       

        <div class="row imageSection">

                <div class="col-md-3">

                    <label class="btn btn-sm btn-info" for="homesectionImage">Upload File Home</label>

                    <input id="homesectionImage" name="homesectionImage" type="file"

                        class="form-control hide image" aria-required="true"

                        aria-invalid="false">

                    <span class="text-danger error-text homesectionImage_err"></span>

                </div>



                <div class="col-md-12 previewBox">

                    @if (isset($allData['homesectionImage']))

                        <img src="{{ asset('storage/media/' . $allData['homesectionImage']) }}"

                            class="preview-image-before-upload homesectionImage" width="100px"

                            height="100px" />

                    @else

                        <img src="{{ asset('storage/media/placeholder.png') }}"

                            class="preview-image-before-upload homesectionImage" width="100px"

                            height="100px" />

                    @endif


                    </div>
                </div>

                <div class="col-sm-8">

<label for="homesectionlink" class="col-form-label">About Link</label>

<input type="text" class="form-control" name="homesectionlink"

    id="homesectionlink"

    value=" @if (!empty($allData) && isset($allData['homesectionlink']) && $allData['homesectionlink'] != '') {{ $allData['homesectionlink'] }} @endif">

</div>


            </div>
                    </div>

                            <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">Section One, Mission, Vision, Our Values</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>



                                <div class="card-body">

                                    <div class="form-group row">

                                        <div class="col-sm-4">

                                            <label for="visionHeading" class="col-form-label">Vision Heading</label>

                                            <input type="text" class="form-control" name="visionHeading"

                                                id="visionHeading"

                                                value=" @if (!empty($allData) && isset($allData['visionHeading']) && $allData['visionHeading'] != '') {{ $allData['visionHeading'] }} @endif">

                                        </div>

                                        <div class="col-sm-4">

                                            <label for="visionContent" class="col-form-label">Vision Content</label>

                                            <textarea name="visionContent" id="visionContent" class="form-control" aria-required="true" aria-invalid="false">

                                            @if (!empty($allData) && isset($allData['visionContent']) && $allData['visionContent'] != '')

{{ $allData['visionContent'] }}

@endif

                                            </textarea>

                                        </div>

                                        <div class="col-sm-4">



                                            <label for="vissionImage" class="col-form-label">Vission Image</label>

                                            {{-- Image Section Start --}}

                                            <div class="row imageSection">

                                                <div class="col-md-3">

                                                    <label class="btn btn-sm btn-info" for="vissionImage">Upload

                                                        File</label>

                                                    <input id="vissionImage" name="vissionImage" type="file"

                                                        class="form-control hide image" aria-required="true"

                                                        aria-invalid="false">

                                                    <span class="text-danger error-text vissionImage_err"></span>

                                                </div>



                                                <div class="col-md-12 previewBox">

                                                    @if (isset($allData['vissionImage']))

                                                        <img src="{{ asset('storage/media/' . $allData['vissionImage']) }}"

                                                            class="preview-image-before-upload vissionImage"

                                                            width="100px" height="100px" />

                                                    @else

                                                        <img src="{{ asset('storage/media/placeholder.png') }}"

                                                            class="preview-image-before-upload vissionImage"

                                                            width="100px" height="100px" />

                                                    @endif



                                                </div>

                                            </div>

                                            {{-- Image Section END --}}



                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <div class="col-sm-4">

                                            <label for="missionHeading" class="col-form-label">Mission Heading</label>

                                            <input type="text" class="form-control" name="missionHeading"

                                                id="missionHeading"

                                                value=" @if (!empty($allData) && isset($allData['missionHeading']) && $allData['missionHeading'] != '') {{ $allData['missionHeading'] }} @endif">

                                        </div>

                                        <div class="col-sm-4">

                                            <label for="missionContent" class="col-form-label">Mission Content</label>

                                            <textarea name="missionContent" id="missionContent" class="form-control" aria-required="true" aria-invalid="false">

                                            @if (!empty($allData) && isset($allData['missionContent']) && $allData['missionContent'] != '')

{{ $allData['missionContent'] }}

@endif

                                            </textarea>

                                        </div>

                                        <div class="col-sm-4">



                                            <label for="missionImage" class="col-form-label">Mission Image</label>

                                            {{-- Image Section Start --}}

                                            <div class="row imageSection">

                                                <div class="col-md-3">

                                                    <label class="btn btn-sm btn-info" for="missionImage">Upload

                                                        File</label>

                                                    <input id="missionImage" name="missionImage" type="file"

                                                        class="form-control hide image" aria-required="true"

                                                        aria-invalid="false">

                                                    <span class="text-danger error-text missionImage_err"></span>

                                                </div>



                                                <div class="col-md-12 previewBox">

                                                    @if (isset($allData['missionImage']))

                                                        <img src="{{ asset('storage/media/' . $allData['missionImage']) }}"

                                                            class="preview-image-before-upload missionImage"

                                                            width="100px" height="100px" />

                                                    @else

                                                        <img src="{{ asset('storage/media/placeholder.png') }}"

                                                            class="preview-image-before-upload missionImage"

                                                            width="100px" height="100px" />

                                                    @endif



                                                </div>

                                            </div>

                                            {{-- Image Section END --}}



                                        </div>

                                    </div>



                                   
                                    <div class="form-group row">

                                        <div class="col-sm-4">

                                            <label for="ourvalues" class="col-form-label">Our Values Heading</label>

                                            <input type="text" class="form-control" name="ourvalues"

                                                id="ourvalues"

                                                value=" @if (!empty($allData) && isset($allData['ourvalues']) && $allData['ourvalues'] != '') {{ $allData['ourvalues'] }} @endif">

                                        </div>

                                        <div class="col-sm-4">

                                            <label for="ourvaluescontent" class="col-form-label">Our Values Content</label>

                                            <textarea name="ourvaluescontent" id="ourvaluescontent" class="form-control" aria-required="true" aria-invalid="false">

                                            @if (!empty($allData) && isset($allData['ourvaluescontent']) && $allData['ourvaluescontent'] != '')

{{ $allData['ourvaluescontent'] }}

@endif

                                            </textarea>

                                        </div>

                                        <div class="col-sm-4">



                                            <label for="ourvaluesImage" class="col-form-label">Our Values Image</label>

                                            {{-- Image Section Start --}}

                                            <div class="row imageSection">

                                                <div class="col-md-3">

                                                    <label class="btn btn-sm btn-info" for="ourvaluesImage">Upload

                                                        File</label>

                                                    <input id="ourvaluesImage" name="ourvaluesImage" type="file"

                                                        class="form-control hide image" aria-required="true"

                                                        aria-invalid="false">

                                                    <span class="text-danger error-text ourvaluesImage_err"></span>

                                                </div>

                                                <div class="col-md-12 previewBox">

                                                    @if (isset($allData['ourvaluesImage']))

                                                        <img src="{{ asset('storage/media/' . $allData['ourvaluesImage']) }}"

                                                            class="preview-image-before-upload ourvaluesImage"

                                                            width="100px" height="100px" />

                                                    @else

                                                        <img src="{{ asset('storage/media/placeholder.png') }}"

                                                            class="preview-image-before-upload ourvaluesImage"

                                                            width="100px" height="100px" />

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

                                    <h3 class="card-title">Section Two Business Model</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>



                                <div class="card-body">

                                    <div class="form-group row">

                                        <div class="col-sm-6">

                                            <label for="sectionthreeHeading" class="col-form-label">Heading</label>

                                            <input type="text" class="form-control" name="sectionthreeHeading"

                                                id="sectionthreeHeading"

                                                value=" @if (!empty($allData) && isset($allData['sectionthreeHeading']) && $allData['sectionthreeHeading'] != '') {{ $allData['sectionthreeHeading'] }} @endif">

                                        </div>



                                        <div class="col-sm-6">

                                            <label for="sectionthreeContent" class="col-form-label">Content</label>

                                            <textarea name="sectionthreeContent" id="sectionthreeContent" class="form-control" aria-required="true"

                                                aria-invalid="false">

                                            @if (!empty($allData) && isset($allData['sectionthreeContent']) && $allData['sectionthreeContent'] != '')

{{ $allData['sectionthreeContent'] }}

@endif

                                        </textarea>

                                        </div>

                                        
                                     

                                       @if (isset($Business_Model) && !empty($Business_Model)) {{-- Business Model Add New --}} <div class="form-group col-sm-12"> <label for="form_control_title" class="control-label col-md-2 text-left"> Business Model </label> <div class="row"> {{-- Heading --}} <div class="col-sm-4 mb-2"> <input type="text" placeholder="Heading" class="form-control" name="business_heading[]"> </div> {{-- Content --}} <div class="col-sm-6 mb-2"> <textarea placeholder="Content" class="form-control" name="business_content[]" rows="4"></textarea> </div> {{-- Order By --}}  {{-- Add Button --}} <div class="col-sm-1 mb-2"> <a href="javascript:void(0);" class="btn btn-primary add_button"> Add </a> </div> </div> </div> {{-- Existing Business Model --}} <div class="form-group col-sm-12"> <div class="field_wrapper"> @foreach ($Business_Model as $benchmarkItem) <div class="row existing-business-row"> {{-- Heading --}} <div class="col-sm-4 mb-2"> <input type="text" placeholder="Heading" class="form-control" name="existing_business_heading[]" value="{{ $benchmarkItem->business_heading }}"> </div> {{-- Content --}} <div class="col-sm-6 mb-2"> <textarea placeholder="Content" class="form-control" name="existing_business_content[]" rows="4">{{ $benchmarkItem->business_content }}</textarea> </div> {{-- Order By --}} <div class="col-sm-1 mb-2"> <a href="javascript:void(0);" class="btn btn-danger remove_button"> Remove </a> </div> </div> @endforeach </div> </div> @else {{-- New Business Model --}} <div class="form-group col-sm-12"> <label for="form_control_title" class="control-label col-md-2 text-left"> Business Model </label> <div class="field_wrapper"> <div class="row"> {{-- Heading --}} <div class="col-sm-4 mb-2"> <input type="text" placeholder="Heading" class="form-control" name="business_heading[]"> </div> {{-- Content --}} <div class="col-sm-6 mb-2"> <textarea placeholder="Content" class="form-control" name="business_content[]" rows="4"></textarea> </div> {{-- Order By --}} <div class="col-sm-1 mb-2"> <a href="javascript:void(0);" class="btn btn-primary add_button"> Add </a> </div> </div> </div> </div> @endif

                                    </div>

                                </div>

                            </div>



                            <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">Section Three, Number of Countries</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>



                                <div class="card-body">

                                    <div class="form-group row">

                                        <div class="col-sm-6">

                                            <label for="sectionfourHeading" class="col-form-label">Heading</label>

                                            <input type="text" class="form-control" name="sectionfourHeading"

                                                id="sectionfourHeading"

                                                value=" @if (!empty($allData) && isset($allData['sectionfourHeading']) && $allData['sectionfourHeading'] != '') {{ $allData['sectionfourHeading'] }} @endif">

                                        </div>



                                        <div class="col-sm-6">

                                            <label for="sectionfourContent" class="col-form-label">Content</label>

                                            <textarea name="sectionfourContent" id="sectionfourContent" class="form-control" aria-required="true"

                                                aria-invalid="false">

                                            @if (!empty($allData) && isset($allData['sectionfourContent']) && $allData['sectionfourContent'] != '')

{{ $allData['sectionfourContent'] }}

@endif

                                        </textarea>

                                        </div>

                                       

                                        <div class="row imageSection">

                                                <div class="col-md-3">

                                                    <label class="btn btn-sm btn-info" for="sectionfourImage">Upload File Countries</label>

                                                    <input id="sectionfourImage" name="sectionfourImage" type="file"

                                                        class="form-control hide image" aria-required="true"

                                                        aria-invalid="false">

                                                    <span class="text-danger error-text sectionfourImage_err"></span>

                                                </div>



                                                <div class="col-md-12 previewBox">

                                                    @if (isset($allData['sectionfourImage']))

                                                        <img src="{{ asset('storage/media/' . $allData['sectionfourImage']) }}"

                                                            class="preview-image-before-upload sectionfourImage" width="100px"

                                                            height="100px" />

                                                    @else

                                                        <img src="{{ asset('storage/media/placeholder.png') }}"

                                                            class="preview-image-before-upload sectionfourImage" width="100px"

                                                            height="100px" />

                                                    @endif



                                                </div>

                                            </div>



                                        @if (isset($our_core_strengths) && !empty($our_core_strengths))

                                            <div class="form-group col-sm-12">

                                                <label for="form_control_title"

                                                    class="control-label col-md-2 text-left">Our Core Strengths

                                                </label>

                                                <!-- <div class="achievement_field_wrapper"> -->

                                                <div class="row">

                                                    <div class="col-sm-6 mb-2"><input type="text"

                                                            placeholder="Heading" class="form-control"

                                                            name="achievement_heading[]"></div>

                                                    <div class="col-sm-4 mb-2"><input type="text" class="form-control"

                                                            name="achievement_image[]"></div>

                                                    <div class="col-sm-1 mb-2"><a href="javascript:void(0);"

                                                            class="btn btn-primary achievement_add_button">Add</a></div>

                                                </div>

                                                <!-- </div> -->

                                            </div>

                                            <div class="form-group col-sm-12">

                                                <div class="achievement_field_wrapper">

                                                    @foreach ($our_core_strengths as $achievementkItem)

                                                        <div class="row">

                                                            <div class="col-sm-6 mb-2">

                                                                <input type="text" placeholder="Heading"

                                                                    class="form-control"

                                                                    name="achievement_existing_heading[]"

                                                                    value="{{ $achievementkItem->title }}">

                                                            </div>

                                                            <div class="col-sm-4 mb-2">

                                                                <input type="text" class="form-control"

                                                                    name="existing_achievement_image[]"

                                                                    value="{{ $achievementkItem->image }}">

                                                            </div>

                                                            <div class="col-sm-1 mb-2">

                                                                {{-- @if ($loop->last && count($achievement_details) > 1)

                                                                <a href="javascript:void(0);"

                                                                class="btn btn-primary achievement_add_button">Add</a>@else --}}

                                                                <a href="javascript:void(0);"

                                                                    class="btn btn-danger achievement_remove_button">Remove</a>

                                                                {{-- @endif --}}

                                                            </div>

                                                        </div>

                                                    @endforeach

                                                </div>

                                            </div>

                                        @else

                                            <div class="form-group col-sm-12">

                                                <label for="form_control_title"

                                                    class="control-label col-md-2 text-left">Our Core Strengths

                                                </label>

                                                <div class="achievement_field_wrapper">

                                                    <div class="row">

                                                        <div class="col-sm-6 mb-2"><input type="text"

                                                                placeholder="Heading" class="form-control"

                                                                name="achievement_heading[]"></div>

                                                        <div class="col-sm-4 mb-2"><input type="text"

                                                                class="form-control" name="achievement_image[]"></div>

                                                        <div class="col-sm-1 mb-2"><a href="javascript:void(0);"

                                                                class="btn btn-primary achievement_add_button">Add</a>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{-- section seo start --}}

                                <!--@include('admin.home.homepageSeo')-->

                                {{-- section seo end --}}

                                <div class="col-sm-6">

                                <label for="sectionthreeContentLast" class="col-form-label">Countries Last Content</label>

                                <textarea name="sectionthreeContentLast" id="sectionthreeContentLast" class="form-control" aria-required="true"

                                aria-invalid="false">

                                @if (!empty($allData) && isset($allData['sectionthreeContentLast']) && $allData['sectionthreeContentLast'] != '')

                                {{ $allData['sectionthreeContentLast'] }}

                                @endif

                                </textarea>

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

        $(document).ready(function() {

            var addButton = $('.add_button'); //Add button selector



            var wrapper = $('.field_wrapper'); //Input field wrapper



            //New input field html 

            var x = 1; //Initial field counter is 1



            //Once add button is clicked

            $(addButton).click(function() {

                x++; //Increment field counter

                var fieldHTML =

                    '<div class="row"><div class="col-sm-4 mb-2"><input type="text" placeholder="Heading" class="form-control" name="business_heading[]"></div><div class="col-sm-6 mb-2"><textarea placeholder="Content" class="form-control" name="business_content[]" rows="4"></textarea></div><div class="col-sm-1 mb-2"><a href="javascript:void(0);" class="btn btn-danger remove_button">Remove</a></div></div>';

                $(wrapper).append(fieldHTML); //Add field html

            });



            //Once remove button is clicked

            $(wrapper).on('click', '.remove_button', function(e) {

                e.preventDefault();

                $(this).parent().parent('div').remove(); //Remove field html

                x--; //Decrement field counter

            });





            ///////////////////////////





            var achievement_addButton = $('.achievement_add_button'); //Add button selector



            var achievement_wrapper = $('.achievement_field_wrapper'); //Input field wrapper



            //New input field html 

            var achievement_x = 1; //Initial field counter is 1



            //Once add button is clicked

            $(achievement_addButton).click(function() {

                achievement_x++; //Increment field counter

                // var fieldHTML = ' <div class="col-md-12"><div class="form-group form-md-line-input"> <div class="col-md-8"><input class="col-md-4" type="file" class="form-control" name="benchmark_image[]"><input class="col-md-4" type="text" placeholder="Heading" class="form-control" name="heading"><input class="col-md-4" type="text" placeholder="content" class="form-control" name="content"></div><div class="col-md-1"><a href="javascript:void(0);" class="btn btn-danger remove_button" >Remove</a></div></div></div>';

                var achievement_fieldHTML =

                    '<div class="row"><div class="col-sm-6 mb-2"><input type="text" placeholder="Heading" class="form-control" name="achievement_heading[]"></div><div class="col-sm-4 mb-2"><input type="text" class="form-control" name="achievement_image[]"></div><div class="col-sm-1 mb-2"><a href="javascript:void(0);" class="btn btn-danger achievement_remove_button">Remove</a></div></div>';

                $(achievement_wrapper).append(achievement_fieldHTML); //Add field html

            });



            //Once remove button is clicked

            $(achievement_wrapper).on('click', '.achievement_remove_button', function(e) {

                e.preventDefault();

                $(this).parent().parent('div').remove(); //Remove field html

                achievement_x--; //Decrement field counter

            });

        });





        $(document).ready(function() {

            var addButton = $('.about_countryadd_button'); //Add button selector



            var wrapper = $('.about_countryfield_wrapper'); //Input field wrapper



            //New input field html 

            var x = 1; //Initial field counter is 1



            //Once add button is clicked

            $(addButton).click(function() {

                x++; //Increment field counter

                // var fieldHTML = ' <div class="col-md-12"><div class="form-group form-md-line-input"> <div class="col-md-8"><input class="col-md-4" type="file" class="form-control" name="benchmark_image[]"><input class="col-md-4" type="text" placeholder="Heading" class="form-control" name="heading"><input class="col-md-4" type="text" placeholder="content" class="form-control" name="content"></div><div class="col-md-1"><a href="javascript:void(0);" class="btn btn-danger remove_button" >Remove</a></div></div></div>';

                var fieldHTML =

                    '<div class="row"><div class="col-sm-8 mb-2"><textarea placeholder="Content" class="form-control" name="about_country_content[]"></textarea></div><div class="col-sm-1 mb-2"><a href="javascript:void(0);" class="btn btn-danger about_countryremove_button">Remove</a></div></div>';

                $(wrapper).append(fieldHTML); //Add field html

            });



            //Once remove button is clicked

            $(wrapper).on('click', '.about_countryremove_button', function(e) {

                e.preventDefault();

                $(this).parent().parent('div').remove(); //Remove field html

                x--; //Decrement field counter

            });



        });



        $(document).on('click', '.delete-country_contentremove', function () {

    let id = $(this).data('id');

    let row = $(this).closest('.section-block');



    if (confirm("Are you sure you want to delete this country content?")) {

        $.ajax({

            url: "{{ url('country_content_delete') }}", // Blade syntax

            type: "POST",

            data: {

                _token: "{{ csrf_token() }}", // CSRF token

                id: id

            },

            dataType: "json",

            success: function (response) {

                if (response.status === 'success') {

                    alert("Deleted!");

                    row.remove();

                    location.reload();

                } else {

                    alert("Failed to delete.");

                }

            },

            error: function () {

                alert("AJAX Error.");

            }

        });

    }

});

    </script>



    @include('admin.home.homepageJs')



@endsection

