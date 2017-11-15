<?php

namespace MarvinLabs\Html\Bootstrap\Elements\Traits;


/**
 * Trait CanBeDisabled
 * @package MarvinLabs\Html\Bootstrap\Elements\Traits
 * @target \Spatie\Html\BaseElement
 *
 *          Control can be disabled
 */
trait Disablable
{

    /**
     * Disable the control
     * @return static
     */
    public function disabled()
    {
        return $this->attribute('disabled', 'disabled');
    }


}