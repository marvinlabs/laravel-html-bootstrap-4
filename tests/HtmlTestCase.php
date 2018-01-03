<?php

namespace MarvinLabs\Html\Bootstrap\Tests;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Tests\Support\FakeFormState;

abstract class HtmlTestCase extends TestCase
{
    /**
     * Fake the FormState contract
     *
     * @param array $errors
     * @param array $oldInput
     * @param null  $model
     * @param bool  $shouldHideErrors
     *
     * @return \MarvinLabs\Html\Bootstrap\Tests\Support\FakeFormState
     */
    protected function fakeFormState($errors = [], $oldInput = [], $model = null, $shouldHideErrors = false)
    {
        return new FakeFormState($errors, $oldInput, $model, $shouldHideErrors);
    }

    /**
     * Form must be open in order for some controls to get access to the form state
     *
     * @param array $errors
     * @param array $oldInput
     * @param null  $model
     * @param bool  $shouldHideErrors
     * @param array $options
     *
     * @return \Illuminate\Contracts\Support\Htmlable
     */
    protected function openFakeForm($errors = [], $oldInput = [], $model = null, $shouldHideErrors = false, $options = [])
    {
        $state = $this->fakeFormState($errors, $oldInput, $model, $shouldHideErrors);
        $this->app->instance(FormState::class, $state);

        // Form must be open in order to setup form state
        return bs()->openForm('get', '/', $options);
    }
}