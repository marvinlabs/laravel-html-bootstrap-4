<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Spatie\Html\Elements\Label;

/**
 * A custom radio. See https://getbootstrap.com/docs/4.0/components/forms/#checkboxes-and-radios-1
 *
 * <div class="custom-control custom-radio">
 *   <input type="checkbox" class="custom-control-input" id="customCheck1">
 *   <label class="custom-control-label" for="customCheck1">Select this custom radio</label>
 * </div>
 */
class Radio extends ControlWrapper
{
    /** @var  string|null */
    private $value;

    /** @var  string|null */
    private $description;

    /** @var boolean */
    private $inline = false;

    public function __construct($formState)
    {
        parent::__construct(
            (new Input($formState))->type('radio'),
            ['custom-control', 'custom-radio']);
    }

    /**
     * @param string|null $text
     * @return static
     */
    public function description(string $text)
    {
        $element = clone $this;
        $element->description = $text;

        return $element;
    }

    /**
     * @param string|null $value
     * @return static
     */
    public function value(string $value)
    {
        $element = clone $this;
        $element->value = $value;

        return $element;
    }

    /**
     * @return null|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param bool $inline
     * @return static
     */
    public function inline($inline = true)
    {
        $element = clone $this;
        $element->inline = $inline;

        return $element;
    }

    /**
     * @param  bool $isChecked
     *
     * @return static
     */
    public function checked($isChecked = true)
    {
        $element = clone $this;
        return $isChecked
            ? $element->controlAttribute('checked', 'checked')
            : $element->forgetControlAttribute('checked');
    }

    public function disabled($disabled = true)
    {
        $element = clone $this;
        return $disabled
            ? $element->controlAttribute('disabled', 'disabled')
            : $element->forgetControlAttribute('disabled');
    }

    protected function wrapControl()
    {
        $element = clone $this;
        $element->control = $element->control
            ->addClass('custom-control-input')
            ->value($element->value ?? '1')
            ->id($element->getAttribute('name') . '_' . ($element->value ?? '1'));

        $element = $element->addChild($element->control);

        // Label
        if ($this->description !== null)
        {
            $element = $element->addChild(
                Label::create()
                     ->for($element->getControlAttribute('id'))
                     ->html($element->description)
                     ->addClass('custom-control-label'));
        }

        return $element->addClassIf($element->inline, 'custom-control-inline');
    }

}
