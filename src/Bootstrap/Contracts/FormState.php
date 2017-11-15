<?php

namespace MarvinLabs\Html\Bootstrap\Contracts;

/**
 * Interface FormState
 * @package MarvinLabs\Html\Bootstrap\Contracts
 *
 *          Manages the state of a form (errors, old input, bound model, etc.)
 */
interface FormState
{
    public function setModel($model);

    public function getFieldValue($name, $default = null);

    public function getFieldErrors($name);

    public function hasFieldErrors($name);

    public function getFieldError($name);
}