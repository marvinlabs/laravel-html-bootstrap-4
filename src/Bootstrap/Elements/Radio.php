<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\WrapsFormControl;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Label;
use Spatie\Html\Elements\Span;

/**
 * A custom radio. See https://getbootstrap.com/docs/4.0/components/forms/#checkboxes-and-radios-1
 *
 * <div class="custom-control custom-radio">
 *   <input type="checkbox" class="custom-control-input" id="customCheck1">
 *   <label class="custom-control-label" for="customCheck1">Select this custom radio</label>
 * </div>
 */
class Radio extends Div
{
    use WrapsFormControl, Assemblable;

    /** @var  string|null */
    private $value;

    /** @var  string|null */
    private $description;

    public function __construct($formState)
    {
        parent::__construct();

        $this->control = (new Input($formState))->type('radio');
    }

    /** @return static */
    public function description(string $text)
    {
        $element = clone $this;
        $element->description = $text;

        return $element;
    }

    /** @return static */
    public function value(string $value)
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
        $element->control = $isChecked
            ? $element->control->attribute('checked', 'checked')
            : $element->control->forgetAttribute('checked');

        return $element;
    }

    /** @Override */
    protected function assemble()
    {
        if ($this->control === null)
        {
            return $this;
        }

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
                     ->for($this->control->getAttribute('id'))
                     ->text($this->description)
                     ->addClass('custom-control-label'));
        }

        return $element->addClass(['custom-control', 'custom-radio']);
    }

}
