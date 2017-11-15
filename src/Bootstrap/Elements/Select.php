<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Traits\CanBeDisabled;
use MarvinLabs\Html\Bootstrap\Elements\Traits\HasControlSize;
use Spatie\Html\Elements\Select as BaseSelect;

/**
 * Class Select
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Select element with some BS4 helpers
 */
class Select extends BaseSelect
{
    use HasControlSize, CanBeDisabled;

    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /** @var bool  */
    private $isAssembled = false;

    /**
     * Select constructor.
     *
     * @param FormState $formState
     */
    public function __construct($formState)
    {
        parent::__construct();
        $this->formState = $formState;
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

        $element = $this->addClass('custom-select');

        // Add class for fields with error
        if (optional($this->formState)->hasFieldErrors($this->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element;
    }

}
