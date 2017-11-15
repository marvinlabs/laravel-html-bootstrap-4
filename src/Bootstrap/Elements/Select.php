<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Disablable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\SizableControl;
use Spatie\Html\Elements\Select as BaseSelect;

/**
 * Class Select
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Select element with some BS4 helpers
 */
class Select extends BaseSelect
{
    use SizableControl, Disablable, Assemblable;

    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

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
    protected function assemble()
    {
        $element = $this->addClass('custom-select');

        // Add class for fields with error
        if (optional($this->formState)->hasFieldErrors($this->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element;
    }

}
