<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use BadMethodCallException;
use MarvinLabs\Html\Bootstrap\Contracts\ShowsErrors;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use Spatie\Html\Elements\Div;

abstract class ControlWrapper extends Div implements ShowsErrors
{
    use Assemblable;

    /** @var \Spatie\Html\BaseElement */
    protected $control;

    /** @var array */
    protected $initialClasses;

    /** @var \Spatie\Html\BaseElement */
    protected $controlWrapper = null;

    /** @var array */
    protected $delegatedControlAttributes;

    /** @var \Spatie\Html\BaseElement */
    protected $error = null;

    public function __construct($control,
                                array $initialClasses = [],
                                array $delegatedControlAttributes = ['name', 'disabled'])
    {
        parent::__construct();
        $this->control = $control;
        $this->initialClasses = $initialClasses;
        $this->delegatedControlAttributes = $delegatedControlAttributes;
    }

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
        if (\in_array($attribute, $this->delegatedControlAttributes, true))
        {
            return $this->getControlAttribute($attribute, $fallback);
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
        $element->control = $this->control->nameIf($name, $name);

        return $element;
    }

    /**
     * @param \Spatie\Html\BaseElement $control
     *
     * @return static
     */
    public function control($control)
    {
        $element = clone $this;
        $element->control = $control;

        return $element;
    }

    public function showError($error)
    {
        if ($error === null)
        {
            return $this;
        }

        $element = clone $this;
        $element->error = $error;

        return $element;
    }

    protected function assemble()
    {
        if ($this->control === null)
        {
            return $this;
        }

        $element = $this->wrapControl();

        if ($element->control->getAttribute('id') === null)
        {
            $element->control = $element->control
                ->attribute('id', \field_name_to_id($element->control->getAttribute('name')));
        }

        if ($element->error !== null)
        {
            $element = $element->addChildren($element->error);
        }

        return $element->addClass($this->initialClasses);
    }

    abstract protected function wrapControl();

    public function __call($name, $arguments)
    {
        // Control setters
        foreach (['control' => '', 'forgetControl' => 'forget', 'addControl' => 'add'] as $needle => $replacement)
        {
            if ($name !== $needle && starts_with($name, $needle))
            {
                $name = str_replace($needle, $replacement, $name);
                if (empty($name))
                {
                    return parent::__call($name, $arguments);
                }

                if (empty($replacement))
                {
                    $name = \lcfirst($name);
                }

                if (!method_exists($this->control, $name))
                {
                    throw new BadMethodCallException("$name is not a valid method for the wrapped control");
                }

                $element = clone $this;
                $element->control = $this->control->{$name}(...$arguments);
                return $element;
            }
        }

        // Control getters
        if (starts_with($name, 'getControl'))
        {
            $name = str_replace('getControl', 'get', $name);
            if (empty($name))
            {
                return $this->control;
            }

            if (!method_exists($this->control, $name))
            {
                throw new BadMethodCallException("$name is not a valid method for the wrapped control");
            }

            return $this->control->{$name}(...$arguments);
        }

        return parent::__call($name, $arguments);
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
