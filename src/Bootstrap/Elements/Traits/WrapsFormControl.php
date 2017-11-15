<?php
/**
 * Created by PhpStorm.
 * User: vprat
 * Date: 15/11/2017
 * Time: 21:34
 */

namespace MarvinLabs\Html\Bootstrap\Elements\Traits;


trait WrapsFormControl
{

    /** @var \Spatie\Html\BaseElement */
    private $control;

    public function getAttribute($attribute, $fallback = null)
    {
        if ($attribute === 'name')
        {
            return $this->control->getAttribute($attribute, $fallback);
        }

        return parent::getAttribute($attribute, $fallback);
    }

    /**
     * @param \Spatie\Html\BaseElement $control
     *
     * @return static
     */
    public function control($control)
    {
        if ($control === null)
        {
            return $this;
        }

        $element = clone $this;
        $element->control = $control;

        return $element;
    }
}