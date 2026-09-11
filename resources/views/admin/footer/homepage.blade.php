@extends('admin/layout')

@section('page_title', $pageTitle)

@section('info',

    'Manage Footer')

@section('Appearance', 'menu-open')

@section('footer', 'active')

@section('container')



    <div class="content-wrapper">

        <!-- Content Header (Page header) -->



        <!-- /.content-header -->

        <form action="{{ route('admin.footer-form') }}" class="form-horizontal" method="post"

            enctype="multipart/form-data">

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

                        <a href="{{ url('admin/footer') }}" class="btn btn-warning btn-sm btn-badge"><i

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

                                        <div class="col-sm-10">

                                            <label for="footerlogo" class="col-form-label">Footer Logo</label>

                                            {{-- Image Section Start --}}

                                            <div class="row imageSection">

                                                <div class="col-md-12">

                                                    <label class="btn btn-sm btn-info" for="footerlogo">Upload File</label>

                                                    <input id="footerlogo" name="footerlogo" type="file"

                                                        class="form-control hide image" aria-required="true"

                                                        aria-invalid="false">

                                                    <span class="text-danger error-text footerlogo_err"></span>

                                                </div>

                                            </div>

                                            {{-- Image Section END --}}

                                        </div>

                                    </div>

                                                <div class="col-md-12 previewBox">

                                                @if (isset($allData['footerlogo']))

                                                <img src="{{ asset('storage/media/' . $allData['footerlogo']) }}"

                                                class="preview-image-before-upload footerlogo" width="100px"

                                                height="100px" />

                                                @else

                                                <img src="{{ asset('storage/media/placeholder.png') }}"

                                                class="preview-image-before-upload footerlogo" width="100px"

                                                height="100px" />

                                                @endif



                                                </div>

                                </div>

                            </div>



                            <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">SEO</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>



                                <div class="card-body">

                                    <div class="form-group col-sm-12">

                                        <div class="row">

                                            <div class="col-sm-4">

                                                <label for="facebookurl" class="col-form-label">Facebook Url</label>

                                                <input type="text" class="form-control" name="facebookurl"

                                                    id="facebookurl"

                                                    value=" @if (!empty($allData) && isset($allData['facebookurl']) && $allData['facebookurl'] != '') {{ $allData['facebookurl'] }} @endif">

                                            </div>

                                            <div class="col-sm-4">

                                                <label for="instaurl" class="col-form-label">Instagram Url

                                                    </label>

                                                <input type="text" class="form-control" name="instaurl"

                                                    id="instaurl"

                                                    value=" @if (!empty($allData) && isset($allData['instaurl']) && $allData['instaurl'] != '') {{ $allData['instaurl'] }} @endif">

                                            </div>

                                            <div class="col-sm-4">

                                                <label for="twiterurl" class="col-form-label">Twiter Url

                                                    </label>

                                                <input type="text" class="form-control" name="twiterurl"

                                                    id="twiterurl"

                                                    value=" @if (!empty($allData) && isset($allData['twiterurl']) && $allData['twiterurl'] != '') {{ $allData['twiterurl'] }} @endif">

                                            </div>

                                            <div class="col-sm-4">

                                                <label for="linkedinurl" class="col-form-label">LinkedIn URl

                                                    </label>

                                                <input type="text" class="form-control" name="linkedinurl"

                                                    id="linkedinurl"

                                                    value=" @if (!empty($allData) && isset($allData['linkedinurl']) && $allData['linkedinurl'] != '') {{ $allData['linkedinurl'] }} @endif">

                                            </div>

                                            <div class="col-sm-4">

                                                <label for="whatsappurl" class="col-form-label">Whats App Url

                                                    </label>

                                                <input type="text" class="form-control" name="whatsappurl"

                                                    id="whatsappurl"

                                                    value=" @if (!empty($allData) && isset($allData['whatsappurl']) && $allData['whatsappurl'] != '') {{ $allData['whatsappurl'] }} @endif">

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">Section Two</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>



                                <div class="card-body">

                                    @if (isset($benchmark_details) && !empty($benchmark_details))

                                        <div class="form-group col-sm-12">

                                            <label for="form_control_title"

                                                class="control-label col-md-2 text-left">Quick Links

                                            </label>

                                            {{-- <div class="field_wrapper"> --}}

                                            <div class="row">

                                                <div class="col-sm-4 mb-8"><input type="text" placeholder="Heading"

                                                        class="form-control" name="approaches_heading[]"></div>

                                                <div class="col-sm-4 mb-8"><input type="text" placeholder="Url"

                                                        class="form-control" name="approaches_content[]"></div>

                                                <div class="col-sm-1 mb-2"><a href="javascript:void(0);"

                                                        class="btn btn-primary add_button">Add</a></div>

                                            </div>

                                            {{-- </div> --}}

                                        </div>

                                        <div class="form-group col-sm-12">

                                            <div class="field_wrapper">

                                                @foreach ($benchmark_details as $benchmarkItem)

                                                    <div class="row">

                                                        <div class="col-sm-4 mb-2">

                                                            <input type="text" placeholder="Heading"

                                                                class="form-control" name="approaches_existing_heading[]"

                                                                value="{{ $benchmarkItem->heading }}">

                                                        </div>

                                                        <div class="col-sm-4 mb-2">

                                                            <input type="text" placeholder="Url"

                                                                class="form-control" name="approaches_existing_content[]"

                                                                value="{{ $benchmarkItem->content }}">

                                                        </div>

                                                        <div class="col-sm-1 mb-2">

                                                            {{-- @if ($loop->last && count($benchmark_details) > 1)

                                                                <a href="javascript:void(0);"

                                                                class="btn btn-primary add_button">Add</a>  @else --}}

                                                            <a href="javascript:void(0);"

                                                                class="btn btn-danger remove_button">Remove</a>

                                                            {{-- @endif --}}

                                                        </div>

                                                    </div>

                                                @endforeach

                                            </div>

                                        </div>

                                    @else

                                        <div class="form-group col-sm-12">

                                            <label for="form_control_title"

                                                class="control-label col-md-2 text-left">Quick Links

                                            </label>

                                            <div class="field_wrapper">

                                                <div class="row">

                                                    <div class="col-sm-4 mb-2"><input type="text"

                                                            placeholder="Heading" class="form-control"

                                                            name="approaches_heading[]"></div>

                                                    <div class="col-sm-4 mb-2"><input type="text"

                                                            placeholder="Url" class="form-control"

                                                            name="approaches_content[]"></div>

                                                    <div class="col-sm-1 mb-2"><a href="javascript:void(0);"

                                                            class="btn btn-primary add_button">Add</a></div>

                                                </div>

                                            </div>

                                        </div>

                                    @endif

                                </div>

                            </div>



                             <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">Section Three</h3>

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

                                                <label for="address" class="col-form-label">Address</label>

                                                <input type="text" class="form-control" name="address"

                                                    id="address"

                                                    value=" @if (!empty($allData) && isset($allData['address']) && $allData['address'] != '') {{ $allData['address'] }} @endif">

                                            </div>

                                            <div class="col-sm-3">

                                                <label for="contact" class="col-form-label">Contact

                                                    </label>

                                                <input type="text" class="form-control" name="contact"

                                                    id="contact"

                                                    value=" @if (!empty($allData) && isset($allData['contact']) && $allData['contact'] != '') {{ $allData['contact'] }} @endif">

                                            </div>

                                            <div class="col-sm-3">

                                                <label for="email" class="col-form-label">Email</label>

                                                <input type="text" class="form-control" name="email"

                                                    id="email"

                                                    value=" @if (!empty($allData) && isset($allData['email']) && $allData['email'] != '') {{ $allData['email'] }} @endif">

                                            </div>

                                            <div class="col-sm-12">

