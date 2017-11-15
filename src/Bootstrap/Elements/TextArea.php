<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Contracts\FormState;
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

    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /** @var bool  */
    private $isAssembled = false;

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
    public function open(): Htmlable
    {
        if ($this->isAssembled)
        {
            return parent::open();
        }

        $element = $this->assemble();

        return $element->open();
    }

    /**
     * Prepare the element before it gets rendered
     *
     * @return static
     */
    protected function assemble()
    {
        $this->isAssembled = true;

        $element = $this->addClass($this->plainText ? 'form-control-plaintext' : 'form-control');

        // Add class for fields with error
        if (optional($this->formState)->hasFieldErrors($this->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element;
    }
}
