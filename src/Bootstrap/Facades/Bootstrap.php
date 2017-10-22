<?php

namespace MarvinLabs\Html\Bootstrap\Facades;

use Illuminate\Support\Facades\Facade;
use MarvinLabs\Html\Bootstrap\Bootstrap as BootstrapBuilder;

/**
 * Class Bootstrap
 * @package MarvinLabs\Html\Bootstrap\Facades
 *
 *          Facade for the HTML builder
 */
class Bootstrap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @see \MarvinLabs\Html\Bootstrap\Bootstrap
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BootstrapBuilder::class;
    }
}
