<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Middleware\VerifyCsrfToken;
use App\Http\Middleware\RoleCheckMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (\Illuminate\Foundation\Configuration\Middleware $middleware) {
        // Daftarkan alias untuk RoleCheckMiddleware
        $middleware->alias([
            'check.role' => RoleCheckMiddleware::class,
            app()->router->aliasMiddleware('role.check', RoleCheckMiddleware::class),
        ]);
    })
    ->withExceptions(function (\Illuminate\Foundation\Configuration\Exceptions $exceptions) {
        // Tentukan pengaturan exception
    })
    ->create();
