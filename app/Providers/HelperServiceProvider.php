<?php

namespace ALttP\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function boot()
    { }

    public function register()
    {
        $files = glob(app_path() . '/Helpers/*.php');

        if ($files === false) {
            return;
        }

        foreach ($files as $filename) {
            require_once($filename);
        }
    }
}
