<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Elements\Traits\CanBeDisabled;
use MarvinLabs\Html\Bootstrap\Elements\Traits\HasControlSize;
use Spatie\Html\Elements\TextArea as BaseTextArea;

/**
 * Class TextArea
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          TextArea element with some BS4 helpers
 */
class TextArea extends BaseTextArea
{
    use HasControlSize, CanBeDisabled;

    /** @var bool Show the input as plain text (used in conjunction with readonly) */
    private $plainText = false;

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
        if (in_array('form-control', $classes, true)
            || in_array('form-control-plaintext', $classes, true))
        {
            return parent::open();
        }

        // Add the classes conditionally, then render that element
        $element = $this->addClass($this->plainText ? 'form-control-plaintext' : 'form-control');

        return $element->open();
    }
}
