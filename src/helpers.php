<?php

use MarvinLabs\Html\Bootstrap\Bootstrap;

if ( !function_exists('bs'))
{

    /**
     * @return \MarvinLabs\Html\Bootstrap\Bootstrap
     */
    function bs()
    {
        return app(Bootstrap::class);
    }
}