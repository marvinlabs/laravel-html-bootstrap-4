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
     * @param array $attrs The data attributes as an associative array (key will be appended after 'data-', value will
     *                     be used as attribute value)
     *
     * @return string The data attributes usable directly within the HTML tag
     */
    function data_attributes(array $attrs = [])
    {
        return collect($attrs)
            ->map(function ($value, $key) {
                return 'data-' . $key . '="' . $value . '"';
            })
            ->implode(' ');
    }
}

if ( !function_exists('field_name_to_id'))
{

    /**
     * Converts a valid form field name to a valid HTML ID. Transforms all dots and square brackets to some sane
     * separators accepted with ID strings.
     *
     * @param string $name
     * @param string $suffix
     *
     * @return string
     */
    function field_name_to_id($name, $suffix = '')
    {
        if (empty($name))
        {
            return $name;
        }

        $out = str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $name);
        return empty($suffix) ? $out : "${out}_${suffix}";
    }
}

if ( !function_exists('in_array_any'))
{
    /**
     * Check if any of the needles exist within the haystack
     *
     * @param array $needles
     * @param array $haystack
     *
     * @return bool
     */
    function in_array_any($needles, $haystack) {
        return (bool) array_intersect($needles, $haystack);
    }
}

if ( !function_exists('in_array_all'))
{

    /**
     * Check if all needles exist within the haystack
     *
     * @param array $needles
     * @param array $haystack
     *
     * @return bool
     */
    function in_array_all($needles, $haystack) {
        return !array_diff($needles, $haystack);
    }
}

