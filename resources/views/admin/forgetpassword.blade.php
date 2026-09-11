<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $adminData = getAdminData();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $adminData['siteTitle'] }} | Log in</title>
    <link rel="icon" type="{{ asset('storage/media/admin' . $adminData['favicon']) }}" sizes="16x16"
        href="{{ asset('storage/media/' . $adminData['favicon']) }}">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page" style="background: #fff;">
    <div class="login-box login-box-custom">
        <div class="row">
            <div class="col-md-6" style="margin-top: auto;
            margin-bottom: auto;">
                <div class="login-logo">
                    <img src="{{ asset('storage/media/admin/' . $adminData['logo']) }}" width="50%">
                </div>
            </div>
            <!-- /.login-logo -->
            <div class="col-md-3 login-box-card">
                {{-- <div class="login-logo">
                    <img src="{{ asset('storage/media/admin/' . $adminData['logo']) }}" width="30%"><br>

                </div> --}}
                <div class="svgContainer">
                    <div>
                        @include('admin.loginSvg')
                    </div>
                </div>
                <div class="card" style="box-shadow:2px 2px 5px #000;bottom:25px">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Forgot Password</p>

                        @if (session()->has('error'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif


                        <form action="{{ route('admin.forgetPasswordForm') }}" method="post">

                            @csrf

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="singin-email-2"
                                    placeholder="Your Email" name="loginemail">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="otp"
                                    placeholder="OTP" name="otp">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <!-- /.col -->

                                <div class="col-6">

                                    <button type="submit" class="btn btn-success btn-block">Send OTP</button>

                                </div>

                                <!-- /.col -->

                            </div>

                        </form>

                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.login-box -->


    <!-- jQuery -->
    <script src="{{ URL::asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
    @include('admin.loginScript')


</body>

</html>
