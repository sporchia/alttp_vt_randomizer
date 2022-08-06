<?php

return [
    /*
     * The Client ID to use for requests.
     */
    'client_id' => env('TWITCH_HELIX_KEY', ''),

    /*
     * The Client Secret to use for OAuth requests.
     */
    'client_secret' => env('TWITCH_HELIX_SECRET', ''),

    /*
     * The Redirect URI to use for generating OAuth authorization.
     */
    'redirect_url' => env('TWITCH_HELIX_REDIRECT_URI', ''),

    'oauth_client_credentials' => [

        /*
         * Since May 01, 2020, Twitch requires all API requests to contain a valid Access Token.
         * This can be achieved with the Client Credentials flow.
         *
         * The package will attempt to generate a Access Token for unauthenticated requests.
         * NOTICE: This will only be enabled if a Client ID and Client Secret have been specified.
         */
        'auto_generate' => true,

        /*
         * Enable caching the Access Token to minimize workload.
         */
        'cache' => true,

        /*
         * The cache driver to use for storing Client Credentials.
         */
        'cache_driver' => null,

        /*
        * The cache store to use for storing Client Credentials.
        */
        'cache_store' => null,

        /*
         * The cache key to use for storing information.
         */
        'cache_key' => 'twitch-api-client-credentials',
    ],
];