<label for="address" class="col-form-label">MAP</label>
<textarea name="map" id="map" class="form-control" aria-required="true" aria-invalid="false">
                        @if (!empty($allData) && isset($allData['map']) && $allData['map'] != '')
                        {{ $allData['map'] }}
                        @endif
                        </textarea>
                      

</div>

                                            <div class="col-sm-6">

<label for="address" class="col-form-label">Address 2</label>

<input type="text" class="form-control" name="address_2"

    id="address"

    value=" @if (!empty($allData) && isset($allData['address_2']) && $allData['address_2'] != '') {{ $allData['address_2'] }} @endif">

</div>

<div class="col-sm-3">

<label for="contact" class="col-form-label">Contact 2

    </label>

<input type="text" class="form-control" name="contact_2"

    id="contact_2"

    value=" @if (!empty($allData) && isset($allData['contact_2']) && $allData['contact_2'] != '') {{ $allData['contact_2'] }} @endif">

</div>

<div class="col-sm-3">

<label for="email" class="col-form-label">Email 2</label>

<input type="text" class="form-control" name="email_2"

    id="email_2"

    value=" @if (!empty($allData) && isset($allData['email_2']) && $allData['email_2'] != '') {{ $allData['email_2'] }} @endif">

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

        $(document).ready(function() {

            var addButton = $('.add_button'); //Add button selector



            var wrapper = $('.field_wrapper'); //Input field wrapper



            //New input field html 

            var x = 1; //Initial field counter is 1



            //Once add button is clicked

            $(addButton).click(function() {

                x++; //Increment field counter

                var fieldHTML =

                    '<div class="row"><div class="col-sm-4 mb-2"><input type="text" placeholder="Heading" class="form-control" name="approaches_heading[]"></div><div class="col-sm-4 mb-2"><input type="text" placeholder="Url" class="form-control" name="approaches_content[]"></div><div class="col-sm-1 mb-2"><a href="javascript:void(0);" class="btn btn-danger remove_button">Remove</a></div></div>';

                $(wrapper).append(fieldHTML); //Add field html

            });



            //Once remove button is clicked

            $(wrapper).on('click', '.remove_button', function(e) {

                e.preventDefault();

                $(this).parent().parent('div').remove(); //Remove field html

                x--; //Decrement field counter

            });

        });

    </script>



    @include('admin.home.homepageJs')



@endsection

