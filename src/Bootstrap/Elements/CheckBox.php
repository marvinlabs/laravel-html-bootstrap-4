<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\WrapsFormControl;
use Spatie\Html\Elements\Label;
use Spatie\Html\Elements\Span;

/**
 * Class CheckBox
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          A custom checkbox. See https://getbootstrap.com/docs/4.0/components/forms/#checkboxes-and-radios-1
 *
 * <label class="custom-control custom-checkbox">
 *     <input type="checkbox" class="custom-control-input">
 *     <span class="custom-control-indicator"></span>
 *     <span class="custom-control-description">Check this custom checkbox</span>
 * </label>
 */
class CheckBox extends Label
{
    use WrapsFormControl, Assemblable;

    /** @var  string|null */
    private $description;

    /**
     * FormGroup constructor.
     *
     * @param \MarvinLabs\Html\Bootstrap\Contracts\FormState $formState
     */
    public function __construct($formState)
    {
        parent::__construct();

        $this->control = (new Input($formState))->type('checkbox');
    }

    /**
     * @param string $text
     *
     * @return static
     */
    public function description($text)
    {
        $element = clone $this;
        $element->description = $text;

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

        // Input field (hidden by CSS)
        if ($element->control !== null)
        {
            $element = $element->addChild($this->control);
        }

        // Custom indicator
        $element = $element->addChild(Span::create()->addClass('custom-control-indicator'));

        // Description
        if ($this->description !== null)
        {
            $element = $element->addChild(
                Span::create()->text($this->description)->addClass('custom-control-description'));
        }

        return $element->addClass(['custom-control', 'custom-checkbox']);
    }

}