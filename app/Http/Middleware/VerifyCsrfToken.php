<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Les URIs qui doivent être exclus de la vérification CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        'login', // exclusion temporaire pour corriger l'erreur 419
    ];
}
