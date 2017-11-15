<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Traits\CanBeDisabled;
use MarvinLabs\Html\Bootstrap\Elements\Traits\HasControlSize;
use Spatie\Html\Elements\Input as BaseInput;

/**
 * Class Input
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Input element with some BS4 helpers
 */
class Input extends BaseInput
{
    use HasControlSize, CanBeDisabled;

    /** @var bool Show the input as plain text (used in conjunction with readonly) */
    private $plainText = false;

    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /**
     * Input constructor.
     *
     * @param FormState $formState
     */
    public function __construct($formState)
    {
        parent::__construct();
        $this->formState = $formState;
    }

    /**
     * Make the input read only
     *
     * @param bool $showAsPlainText Style the input just like plain text (no border, padding, etc.)
     *
     * @return static
     */
    public function readOnly($showAsPlainText = false)
    {
        $element = clone $this;
        $element->plainText = $showAsPlainText;

        return $element->attribute('readonly', 'readonly');
    }

    /** @Override */
    public function open()
    {
        // Set the control classes if necessary. This is required to render plain text input correctly.
        // To avoid infinite recursion, we will check if we already have those classes in our attributes.
        $classes = explode(' ', $this->getAttribute('class', []));
        if (in_array_any(['form-control', 'form-control-plaintext'], $classes))
        {
            return parent::open();
        }

        // Add the classes conditionally, then render that element
        $element = $this->addClass($this->plainText ? 'form-control-plaintext' : 'form-control');

        // Add class for fields with error
        if ($element->formState!==null
            && $element->formState->hasFieldErrors($element->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element->open();
    }
}
