<?php

namespace MarvinLabs\Html\Bootstrap\Forms;

use MarvinLabs\Html\Bootstrap\Contracts\FormErrorProvider;
use MarvinLabs\Html\Bootstrap\Contracts\FormState as FormStateContract;
use MarvinLabs\Html\Bootstrap\Contracts\OldFormInputProvider;

/**
 * Class FormState
 * @package MarvinLabs\Html\Bootstrap\Forms
 */
class FormState implements FormStateContract
{

    /** @var \MarvinLabs\Html\Bootstrap\Contracts\OldFormInputProvider */
    private $oldInput;

    /** @var \MarvinLabs\Html\Bootstrap\Contracts\FormErrorProvider */
    private $errors;

    /** @var mixed */
    private $model;

    /** @var bool */
    private $shouldHideErrors;

    /**
     * Bootstrap constructor.
     *
     * @param \MarvinLabs\Html\Bootstrap\Contracts\OldFormInputProvider $oldInput
     * @param \MarvinLabs\Html\Bootstrap\Contracts\FormErrorProvider    $errors
     */
    public function __construct(OldFormInputProvider $oldInput, FormErrorProvider $errors)
    {
        $this->oldInput = $oldInput;
        $this->errors = $errors;
        $this->shouldHideErrors = false;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getFieldValue($name, $default = null)
    {
        // If there's no default value provided, and the html builder currently
        // has a model assigned, try to retrieve a value from the model.
        if (empty($default) && $this->model !== null)
        {
            $default = $this->model[$name] ?? null;
        }

        return $this->oldInput->get($name, $default);
    }

    public static function getSafeName($name)
    {
        $name = str_replace('[', '.', $name);
        $name = str_replace(']', '', $name);

        return $name;
    }

    public function hasFieldErrors($name): bool
    {

        $all = $this->errors->all(self::getSafeName($name));

        return !empty($all);
    }

    public function getFieldErrors($name)
    {
        return $this->errors->all(self::getSafeName($name));
    }

    public function getFieldError($name)
    {
        return $this->errors->first(self::getSafeName($name));
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