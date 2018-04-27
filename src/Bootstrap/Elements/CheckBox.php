<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Spatie\Html\Elements\Label;

/**
 * A custom checkbox. See https://getbootstrap.com/docs/4.0/components/forms/#checkboxes-and-radios-1
 *
 * <div class="custom-control custom-checkbox">
 *   <input type="checkbox" class="custom-control-input" id="customCheck1">
 *   <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
 * </div>
 */
class CheckBox extends ControlWrapper
{
    /** @var  string|null */
    private $value;

    /** @var  string|null */
    private $description;

    public function __construct($formState)
    {
        parent::__construct(
            (new Input($formState))->type('checkbox'),
            ['custom-control', 'custom-checkbox']);
    }

    /** @return static */
    public function description($text)
    {
        $element = clone $this;
        $element->description = $text;

        return $element;
    }

    /** @return static */
    public function value($value)
    {
        $element = clone $this;
        $element->value = $value;

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

    /**
     * @param bool $disabled
     *
     * @return static
     */
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

        // Input field
        if ($element->control !== null)
        {
            $element = $element->addChild(
                $this->control
                    ->addClass('custom-control-input')
                    ->value($this->value ?? '1'));
        }

        // Label
        if ($this->description !== null)
        {
            $element = $element->addChild(
                Label::create()
                     ->for($this->getControlAttribute('id'))
                     ->text($this->description)
                     ->addClass('custom-control-label'));
        }

        return $element;
    }

}
