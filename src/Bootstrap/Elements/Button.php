<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Disablable;
use Spatie\Html\Elements\Button as BaseButton;

/**
 * Class Button
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Button element with some BS4 helpers
 */
class Button extends BaseButton
{
    use Disablable, Assemblable;

    /**
     * Make the input read only
     *
     * @param bool $variant Style the input just like plain text (no border, padding, etc.)
     * @param bool $outlined
     *
     * @return static
     */
    public function variant($variant, $outlined = false)
    {
        return $this->addClass(['btn', $outlined ? "btn-outline-$variant" : "btn-$variant"]);
    }

    /** @Override */
    protected function assemble()
    {
        $element = clone $this;
//
//        $type = $this->getAttribute('type', 'text');
//
//        if (\in_array($type, ['radio', 'checkbox'], true))
//        {
//            $element = $element->addClass('custom-control-input');
//        }
//        else if ($type === 'file')
//        {
//            $element = $element->addClass('custom-file-input');
//        }
//        else
//        {
//            $element = $element->addClass($this->plainText ? 'form-control-plaintext' : 'form-control');
//        }
//
//        // Add class for fields with error
//        if ($element->formState !== null
//            && $element->formState->hasFieldErrors($element->getAttribute('name')))
//        {
//            $element = $element->addClass('is-invalid');
//        }

        return $element;
    }
}
