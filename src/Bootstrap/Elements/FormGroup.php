<?php

namespace MarvinLabs\Html\Bootstrap\Elements;


use Illuminate\Contracts\Support\Htmlable;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Label;

/**
 * Class FormGroup
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Wraps a control, label, errors on that field, etc.
 */
class FormGroup extends Div
{
    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /** @var  \Spatie\Html\Elements\Label|null */
    private $label;

    /** @var  \Spatie\Html\BaseElement|null */
    private $helpText;

    /** @var \Spatie\Html\BaseElement */
    private $control;

    /** @var bool */
    private $isAssembled = false;

    /**
     * FormGroup constructor.
     *
     * @param \MarvinLabs\Html\Bootstrap\Contracts\FormState $formState
     * @param \Spatie\Html\BaseElement                       $control
     */
    public function __construct($formState, $control = null)
    {
        parent::__construct();

        $this->formState = $formState;
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
     * @param bool   $screenReaderOnly
     *
     * @return static
     */
    public function label($text, $screenReaderOnly = false)
    {
        if ($text === null)
        {
            return $this;
        }

        $element = clone $this;
        $element->label = Label::create()
            ->text($text)
            ->addClass('col-form-label')
            ->addClassIf($screenReaderOnly, 'sr-only');

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
        if ($this->isAssembled)
        {
            return parent::open();
        }

        $element = $this->assemble();

        return $element->open();
    }

    /**
     * Prepare the element before it gets rendered
     *
     * @return static
     */
    protected function assemble()
    {
        $this->isAssembled = true;

        if ($this->control === null)
        {
            return $this;
        }

        $element = clone $this;

        $fieldName = $element->control->getAttribute('name');
        $fieldId = field_name_to_id($fieldName);
        $helpTextId = field_name_to_id($fieldName) . '_helptext';

        // Label
        if (null !== $element->label)
        {
            $element = $element->addChild($element->label->for($fieldId));
        }

        // Control
        if ($this->control !== null)
        {
            $element = $element->addChild(
                $this->control->attributeIf($this->helpText !== null, 'aria-describedby', $helpTextId));
        }

        // Help text
        if ($this->helpText !== null)
        {
            $element = $element->addChild($this->helpText->id($helpTextId));
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