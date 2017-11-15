<?php

namespace MarvinLabs\Html\Bootstrap\Elements;


use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use Spatie\Html\BaseElement;
use Spatie\Html\Elements\Div;

class FormGroup extends Div
{
    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /** @var  string|null */
    private $label;

    /** @var  string|null */
    private $helpText;

    /** @var \Spatie\Html\BaseElement */
    private $control;

    private $isAssembled = false;

    /**
     * FormGroup constructor.
     *
     * @param \MarvinLabs\Html\Bootstrap\Contracts\FormState $formState
     * @param null|string                                    $label
     * @param \Spatie\Html\BaseElement                       $control
     */
    public function __construct(FormState $formState, BaseElement $control = null, $label = null)
    {
        parent::__construct();

        $this->formState = $formState;
        $this->label = $label;
        $this->control = $control;
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
     * @param string $text
     * @param bool   $small
     * @param bool   $muted
     *
     * @return static
     */
    public function helpText($text, $small = true, $muted = true)
    {
        if ($text === null)
        {
            return $this;
        }

        $element = clone $this;

        $element->helpText = $small
            ? Small::create()->text($text)
            : P::create()->text($text);

        $element->helpText = $element->helpText->addClassIf($muted, 'text-muted');

        return $element;
    }

    /** @Override */
    public function open(): Htmlable
    {
        if ($this->isAssembled) {
            return parent::open();
        }

        $element = $this->assemble();

        return $element->open();
    }

    private function assemble()
    {
        $this->isAssembled  = true;

        if ($this->control === null)
        {
            return $this;
        }

        $element = clone $this;

        $fieldName = $element->control->getAttribute('name');

        // Control
        if ($this->control !== null)
        {
            $element = $element->addChild($this->control);
        }

        // Help text
        if ($this->helpText !== null)
        {
            $element = $element->addChild($this->helpText);
        }

        // Error messages
        $error = optional($this->formState)->getFieldError($fieldName);
        if ($fieldName !== null && !empty($error))
        {
            $element = $element->addChild(Div::create()->addClass('invalid-feedback')->text($error));
        }

        return $element->addClass('form-group');
    }

}