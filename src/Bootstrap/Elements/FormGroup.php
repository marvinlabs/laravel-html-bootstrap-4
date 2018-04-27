<?php

namespace MarvinLabs\Html\Bootstrap\Elements;


use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Label;

/**
 * Class FormGroup
 *
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Wraps a control, label, errors on that field, etc.
 */
class FormGroup extends ControlWrapper
{
    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /** @var  \Spatie\Html\Elements\Label|null */
    private $label;

    /** @var  \Spatie\Html\BaseElement|null */
    private $helpText;

    /**
     * FormGroup constructor.
     *
     * @param \MarvinLabs\Html\Bootstrap\Contracts\FormState $formState
     * @param \Spatie\Html\BaseElement                       $control
     */
    public function __construct($formState, $control = null)
    {
        parent::__construct($control, ['form-group']);
        $this->formState = $formState;
    }

    /**
     * @param string $text
     * @param bool   $screenReaderOnly
     * @param array  $extraClasses
     *
     * @return static
     */
    public function label($text, $screenReaderOnly = false, $extraClasses = [])
    {
        if ($text === null)
        {
            return $this;
        }

        $element = clone $this;
        $element->label = Label::create()
                               ->text($text)
                               ->addClassIf($screenReaderOnly, 'sr-only')
                               ->addClass('col-form-label')
                               ->addClass($extraClasses);

        return $element;
    }

    /**
     * @param string $text
     * @param bool   $small
     * @param bool   $muted
     *
     * @param null   $extraClass
     *
     * @return static
     */
    public function helpText($text, $small = true, $muted = true, $extraClass = null)
    {
        if ($text === null)
        {
            return $this;
        }

        $element = clone $this;

        $element->helpText = $small
            ? Small::create()->text($text)
            : P::create()->text($text);

        $element->helpText = $element->helpText
            ->addClassIf($extraClass !== null, $extraClass)
            ->addClassIf($muted, 'text-muted');

        return $element;
    }

    /**
     * Show the group as an horizontal row, using the specified configuration. This method should be called last
     * when the label and controls are all initialized.
     *
     * The row configuration will be taken from config("bs4.form_rows.$rowConfig")
     *
     * @param string $rowConfig The reference to the configuration (without prefix).
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\FormGroup|static
     *
     * @throws \InvalidArgumentException When the configuration does not exist
     * @throws \Psr\Container\NotFoundExceptionInterface Problem in dependency retrieval for 'config'
     * @throws \Psr\Container\ContainerExceptionInterface Problem in dependency retrieval for 'config'
     */
    public function showAsRow($rowConfig = 'default')
    {
        $rowConfig = app('config')->get("bs4.form_rows.$rowConfig", null);
        if ($rowConfig === null)
        {
            throw new \InvalidArgumentException("Unknown configuration entry: bs4.form_rows.$rowConfig");
        }

        $element = clone $this;

        // Add a class to ourselves, to the control wrapper and to the label
        $element = $element->addClass('row');

        $element->controlWrapper = $element->controlWrapper ?? Div::create();
        $element->controlWrapper = $element->controlWrapper->addClass($rowConfig['control_wrapper'] ?? []);

        $element->label = $element->label ?? $element->label('', true)->label;
        $element->label = $element->label->addClass($rowConfig['label'] ?? []);

        return $element;
    }

    protected function wrapControl()
    {
        $element = clone $this;

        $fieldName = $element->getControlAttribute('name');
        $fieldId = field_name_to_id($fieldName);
        $helpTextId = field_name_to_id($fieldName) . '_helptext';

        // Label
        if ( $element->label !== null)
        {
            $element = $element->addChild($element->label->for($fieldId));
        }

        // Control
        $controlElement = null;
        if ($element->control !== null)
        {
            $controlElement = $element->control
                ->attributeIf($element->helpText !== null, 'aria-describedby', $helpTextId);
        }

        // Help text
        $helpTextElement = null;
        if ($element->helpText !== null)
        {
            $helpTextElement = $element->helpText->id($helpTextId);
        }

        // Error messages
        $errorElement = null;
        if ($element->formState !== null && !$element->formState->shouldHideErrors())
        {
            $error = $element->formState->getFieldError($fieldName);
            if ($fieldName !== null && !empty($error))
            {
                $errorElement = Div::create()
                                   ->addClass(['invalid-feedback'])
                                   ->text($error);
            }
        }

        // Wrap it all up
        if ($element->controlWrapper !== null)
        {
            $element->controlWrapper = $element->controlWrapper
                ->addChildIf($controlElement !== null, $controlElement)
                ->addChildIf($helpTextElement !== null, $helpTextElement)
                ->addChildIf($errorElement !== null, $errorElement);

            $element = $element->addChild($element->controlWrapper);
        }
        else
        {
            $element = $element
                ->addChildIf($controlElement !== null, $controlElement)
                ->addChildIf($helpTextElement !== null, $helpTextElement)
                ->addChildIf($errorElement !== null, $errorElement);
        }

        return $element;
    }

}
