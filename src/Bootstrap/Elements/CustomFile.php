<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\WrapsFormControl;
use Spatie\Html\Elements\Label;
use Spatie\Html\Elements\Span;

/**
 * Class CustomFile
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          A custom file input. See https://getbootstrap.com/docs/4.0/components/forms/#file-browser
 *
 * <label class="custom-file">
 *   <input type="file" id="file2" class="custom-file-input">
 *   <span class="custom-file-control"></span>
 * </label>
 */
class CustomFile extends Label
{
    use WrapsFormControl, Assemblable;

    /**
     * FormGroup constructor.
     *
     * @param \MarvinLabs\Html\Bootstrap\Contracts\FormState $formState
     */
    public function __construct($formState)
    {
        parent::__construct();

        $this->control = (new Input($formState))->type('file');
    }

    /** @Override */
    protected function assemble()
    {
        if ($this->control === null)
        {
            return $this;
        }

        $element = clone $this;

        // Input field (hidden by CSS)
        if ($element->control !== null)
        {
            $element = $element->addChild($this->control);
        }

        // Custom indicator
        $element = $element->addChild(Span::create()->addClass('custom-file-control'));

        return $element->addClass(['custom-control', 'custom-file']);
    }

}