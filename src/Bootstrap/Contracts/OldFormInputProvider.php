<?php

namespace MarvinLabs\Html\Bootstrap\Contracts;

/**
 * Interface OldFormInputProvider
 * @package MarvinLabs\Html\Bootstrap\Contracts
 *
 *          Provides old form input
 */
interface OldFormInputProvider
{

    /**
     * Get old input value for the given key
     *
     * @param string $key     The key
     * @param mixed  $default Default value to return when no value is found for the key
     *
     * @return mixed $default when there is no value for the given key. The old value else.
     */
    public function get($key, $default = null);
}