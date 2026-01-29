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
        // PERBAIKAN DI SINI:
        $middleware->redirectTo(
            guests: '/login',      // Jika belum login, lempar ke sini
            users: '/dashboard'    // Jika sudah login, WAJIB ke sini
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();