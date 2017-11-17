<?php

namespace MarvinLabs\Html\Bootstrap\Tests;

use MarvinLabs\Html\Bootstrap\BootstrapServiceProvider;
use MarvinLabs\Html\Bootstrap\Facades\Bootstrap;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            BootstrapServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'BS' => Bootstrap::class,
        ];
    }
}
