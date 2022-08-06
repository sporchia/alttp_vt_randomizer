<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     */
    protected $except = [
        'seed',
        'seed/*',
        'test',
        'test/*',
        'entrance/seed',
        'entrance/seed/*',
        'randomizer',
        'customizer',
    ];
}
