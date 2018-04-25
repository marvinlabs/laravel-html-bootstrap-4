<?php

namespace MarvinLabs\Html\Bootstrap\Elements\Traits;


/**
 * Control which can be disabled
 *
 * @target \Spatie\Html\BaseElement
 */
trait Disablable
{
    public function disabled($disabled = true)
    {
        return $disabled
            ? $this->attribute('disabled', 'disabled')
            : $this->forgetAttribute('disabled');
    }
}
