<?php

namespace MarvinLabs\Html\Bootstrap\Traits;

use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Button;
use MarvinLabs\Html\Bootstrap\Elements\CheckBox;
use MarvinLabs\Html\Bootstrap\Elements\CustomFile;
use MarvinLabs\Html\Bootstrap\Elements\File;
use MarvinLabs\Html\Bootstrap\Elements\FormGroup;
use MarvinLabs\Html\Bootstrap\Elements\Input;
use MarvinLabs\Html\Bootstrap\Elements\InputGroup;
use MarvinLabs\Html\Bootstrap\Elements\Radio;
use MarvinLabs\Html\Bootstrap\Elements\RadioGroup;
use MarvinLabs\Html\Bootstrap\Elements\Select;
use MarvinLabs\Html\Bootstrap\Elements\TextArea;
use RuntimeException;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Form;

/**
 * @target \MarvinLabs\Html\Bootstrap\Bootstrap
 */
trait BuildsForms
{
    /** @var Form */
    private $currentForm;

    /** @var \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /**
     * Open a form
     *
     * @param string $method  The method to target for form action
     * @param string $action  The form action
     * @param array  $options A set of options for the form
     *
     * Valid options are:
     *
     *   - files      => bool    Does the form accept files
     *   - inline     => bool    Shall we render an inline form (Bootstrap specific)
     *   - model      => mixed   The model to bind to the form
     *   - hideErrors => bool    Hide field errors
     *
     * @return \Illuminate\Contracts\Support\Htmlable
     * @throws \Exception When trying to open a form before closing the previous one
     */
    public function openForm($method, $action, array $options = []): Htmlable
    {
        // Initialize the form state
        if ($this->formState !== null || $this->currentForm !== null)
        {
            throw new RuntimeException('You cannot open another form before closing the previous one');
        }
        $this->formState = app()->make(FormState::class);
        $this->formState->setModel($options['model'] ?? null);
        $this->formState->setHideErrors($options['hideErrors'] ?? false);

        // Create a form element with sane defaults
        $this->currentForm = Form::create();

        // Handle form method consequences (token / hidden method field)
        //
        // If Laravel needs to spoof the form's method, we'll append a hidden
        // field containing the actual method
        //
        // On any other method that get, the form needs a CSRF token
        $method = strtoupper($method);

        if (\in_array($method, ['DELETE', 'PATCH', 'PUT'], true))
        {
            $this->currentForm = $this->currentForm->addChild($this->hidden('_method', $method));
            $method = 'POST';
        }

        if ($method !== 'GET')
        {
            $this->currentForm = $this->currentForm->addChild($this->token());
        }

        if ($options['files'] ?? false)
        {
            $this->currentForm = $this->currentForm->acceptsFiles();
        }

        return $this->currentForm
            ->method($method)
            ->action($action)
            ->addClassIf($options['inline'] ?? false, 'form-inline')
            ->open();
    }

    /**
     * Close a form previously open with openForm()
     *
     * @return \Illuminate\Contracts\Support\Htmlable
     */
    public function closeForm(): Htmlable
    {
        $out = $this->currentForm->close();

        $this->currentForm = null;
        $this->formState = null;

        return $out;
    }

    /**
     * @param \Spatie\Html\BaseElement|null $control
     * @param string|null                   $label
     * @param string|null                   $helpText
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\FormGroup
     */
    public function formGroup($control = null, $label = null, $helpText = null): FormGroup
    {
        $element = new FormGroup($this->formState, $control);

        return $element->helpText($helpText)->label($label);
    }

    /**
     * @param \Spatie\Html\BaseElement|null $control
     * @param string|null                   $prefix
     * @param string|null                   $suffix
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\InputGroup
     */
    public function inputGroup($control = null, $prefix = null, $suffix = null): InputGroup
    {
        $element = new InputGroup($control);

        return $element->prefix($prefix)->suffix($suffix);
    }

