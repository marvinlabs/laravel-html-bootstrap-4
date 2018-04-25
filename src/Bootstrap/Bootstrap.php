<?php

namespace MarvinLabs\Html\Bootstrap;

use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use MarvinLabs\Html\Bootstrap\Traits\BuildsForms;
use MarvinLabs\Html\Bootstrap\Traits\BuildsSimpleComponents;
use MarvinLabs\Html\Bootstrap\Traits\BuildsStylesAndScripts;
use MarvinLabs\Html\Bootstrap\Traits\DelegatesToSpatie;
use Spatie\Html\Html;

/**
 * Class Bootstrap
 * @package MarvinLabs\Html\Bootstrap
 *
 *          Extend Spatie's HTML builder in order to automatically inject what Bootstrap likes and some other libraries
 *          too
 */
class Bootstrap
{
    use Macroable, BuildsStylesAndScripts, BuildsForms, BuildsSimpleComponents, DelegatesToSpatie;

    /** @var \Spatie\Html\Html */
    protected $html;

    /** @var \Illuminate\Http\Request */
    protected $request;

    /**
     * Bootstrap constructor.
     *
     * @param \Spatie\Html\Html        $html
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Html $html, Request $request)
    {
        $this->html = $html;
        $this->request = $request;
    }

}
