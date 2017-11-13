<?php

namespace MarvinLabs\Html\Bootstrap\Traits;

use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use RuntimeException;
use Spatie\Html\Elements\Form;
use Spatie\Html\Elements\Input;

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
     *   - files  => boolean    Does the form accept files
     *   - inline => boolean    Shall we render an inline form (Bootstrap specific)
     *   - model  => mixed      The model to bind to the form
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

        // Create a form element with sane defaults
        $this->currentForm = Form::create();

        // Handle form method consequences (token / hidden method field)
        //
        // If Laravel needs to spoof the form's method, we'll append a hidden
        // field containing the actual method
        //
        // On any other method that get, the form needs a CSRF token
        $method = strtoupper($method);

        if (in_array($method, ['DELETE', 'PATCH', 'PUT'], true))
        {
            $this->currentForm = $this->currentForm->addChild($this->hidden('_method', $method));
            $method = 'POST';
        }

        if ($method !== 'GET')
        {
            $this->currentForm = $this->currentForm->addChild($this->token());
        }

        return $this->currentForm
            ->method($method)->action($action)
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
     * @param string|null $type
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Spatie\Html\Elements\Input
     */
    public function input($type = null, $name = null, $value = null)
    {
        $value = $this->formState->getFieldValue($name, $value);

        return Input::create()
            ->addClass('form-control')
            ->typeIf($type, $type)
            ->nameIf($name, $name)
            ->idIf($name, field_name_to_id($name))
            ->valueIf($value !== null, $value);
    }

    public function submit($text)
    {
        return $this->html->button($text);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Spatie\Html\Elements\Input
     */
    public function hidden($name = null, $value = null): Input
    {
        $value = $this->formState->getFieldValue($name, $value);

        return Input::create()
            ->type('hidden')
            ->nameIf($name, $name)
            ->valueIf($value !== null, $value);
    }

    /**
     * @return \Spatie\Html\Elements\Input
     */
    public function token(): Input
    {
        return $this->hidden('_token', $this->request->session()->token());
    }
}