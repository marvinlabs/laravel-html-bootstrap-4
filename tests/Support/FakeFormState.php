<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Support;


use MarvinLabs\Html\Bootstrap\Contracts\FormState;

class FakeFormState implements FormState
{
    /** @var array */
    private $oldInput = [];

    /** @var array */
    private $errors = [];

    /** @var mixed */
    private $model;

    /** @var bool */
    private $shouldHideErrors = false;

    /**
     * FakeFormState constructor.
     *
     * @param array $oldInput
     * @param array $errors
     * @param mixed $model
     * @param bool  $shouldHideErrors
     */
    public function __construct($errors = [], $oldInput = [], $model = null, $shouldHideErrors = false)
    {
        $this->oldInput = $oldInput;
        $this->errors = $errors;
        $this->model = $model;
        $this->shouldHideErrors = $shouldHideErrors;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getFieldValue($name, $default = null)
    {
        return $this->oldInput[$name] ?? $default;
    }

    public function getFieldErrors($name)
    {
        return $this->errors[$name] ?? [];
    }

    public function hasFieldErrors($name): bool
    {
        return !empty($this->getFieldErrors($name));
    }

    public function getFieldError($name)
    {
        $errors = $this->getFieldErrors($name);

        return !empty($errors) ? $errors[0] : null;
    }

    public function setHideErrors($shouldHideErrors)
    {
        $this->shouldHideErrors = $shouldHideErrors;
    }

    public function shouldHideErrors(): bool
    {
        return $this->shouldHideErrors;
    }
}