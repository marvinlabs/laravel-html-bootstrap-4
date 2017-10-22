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
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'bs');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'bs');

        if ($this->app->runningInConsole())
        {
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/bs'),
            ], 'views');

            $this->publishes([
                __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/bs'),
            ], 'lang');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Bootstrap::class);
    }

}