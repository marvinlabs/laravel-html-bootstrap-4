<?php

namespace MarvinLabs\Html\Bootstrap\Contracts;

/**
 * Interface FormErrorProvider
 * @package MarvinLabs\Html\Bootstrap\Contracts
 *
 *          Provides error messages registered for the submitted form fields
 */
interface FormErrorProvider
{

    /**
     * Get all error messages for the given field
     *
     * @param string $name     The name of the field
     *
     * @return mixed $default when there is no value for the given key. The old value else.
     */
    public function all($name);

    /**
     * Get the first error message for the given field
     *
     * @param string $name     The name of the field
     *
     * @return mixed $default when there is no value for the given key. The old value else.
     */
    public function first($name);
}