<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\UserAuth;
use App\Http\Middleware\DisableBackBtn;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {

        $middleware->trustProxies(at: '*');

        $middleware->alias([

            'auth' => \App\Http\Middleware\Authenticate::class,

            'auth.basic' =>
                \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

            'guest' =>
                \App\Http\Middleware\RedirectIfAuthenticated::class,

            'password.confirm' =>
                \Illuminate\Auth\Middleware\RequirePassword::class,

            'verified' =>
                \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

            'can' =>
                \Illuminate\Auth\Middleware\Authorize::class,

            'admin_auth' =>
                AdminAuth::class,

            'user_auth' =>
                UserAuth::class,

            'user' =>
                UserAuth::class,

            'signed' =>
                \Illuminate\Routing\Middleware\ValidateSignature::class,

            'throttle' =>
                \Illuminate\Routing\Middleware\ThrottleRequests::class,

            'disable_back_btn' =>
                DisableBackBtn::class,

            'cache.headers' =>
                \Illuminate\Http\Middleware\SetCacheHeaders::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();