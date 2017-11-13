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

if ( !function_exists('data_attributes'))
{

    /**
     * @return string
     */
    function data_attributes($attrs = [])
    {
        return collect($attrs)
            ->map(function ($value, $key) {
                return 'data-' . $key . '="' . $value . '"';
            })
            ->implode(' ');
    }
}