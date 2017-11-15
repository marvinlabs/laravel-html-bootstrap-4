<?php

namespace MarvinLabs\Html\Bootstrap\Elements\Traits;

use Illuminate\Contracts\Support\Htmlable;


/**
 * Trait Assemblable
 * @package MarvinLabs\Html\Bootstrap\Elements\Traits
 * @target \Spatie\Html\BaseElement
 *
 *          Element which needs to be assembled before it can be rendered
 */
trait Assemblable
{

    /** @var bool */
    protected $isAssembled = false;

    /** @Override */
    public function open(): Htmlable
    {
        if ($this->isAssembled)
        {
            /** @noinspection PhpUndefinedClassInspection */
            return parent::open();
        }

        $element = $this->assemble();
        $element->isAssembled = true;

        return $element->open();
    }

    /**
     * Prepare the element before it gets rendered
     *
     * @return static
     */
    protected function assemble()
    {
    }
}