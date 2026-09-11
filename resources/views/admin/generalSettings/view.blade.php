@extends('admin/layout')

@section('page_title', $pageTitle)

@section('info','General Settings',)

@section('Admin', 'menu-open')

@section('generalsettings', 'active')

@section('container')



    <div class="content-wrapper">

        <!-- Content Header (Page header) -->



        <!-- /.content-header -->

        <form action="{{ route('admin.generalsettings-form') }}" class="form-horizontal" method="post"

            enctype="multipart/form-data">

            @csrf

            <div class="card">

                <div class="card-header card-header-sticky">

                    <h3 class="card-title" style="font-size: 1.6em">@yield('page_title') <sup><a href="#"

                                data-toggle="tooltip" data-placement="top" title="@yield('info')"></a></sup></h3>

                    <div class="card-tools">

                        <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i

                                class="fa fa-check"></i></button>

                        |

                        <a href="{{ url('admin/generalsettings') }}" class="btn btn-warning btn-sm btn-badge"><i

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

                                        <div class="col-sm-4">



                                            <label for="logo" class="col-form-label">Site Logo</label>

                                            {{-- Image Section Start --}}

                                            <div class="row imageSection">

                                                <div class="col-md-3">

                                                    <label class="btn btn-sm btn-info" for="logo">Upload File</label>

                                                    <input id="logo" name="logo" type="file" class="form-control hide image"

                                                        aria-required="true" aria-invalid="false">

                                                    <span class="text-danger error-text logo_err"></span>

                                                </div>

                                                {{-- <div class="col-md-9">

                                                    <button type="button" class="btn btn-sm btn-info chooseFile logo"

                                                        id="logoId">Choose

                                                        From

                                                        Gallery</button>

                                                    <input type="hidden" name="logoGallery" class="imageGallery">

                                                </div> --}}



                                                <div class="col-md-12 previewBox">

                                                    @if (isset($allData['logo']))

                                                        <img src="{{ asset('storage/media/admin/' . $allData['logo']) }}"

                                                            class="preview-image-before-upload logo" width="100px" />

                                                    @else

                                                        <img src="{{ asset('storage/media/admin/placeholder.png') }}"

                                                            class="preview-image-before-upload logo" width="100px" />

                                                    @endif



                                                </div>

                                            </div>

                                            {{-- Image Section END --}}



                                        </div>



                                        <div class="col-sm-4">



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

                                                {{-- <div class="col-md-9">

                                                    <button type="button" class="btn btn-sm btn-info chooseFile favicon"

                                                        id="faviconId">Choose From

                                                        Gallery</button>

                                                    <input type="hidden" name="faviconGallery" class="imageGallery">

                                                </div> --}}



                                                <div class="col-md-12 previewBox">

                                                    @if (isset($allData['favicon']))

                                                        <img src="{{ asset('storage/media/admin/' . $allData['favicon']) }}"

                                                            class="preview-image-before-upload" width="100px" />

                                                    @else

                                                        <img src="{{ asset('storage/media/admin/placeholder.png') }}"

                                                            class="preview-image-before-upload" width="100px" />

                                                    @endif



                                                </div>

                                            </div>

                                            {{-- Image Section END --}}



                                        </div>



                                        <div class="col-sm-4">



                                            <label for="loader" class="col-form-label">Loader</label>

                                            {{-- Image Section Start --}}

                                            <div class="row imageSection">

                                                <div class="col-md-3">

                                                    <label class="btn btn-sm btn-info" for="loader">Upload File</label>

                                                    <input id="loader" name="loader" type="file"

                                                        class="form-control hide image" aria-required="true"

                                                        aria-invalid="false">

                                                    <span class="text-danger error-text loader_err"></span>

                                                </div>

                                                {{-- <div class="col-md-9">

                                                    <button type="button" class="btn btn-sm btn-info chooseFile loader"

                                                        id="loaderId">Choose From

                                                        Gallery</button>

                                                    <input type="hidden" name="loaderGallery" class="imageGallery">

                                                </div> --}}



                                                <div class="col-md-12 previewBox">

                                                    @if (isset($allData['loader']))

                                                        <img src="{{ asset('storage/media/admin/' . $allData['loader']) }}"

                                                            class="preview-image-before-upload" width="100px" />

                                                    @else

                                                        <img src="{{ asset('storage/media/admin/placeholder.png') }}"

                                                            class="preview-image-before-upload" width="100px" />

                                                    @endif



                                                </div>

                                            </div>

                                            {{-- Image Section END --}}



                                        </div>



                                        <div class="col-sm-6">

                                            <label for="loaderBackground" class="col-form-label">Loader Background</label>

                                            <input type="color" id="loaderBackground"

                                                value="{{ $allData['loaderBackground'] }}" name="loaderBackground"

                                                class="form-control">

                                        </div>



                                        {{-- <div class="col-sm-6">



                                            <label for="placeholderImage" class="col-form-label">Default Image

                                                Placeholder</label>

                                            <div class="row imageSection">

                                                <div class="col-md-3">

                                                    <label class="btn btn-sm btn-info" for="placeholderImage">Upload

                                                        File</label>

                                                    <input id="placeholderImage" name="placeholderImage" type="file"

                                                        class="form-control hide image" aria-required="true"

                                                        aria-invalid="false">

                                                    <span class="text-danger error-text placeholderImage_err"></span>

                                                </div>

                                                <div class="col-md-9">

                                                    <button type="button"

                                                        class="btn btn-sm btn-info chooseFile placeholderImage"

                                                        id="placeholderImageId">Choose From

                                                        Gallery</button>

                                                    <input type="hidden" name="placeholderImageGallery"

                                                        class="imageGallery">

                                                </div>



                                                <div class="col-md-12 previewBox">

                                                    @if (isset($allData['placeholderImage']))

                                                        <img src="{{ asset('storage/media/admin/' . $allData['placeholderImage']) }}"

                                                            class="preview-image-before-upload" width="100px" />

                                                    @else

                                                        <img src="{{ asset('storage/media/admin/placeholder.png') }}"

                                                            class="preview-image-before-upload" width="100px" />

                                                    @endif



                                                </div>

                                            </div>



                                        </div> --}}

                                        <div class="col-sm-6">

                                            <div class="form-group row">

                                                <div class="col-sm-12">

                                                    <label for="logo" class="col-form-label">Site Title</label>

                                                    <input id="siteTitle"

                                                        value="@if (!empty($allData) && isset($allData['siteTitle']) && $allData['siteTitle'] != '') {{ $allData['siteTitle'] }} @endif"

                                                        name="siteTitle" type="text" class="form-control"

                                                        aria-required="true" aria-invalid="false">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>





                            <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">Colors</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>



                                <div class="card-body">

                                    <div class="form-group row">

                                        <div class="col-sm-2">

                                            <label for="primaryColor" class="col-form-label">Primary Color</label>

                                            <input type="color" id="primaryColor" value="{{ $allData['primaryColor'] }}"

                                                name="primaryColor" class="form-control">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="mainMenuBackgroundColor" class="col-form-label">Main Menu BG

                                                Color</label>

                                            <input type="color" id="mainMenuBackgroundColor"

                                                value="{{ $allData['mainMenuBackgroundColor'] }}"

                                                name="mainMenuBackgroundColor" class="form-control" />

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="mainMenuTextColor" class="col-form-label">Main Menu Text

                                                Color</label>

                                            <input id="mainMenuTextColor" value="{{ $allData['mainMenuTextColor'] }}"

                                                name="mainMenuTextColor" type="color" class="form-control"

                                                aria-required="true" aria-invalid="false">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="subMenuBackgroundColor" class="col-form-label">Sub Menu BG

                                                Color</label>

                                            <input id="subMenuBackgroundColor"

                                                value="{{ $allData['subMenuBackgroundColor'] }}"

                                                name="subMenuBackgroundColor" type="color" class="form-control"

                                                aria-required="true" aria-invalid="false">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="subMenuTextColor" class="col-form-label">Sub Menu Text

                                                Color</label>

                                            <input id="subMenuTextColor" value="{{ $allData['subMenuTextColor'] }}"

                                                name="subMenuTextColor" type="color" class="form-control"

                                                aria-required="true" aria-invalid="false">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="subMenuBorderColor" class="col-form-label">Sub Menu Border

                                                Color</label>

                                            <input id="subMenuBorderColor" value="{{ $allData['subMenuBorderColor'] }}"

                                                name="subMenuBorderColor" type="color" class="form-control"

                                                aria-required="true" aria-invalid="false">

                                        </div>

                                    </div>



                                    <div class="form-group row">

                                        <div class="col-sm-2">

                                            <label for="logoBgColor" class="col-form-label">Logo BG

                                                Color</label>

                                            <input id="logoBgColor" value="{{ $allData['logoBgColor'] }}"

                                                name="logoBgColor" type="color" class="form-control" aria-required="true"

                                                aria-invalid="false">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="sidebarBgColor" class="col-form-label">Sidebar BG

                                                Color</label>

                                            <input id="sidebarBgColor" value="{{ $allData['sidebarBgColor'] }}"

                                                name="sidebarBgColor" type="color" class="form-control"

                                                aria-required="true" aria-invalid="false">

                                        </div>



                                    </div>

                                </div>

                            </div>



                            <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">Date & Time</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>



                                <div class="card-body">

                                    <div class="form-group row">

                                        <div class="col-sm-3">

                                            <label for="timeZone" class="col-form-label">Time Zone</label>

                                            <select class="form-control select2" name="timeZone" id="timeZone">

                                                @forelse ($timeZones as $timeZonesVal)

                                                    <option @if ($allData['timeZone'] == $timeZonesVal) selected @endif

                                                        value="{{ $timeZonesVal }}">{{ $timeZonesVal }}</option>

                                                @empty

                                                    <option value=""></option>

                                                @endforelse

                                            </select>

                                        </div>



                                        <div class="col-sm-3">

                                            <label for="fromMail" class="col-form-label">Date Format</label>

                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="dateFormat1"

                                                    name="dateFormat" @if ($allData['dateFormat'] == 'F j, Y') checked @endif

                                                    value="F j, Y">

                                                <label for="dateFormat1"

                                                    class="custom-control-label">{{ date('F j, Y') }} - F j, Y</label>

                                            </div>

                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="dateFormat2"

                                                    name="dateFormat" @if ($allData['dateFormat'] == 'M jS, Y') checked @endif

                                                    value="M jS, Y">

                                                <label for="dateFormat2"

                                                    class="custom-control-label">{{ date('M jS, Y') }} - M jS, Y</label>

                                            </div>

                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="dateFormat3"

                                                    name="dateFormat" @if ($allData['dateFormat'] == 'Y-m-d') checked @endif

                                                    value="Y-m-d">

                                                <label for="dateFormat3"

                                                    class="custom-control-label">{{ date('Y-m-d') }} (Y-m-d)</label>

                                            </div>

                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="customRadio4"

                                                    name="dateFormat" @if ($allData['dateFormat'] == 'm/d/Y') checked @endif

                                                    value="m/d/Y">

                                                <label for="customRadio4"

                                                    class="custom-control-label">{{ date('m/d/Y') }} (m/d/Y)</label>

                                            </div>

                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="customRadio5"

                                                    name="dateFormat" @if ($allData['dateFormat'] == 'd/m/Y') checked @endif

                                                    value="d/m/Y">

                                                <label for="customRadio5"

                                                    class="custom-control-label">{{ date('d/m/Y') }} (d/m/Y)</label>

                                            </div>

                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="customRadio6"

                                                    name="dateFormat" @if ($allData['dateFormat'] == 'custom') checked @endif

                                                    value="custom">

                                                <label for="customRadio6" class="custom-control-label">Custom: <input

                                                        type="text" name="customDateFormat" style="width: 40%"

                                                        value="@if ($allData['customDateFormat'] != '') {{ $allData['customDateFormat'] }} @else F j, Y @endif" /></label>

                                            </div>

                                        </div>



                                        <div class="col-sm-3">

                                            <label for="fromMail" class="col-form-label">Time Format</label>

                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="timeFormat1"

                                                    name="timeFormat" @if ($allData['timeFormat'] == 'g:i a') checked @endif

                                                    value="g:i a">

                                                <label for="timeFormat1"

                                                    class="custom-control-label">{{ date('g:i a') }} - g:i a</label>

                                            </div>



                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="timeFormat2"

                                                    name="timeFormat" @if ($allData['timeFormat'] == 'g:i A') checked @endif

                                                    value="g:i A">

                                                <label for="timeFormat2"

                                                    class="custom-control-label">{{ date('g:i A') }} - g:i A</label>

                                            </div>



                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="timeFormat3"

                                                    name="timeFormat" @if ($allData['timeFormat'] == 'H:i') checked @endif

                                                    value="H:i">

                                                <label for="timeFormat3" class="custom-control-label">{{ date('H:i') }}

                                                    - H:i</label>

                                            </div>



                                            <div class="custom-control custom-radio">

                                                <input class="custom-control-input" type="radio" id="customRadio4"

                                                    name="timeFormat" @if ($allData['timeFormat'] == 'custom') checked @endif

                                                    value="custom">

                                                <label for="customRadio4" class="custom-control-label">Custom: <input

                                                        type="text" name="customTimeFormat" style="width: 40%"

                                                        value="@if ($allData['customTimeFormat'] != '') {{ $allData['customTimeFormat'] }} @else g:i a @endif" /></label>

                                            </div>

                                        </div>



                                    </div>

                                </div>

                            </div>



                            {{-- <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">Mailer</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>



                                <div class="card-body">

                                    <div class="form-group row">

                                        <div class="col-sm-2">

                                            <label for="primaryColor" class="col-form-label">Mail Protocol</label>

                                            <select class="form-control select2" name="mailProtocol" id="mailProtocol">

                                                <option value="" selected>Mail Protocol</option>

                                                <option value="mail">Mail</option>

                                                <option value="smtp">SMTP</option>

                                            </select>

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="fromMail" class="col-form-label">From Mail</label>

                                            <input id="fromMail"

                                                value="@if (!empty($allData) && isset($allData['fromMail']) && $allData['fromMail'] != '') {{ $allData['fromMail'] }} @endif"

                                                name="fromMail" type="text" class="form-control">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="smtpHost" class="col-form-label">SMTP Host</label>

                                            <input id="smtpHost"

                                                value="@if (!empty($allData) && isset($allData['smtpHost']) && $allData['smtpHost'] != '') {{ $allData['smtpHost'] }} @endif"

                                                name="smtpHost" type="text" class="form-control">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="smtPort" class="col-form-label">SMTP Port</label>

                                            <input id="smtPort"

                                                value="@if (!empty($allData) && isset($allData['smtPort']) && $allData['smtPort'] != '') {{ $allData['smtPort'] }} @endif"

                                                name="smtPort" type="number" class="form-control">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="smtpUsername" class="col-form-label">SMTP Username</label>

                                            <input id="smtpUsername"

                                                value="@if (!empty($allData) && isset($allData['smtpUsername']) && $allData['smtpUsername'] != '') {{ $allData['smtpUsername'] }} @endif"

                                                name="smtpUsername" type="text" class="form-control">

                                        </div>



                                        <div class="col-sm-2">

                                            <label for="smtpPassword" class="col-form-label">SMTP Password</label>

                                            <input id="smtpPassword"

                                                value="@if (!empty($allData) && isset($allData['smtpPassword']) && $allData['smtpPassword'] != '') {{ $allData['smtpPassword'] }} @endif"

                                                name="smtpPassword" type="password" class="form-control"

                                                autocomplete="new-password">

                                        </div>



                                    </div>

                                </div>

                            </div>



                            <div class="card card-dark ">

                                <div class="card-header">

                                    <h3 class="card-title">DB Backup</h3>

                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i

                                                class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>

                            </div> --}}





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



@endsection

