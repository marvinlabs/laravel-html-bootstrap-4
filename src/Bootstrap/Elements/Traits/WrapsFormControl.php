<?php

namespace MarvinLabs\Html\Bootstrap\Elements\Traits;

/**
 * Trait WrapsFormControl
 * @package MarvinLabs\Html\Bootstrap\Elements\Traits
 *
 *          An element which wraps a control.
 */
trait WrapsFormControl
{

    /** @var \Spatie\Html\BaseElement */
    private $control;

    /** @var \Spatie\Html\BaseElement */
    private $controlWrapper = null;

    /**
     * For some attributes, return the value of the backing control instead of our own
     *
     * @param string $attribute
     * @param null   $fallback
     *
     * @return mixed
     */
    public function getAttribute($attribute, $fallback = null)
    {
        if ($attribute === 'name')
        {
            return $this->control->getAttribute($attribute, $fallback);
        }

        return parent::getAttribute($attribute, $fallback);
    }

    /**
     * @param string|null $name
     *
     * @return static
     */
    public function name($name)
    {
        $element = clone $this;
        $element->control = $this->control
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name));

        return $element;
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

    /**
     * @param \Spatie\Html\BaseElement $wrapper
     *
     * @return static
     */
    public function wrapControlIn($wrapper)
    {
        if ($wrapper === null)
        {
            return $this;
        }

        $element = clone $this;
        $element->controlWrapper = $wrapper;

        return $element;
    }
}