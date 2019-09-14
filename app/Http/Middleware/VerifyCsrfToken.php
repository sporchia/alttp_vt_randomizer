<?php

namespace ALttP\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

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
