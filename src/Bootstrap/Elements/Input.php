<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Disablable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\SizableComponent;
use Spatie\Html\Elements\Input as BaseInput;

/**
 * Class Input
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Input element with some BS4 helpers
 */
class Input extends BaseInput
{
    use SizableComponent, Disablable, Assemblable;

    // Used by SizableComponent
    protected $sizableClass = 'form-control';

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
    protected function assemble()
    {
        $element = clone $this;

        $type = $this->getAttribute('type', 'text');

        if (\in_array($type, ['radio', 'checkbox'], true))
        {
            $element = $element->addClass('custom-control-input');
        }
        else if ($type === 'file')
        {
            $element = $element->addClass('custom-file-input');
        }
        else
        {
            $element = $element->addClass($this->plainText ? 'form-control-plaintext' : 'form-control');
        }

        // Add class for fields with error
        if ($element->formState !== null
            && $element->formState->hasFieldErrors($element->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element;
    }
}
