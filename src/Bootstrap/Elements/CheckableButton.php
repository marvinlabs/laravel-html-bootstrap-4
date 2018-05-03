<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Spatie\Html\BaseElement;
use Spatie\Html\Elements\Label;

/**
 * A button which can be checked. Checkbox or radio
 */
abstract class CheckableButton extends ControlWrapper
{
    /** @var  string|null */
    protected $value;

    /** @var  string|null */
    protected $description;

    /** @var boolean */
    protected $inline = false;

    public function __construct($formState, $controlType)
    {
        if (!\in_array($controlType, ['checkbox', 'radio']))
        {
            throw new \RuntimeException('This base class is currently meant only for checkboxes and radios');
        }

        parent::__construct(
            (new Input($formState))->type($controlType),
            ['custom-control', "custom-$controlType"]);
    }

    /**
     * @param string|null $text
     * @return static
     */
    public function description($text)
    {
        $element = clone $this;
        $element->description = $text;

        return $element;
    }

    /**
     * @param string|null $value
     * @return static
     */
    public function value($value)
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
     * @param  bool|string|int $isChecked
     *
     * @return static
     */
    public function checked($isChecked = true)
    {
        $isChecked = $isChecked
                     || $isChecked === 'y'
                     || $isChecked === 1;

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
        $element->control = $element->control
            ->addClass('custom-control-input')
            ->value($element->value ?? '1')
            ->id($this->controlId($element));

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

    protected function controlId(BaseElement $element): string
    {
        return \field_name_to_id($element->getAttribute('name'));
    }


}