    /**
     * @param string|null $type
     * @param string|null $name
     * @param string|null $value
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Input
     */
    public function input($type = null, $name = null, $value = null): Input
    {
        $value = $this->getFieldValue($name, $value);
        $element = new Input($this->formState);

        return $element
            ->typeIf($type, $type)
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name))
            ->valueIf($value !== null, $value);
    }

    /**
     * @param string|null $name
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\File
     */
    public function simpleFile($name = null): File
    {
        $element = new File($this->formState);

        return $element
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name));
    }

    /**
     * @param string|null $name
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\CustomFile
     */
    public function file($name = null, $description = null): CustomFile
    {
        $element = new CustomFile($this->formState);

        return $element
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name) . '_wrapper')
            ->description($description);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Textarea
     */
    public function textArea($name = null, $value = null): TextArea
    {
        $value = $this->getFieldValue($name, $value);
        $element = new TextArea($this->formState);

        return $element
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name))
            ->valueIf($value !== null, $value);
    }

    /**
     * @param string|null $name
     * @param string|null $description
     * @param bool        $isChecked
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\CheckBox
     */
    public function checkBox($name = null, $description = null, $isChecked = false): CheckBox
    {
        $isChecked = $this->getFieldValue($name, $isChecked);
        $element = new CheckBox($this->formState);

        return $element
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name) . '_wrapper')
            ->description($description)
            ->checked($isChecked);
    }

    /**
     * @param string|null $name
     * @param string|null $description
     * @param bool        $isChecked
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Radio
     */
    public function radio($name = null, $description = null, $isChecked = false): Radio
    {
        $isChecked = $this->getFieldValue($name, $isChecked);
        $element = new Radio($this->formState);

        return $element
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name) . '_wrapper')
            ->description($description)
            ->checked($isChecked);
    }

    /**
     * @param string|null $name
     * @param array       $options
     * @param string      $selectedOption
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\RadioGroup
     */
    public function radioGroup($name, $options, $selectedOption = null): RadioGroup
    {
        $element = new RadioGroup($this->formState);

        return $element
            ->name($name)
            ->id(field_name_to_id($name) . '_radio_group')
            ->options($options)
            ->selectedOption($selectedOption);
    }

    /**
     * @param string|null          $name
     * @param array|iterable       $options
     * @param string|iterable|null $value
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Select
     */
    public function select($name = null, $options = [], $value = null): Select
    {
        $value = $this->getFieldValue($name, $value);
        $element = new Select($this->formState);

        return $element
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name))
            ->options($options)
            ->valueIf($value !== null, $value);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Input
     */
    public function text($name = null, $value = null): Input
    {
        return $this->input('text', $name, $value);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Input
     */
    public function password($name = null, $value = null): Input
    {
        return $this->input('password', $name, $value);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Input
     */
    public function email($name = null, $value = null): Input
    {
        return $this->input('email', $name, $value);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Input
     */
    public function hidden($name = null, $value = null): Input
    {
        $value = $this->getFieldValue($name, $value);
        $element = new Input($this->formState);

        return $element
            ->type('hidden')
            ->nameIf($name, $name)
            ->valueIf($value !== null, $value);
    }

    /**
     * CSRF token hidden field
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Input
     */
    public function token(): Input
    {
        return $this->hidden('_token', $this->request->session()->token());
    }

    /**
     * @param string|\Spatie\Html\BaseElement $text
     * @param string                          $variant
     * @param bool                            $outlined
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Button
     */
    public function submit($text, $variant = 'primary', $outlined = false): Button
    {
        return $this->button($text, $variant, $outlined)->type('submit');
    }

    /**
     * @param        $text
     * @param string $variant
     * @param bool   $outlined
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Button
     */
    public function button($text, $variant = 'secondary', $outlined = false): Button
    {
        return Button::create()->variant($variant, $outlined)->text($text);
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    private function getFieldValue($name, $default)
    {
        return $this->formState !== null
            ? $this->formState->getFieldValue($name, $default)
            : $default;
    }
}
