<!DOCTYPE html>

<html lang="en">



<head>

    @php

        $adminData = getAdminData();

    @endphp



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>{{ $adminData['siteTitle'] }} | Login</title>



    <link rel="icon"

          href="{{ asset('storage/media/' . $adminData['favicon']) }}"

          type="image/x-icon">



    <!-- Google Font -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>



    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"

          rel="stylesheet">



    <!-- Font Awesome -->

    <link rel="stylesheet"

          href="{{ URL::asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">



    <!-- Bootstrap -->

    <link rel="stylesheet"

          href="{{ URL::asset('admin_assets/plugins/bootstrap/css/bootstrap.min.css') }}">



    <style>

        * {

            box-sizing: border-box;

        }



        body {

            margin: 0;

            min-height: 100vh;

            font-family: 'Inter', sans-serif;

            background: #f6f7fb;

        }



        .login-wrapper {

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 30px;

            position: relative;

            overflow: hidden;

            background:

                radial-gradient(circle at 10% 20%, rgba(218, 26, 34, 0.08), transparent 30%),

                radial-gradient(circle at 90% 80%, rgba(218, 26, 34, 0.07), transparent 30%),

                #f7f8fc;

        }



        /* Background decoration */

        .shape {

            position: absolute;

            border-radius: 50%;

            pointer-events: none;

        }



        .shape-one {

            width: 300px;

            height: 300px;

            background: rgba(218, 26, 34, 0.07);

            top: -130px;

            left: -100px;

        }



        .shape-two {

            width: 220px;

            height: 220px;

            background: rgba(218, 26, 34, 0.06);

            bottom: -80px;

            right: -50px;

        }



        .login-container {

            width: 100%;

            max-width: 1050px;

            min-height: 620px;

            display: grid;

            grid-template-columns: 45% 55%;

            background: #ffffff;

            border-radius: 28px;

            overflow: hidden;

            position: relative;

            z-index: 2;

            box-shadow: 0 30px 80px rgba(24, 30, 50, 0.12);

        }



        /* Left panel */

        .brand-panel {

            position: relative;

            padding: 55px;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            overflow: hidden;

            color: #ffffff;

            background:

                linear-gradient(145deg, #b90f18 0%, #da1a22 45%, #ef5350 100%);

        }



        .brand-panel::before {

            content: "";

            position: absolute;

            width: 420px;

            height: 420px;

            border: 1px solid rgba(255, 255, 255, 0.14);

            border-radius: 50%;

            right: -220px;

            top: -100px;

        }



        .brand-panel::after {

            content: "";

            position: absolute;

            width: 300px;

            height: 300px;

            border: 1px solid rgba(255, 255, 255, 0.10);

            border-radius: 50%;

            left: -180px;

            bottom: -130px;

        }



        .brand-content,

        .brand-footer {

            position: relative;

            z-index: 2;

        }



        .logo-box {

            width: 85px;

            height: 85px;

            background: #ffffff;

            border-radius: 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 12px;

            margin-bottom: 35px;

            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);

        }



        .logo-box img {

            max-width: 100%;

            max-height: 100%;

            object-fit: contain;

        }



        .brand-title {

            font-size: 36px;

            line-height: 1.2;

            font-weight: 800;

            margin: 0 0 18px;

            letter-spacing: -1px;

        }



        .brand-description {

            font-size: 15px;

            line-height: 1.8;

            color: rgba(255, 255, 255, 0.85);

            max-width: 360px;

            margin: 0;

        }



        .brand-footer {

            font-size: 13px;

            color: rgba(255, 255, 255, 0.65);

        }



        /* Right panel */

        .form-panel {

            padding: 65px 70px;

            display: flex;

            align-items: center;

            background: #ffffff;

        }



        .form-content {

            width: 100%;

            max-width: 440px;

            margin: auto;

        }



        .login-heading {

            margin-bottom: 38px;

        }



        .login-heading h1 {

            font-size: 30px;

            font-weight: 800;

            color: #181b25;

            margin: 0 0 10px;

            letter-spacing: -0.7px;

        }



        .login-heading p {

            margin: 0;

            color: #858997;

            font-size: 14px;

        }



        .alert-custom {

            border: 0;

            border-radius: 12px;

            font-size: 13px;

            padding: 13px 16px;

            margin-bottom: 22px;

            background: #fff1f1;

            color: #c62828;

        }



        .form-group-custom {

            margin-bottom: 22px;

        }



        .form-label-custom {

            display: block;

            font-size: 13px;

            font-weight: 600;

            color: #343741;

            margin-bottom: 9px;

        }



        .input-wrapper {

            position: relative;

        }



        .input-icon {

            position: absolute;

            left: 17px;

            top: 50%;

            transform: translateY(-50%);

            color: #a1a5b0;

            font-size: 15px;

            z-index: 2;

        }



        .form-input {

            width: 100%;

            height: 54px;

            border: 1px solid #e4e6ec;

            border-radius: 13px;

            padding: 0 48px;

            font-size: 14px;

            color: #252832;

            background: #fafbfc;

            outline: none;

            transition: all 0.25s ease;

        }



        .form-input::placeholder {

            color: #b0b3bc;

        }



        .form-input:hover {

            border-color: #d4d7df;

            background: #ffffff;

        }



        .form-input:focus {

            border-color: #da1a22;

            background: #ffffff;

            box-shadow: 0 0 0 4px rgba(218, 26, 34, 0.08);

        }



        .password-toggle {

            position: absolute;

            right: 17px;

            top: 50%;

            transform: translateY(-50%);

            border: 0;

            background: transparent;

            color: #9da1ab;

            cursor: pointer;

            padding: 5px;

        }



        .password-toggle:hover {

            color: #da1a22;

        }



        .login-button {

            width: 100%;

            height: 54px;

            border: 0;

            border-radius: 13px;

            background: linear-gradient(135deg, #da1a22, #b90f18);

            color: #ffffff;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            box-shadow: 0 10px 24px rgba(218, 26, 34, 0.22);

            transition: all 0.25s ease;

            margin-top: 8px;

        }



        .login-button:hover {

            transform: translateY(-2px);

            box-shadow: 0 14px 30px rgba(218, 26, 34, 0.28);

        }



        .login-button:active {

            transform: translateY(0);

        }



        .login-button i {

            margin-left: 8px;

            transition: transform 0.2s ease;

        }



        .login-button:hover i {

            transform: translateX(4px);

        }



        .login-divider {

            display: flex;

            align-items: center;

            margin: 32px 0 22px;

            color: #b1b4bd;

            font-size: 11px;

        }



        .login-divider::before,

        .login-divider::after {

            content: "";

            flex: 1;

            height: 1px;

            background: #eeeeF2;

        }



        .login-divider span {

            padding: 0 12px;

        }



        .copyright {

            text-align: center;

            font-size: 12px;

            color: #a0a3ad;

            margin: 0;

        }



        /* Responsive */

        @media (max-width: 850px) {

            .login-wrapper {

                padding: 20px;

            }



            .login-container {

                max-width: 500px;

                min-height: auto;

                grid-template-columns: 1fr;

            }



            .brand-panel {

                padding: 35px;

                min-height: 270px;

            }



            .logo-box {

                width: 65px;

                height: 65px;

                margin-bottom: 20px;

                border-radius: 16px;

            }



            .brand-title {

                font-size: 27px;

            }



            .brand-description {

                display: none;

            }



            .brand-footer {

                margin-top: 30px;

            }



            .form-panel {

                padding: 45px 35px;

            }

        }



        @media (max-width: 480px) {

            .login-wrapper {

                padding: 12px;

            }



            .login-container {

                border-radius: 20px;

            }



            .brand-panel {

                padding: 28px;

                min-height: 230px;

            }



            .brand-title {

                font-size: 24px;

            }



            .form-panel {

                padding: 35px 25px;

            }



            .login-heading h1 {

                font-size: 26px;

            }

        }

    </style>

</head>



<body>



<div class="login-wrapper">



    <!-- Background Shapes -->

    <div class="shape shape-one"></div>

    <div class="shape shape-two"></div>



    <div class="login-container">



        <!-- ================= LEFT BRAND PANEL ================= -->

        <div class="brand-panel">



            <div class="brand-content">



                <div class="logo-box">

                    <img src="{{ asset('storage/media/admin/' . $adminData['logo']) }}"

                         alt="{{ $adminData['siteTitle'] }}">

                </div>



                <h2 class="brand-title">

                    {{ $adminData['siteTitle'] }}

                </h2>



                <p class="brand-description">

                    Manage your website, content and administration

                    from one secure and powerful dashboard.

                </p>



            </div>



            <div class="brand-footer">

                <i class="fas fa-shield-alt mr-1"></i>

                Secure Administration Portal

            </div>



        </div>





        <!-- ================= RIGHT LOGIN PANEL ================= -->

        <div class="form-panel">



            <div class="form-content">



                <div class="login-heading">

                    <h1>Welcome back</h1>

                    <p>Enter your credentials to access your dashboard.</p>

                </div>





                @if (session()->has('error'))

                    <div class="alert-custom">

                        <i class="fas fa-exclamation-circle mr-2"></i>

                        {{ session('error') }}

                    </div>

                @endif





                <form action="{{ route('admin.auth') }}" method="POST">

                    @csrf



                    <!-- Username -->

                    <div class="form-group-custom">



                        <label for="email" class="form-label-custom">

                            Username

                        </label>



                        <div class="input-wrapper">



                            <i class="fas fa-user input-icon"></i>



                            <input

                                type="text"

                                name="email"

                                id="email"

                                class="form-input"

                                placeholder="Enter your username"

                                autocomplete="username"

                                required

                            >



                        </div>



                    </div>





                    <!-- Password -->

                    <div class="form-group-custom">



                        <label for="password" class="form-label-custom">

                            Password

                        </label>



                        <div class="input-wrapper">



                            <i class="fas fa-lock input-icon"></i>



                            <input

                                type="password"

                                name="password"

                                id="password"

                                class="form-input"

                                placeholder="Enter your password"

                                autocomplete="current-password"

                                required

                            >



                            <button

                                type="button"

                                class="password-toggle"

                                id="togglePassword"

                                aria-label="Show password"

                            >

                                <i class="fas fa-eye"></i>

                            </button>



                        </div>



                    </div>





                    <!-- Login -->

                    <button type="submit" class="login-button">



                        Sign In



                        <i class="fas fa-arrow-right"></i>



                    </button>



                </form>





                <div class="login-divider">

                    <span>SECURE LOGIN</span>

                </div>





                <p class="copyright">

                    © {{ date('Y') }} {{ $adminData['siteTitle'] }}.

                    All rights reserved.

                </p>



            </div>



        </div>



    </div>



</div>





<!-- jQuery -->

<script src="{{ URL::asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>



<!-- Bootstrap -->

<script src="{{ URL::asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



<script>

    document.addEventListener('DOMContentLoaded', function () {



        const password = document.getElementById('password');

        const togglePassword = document.getElementById('togglePassword');



        togglePassword.addEventListener('click', function () {



            const isPassword = password.type === 'password';



            password.type = isPassword ? 'text' : 'password';



            this.innerHTML = isPassword

                ? '<i class="fas fa-eye-slash"></i>'

                : '<i class="fas fa-eye"></i>';



            this.setAttribute(

                'aria-label',

                isPassword ? 'Hide password' : 'Show password'

            );

        });



    });

</script>



</body>

</html>