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
        // Alias pour le middleware CSRF
        $middleware->alias([
            'csrf' => \App\Http\Middleware\VerifyCsrfToken::class,
        ]);
    
        // Ajouter le middleware CSRF au groupe 'web'
        $middleware->appendToGroup('web', [
            \App\Http\Middleware\VerifyCsrfToken::class,
        ]);
    
        // Rediriger les invités vers '/login' s'ils ne sont pas authentifiés
        $middleware->redirectGuestsTo('/login');
    })
       
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

