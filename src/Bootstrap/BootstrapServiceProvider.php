<?php

namespace MarvinLabs\Html\Bootstrap;

use Illuminate\Support\ServiceProvider;

/**
 * Class BootstrapServiceProvider
 * @package MarvinLabs\Html\Bootstrap
 *
 *          The package's main service provider
 */
class BootstrapServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Bootstrap::class);
    }
}