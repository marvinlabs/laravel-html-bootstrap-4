<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

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
    public function open()
    {
        // Set the control class if necessary.
        // To avoid infinite recursion, we will check if we already have those classes in our attributes.
        $classes = explode(' ', $this->getAttribute('class', []));
        if (in_array('form-control-file', $classes, true))
        {
            return parent::open();
        }

        // Add the class, then render that element
        $element = $this->addClass('form-control-file');

        // Add class for fields with error
        if (optional($this->formState)->hasFieldErrors($this->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element->open();
    }

}
