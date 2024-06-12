<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'registered' => App\Http\Middleware\CheckStatus::class,
            'protected_access_registro' => App\Http\Middleware\RegistroProtectedAccess::class,
            'protected_access_user' => App\Http\Middleware\UserProtectedAccess::class,
            'user' => App\Http\Middleware\RoleUser::class,
            'admin' => App\Http\Middleware\RoleAdmin::class,
            'master' => App\Http\Middleware\RoleMaster::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
