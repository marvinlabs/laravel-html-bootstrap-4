<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

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

    /** @Override */
    public function open()
    {
        // Set the control class if necessary.
        // To avoid infinite recursion, we will check if we already have those classes in our attributes.
        $classes = explode(' ', $this->getAttribute('class', []));
        if (in_array('form-control', $classes, true))
        {
            return parent::open();
        }

        // Add the class, then render that element
        $element = $this->addClass('form-control');

        return $element->open();
    }

}
