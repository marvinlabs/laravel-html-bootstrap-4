<?php

namespace MarvinLabs\Html\Bootstrap\Forms;

use Illuminate\Session\Store;
use Illuminate\Support\MessageBag;
use MarvinLabs\Html\Bootstrap\Contracts\FormErrorProvider as FormErrorProviderContract;

/**
 * Class FormErrorProvider
 * @package MarvinLabs\Html\Bootstrap\Forms
 *
 *          Provides old input as stored by default in Laravel
 */
class FormErrorProvider implements FormErrorProviderContract
{
    /** @var \Illuminate\Session\Store */
    private $session;

    /** @var MessageBag */
    private $errors;

    /**
     * SessionOldInputProvider constructor.
     *
     * @param \Illuminate\Session\Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function all($name)
    {
        return $this->getErrors()->get($name) ?? [];
    }

    public function first($name)
    {
        return $this->getErrors()->first($name);
    }

    protected function hasErrors()
    {
        return $this->session->has('errors');
    }

    protected function getErrors()
    {
        if ($this->errors === null)
        {
            $this->errors = $this->hasErrors()
                ? $this->session->get('errors')
                : new MessageBag();
        }

        return $this->errors;
    }
}