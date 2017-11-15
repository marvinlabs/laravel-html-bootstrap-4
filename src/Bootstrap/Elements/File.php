<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Traits\CanBeDisabled;
use MarvinLabs\Html\Bootstrap\Elements\Traits\HasControlSize;
use Spatie\Html\Elements\File as BaseFile;

/**
 * Class File
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          File element with some BS4 helpers
 */
class File extends BaseFile
{
    use HasControlSize, CanBeDisabled;

    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    /** @var bool  */
    private $isAssembled = false;

    /**
     * File constructor.
     *
     * @param FormState $formState
     */
    public function __construct($formState)
    {
        parent::__construct();
        $this->formState = $formState;
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

        $element = $this->addClass('form-control-file');

        // Add class for fields with error
        if (optional($this->formState)->hasFieldErrors($this->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element;
    }

}
