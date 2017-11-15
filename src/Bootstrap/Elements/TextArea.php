<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Disablable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\SizableControl;
use Spatie\Html\Elements\TextArea as BaseTextArea;

/**
 * Class TextArea
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          TextArea element with some BS4 helpers
 */
class TextArea extends BaseTextArea
{
    use SizableControl, Disablable, Assemblable;

    /** @var bool Show the input as plain text (used in conjunction with readonly) */
    private $plainText = false;

    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /**
     * TextArea constructor.
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
        $element = $this->addClass($this->plainText ? 'form-control-plaintext' : 'form-control');

        // Add class for fields with error
        if (optional($this->formState)->hasFieldErrors($this->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element;
    }
}
