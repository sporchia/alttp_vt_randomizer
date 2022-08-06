<?php

namespace Tests;

use App\Graph\Randomizer;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        // temp fix for caching in tests
        Randomizer::$hashes = [];
        Randomizer::$hash_graphs = [];

        return $app;
    }
}
