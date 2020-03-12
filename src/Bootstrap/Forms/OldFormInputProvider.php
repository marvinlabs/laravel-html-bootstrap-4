<?php

namespace MarvinLabs\Html\Bootstrap\Forms;

use Illuminate\Http\Request;
use MarvinLabs\Html\Bootstrap\Contracts\OldFormInputProvider as OldFormInputProviderContract;

/**
 * Class OldFormInputProvider
 * @package MarvinLabs\Html\Bootstrap\Forms
 *
 *          Provides old input as stored by default in Laravel
 */
class OldFormInputProvider implements OldFormInputProviderContract
{
    /** @var Request */
    private $request;

    /**
     * SessionOldInputProvider constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($key, $default = null)
    {
        return $this->request->old($key, $default);
    }
}
