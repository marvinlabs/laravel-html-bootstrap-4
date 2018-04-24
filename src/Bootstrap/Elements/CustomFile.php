<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\WrapsFormControl;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Label;

/**
 * A custom file input. See https://getbootstrap.com/docs/4.0/components/forms/#file-browser
 *
 * <div class="custom-file">
 *   <input type="file" class="custom-file-input" id="customFile" lang="es">
 *   <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
 * </div>
 */
class CustomFile extends Div
{
    use WrapsFormControl, Assemblable;

    /** @var  string|null */
    private $description;

    public function __construct($formState)
    {
        parent::__construct();

        $this->control = (new Input($formState))->type('file');
    }

    /** @return static */
    public function description($text)
    {
        $element = clone $this;
        $element->description = $text;

        return $element;
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
            $element = $element->addChild(
                $this->control
                    ->addClass('custom-file-input'));
        }

        // Label
        $element = $element->addChild(
            Label::create()
                 ->for($this->control->getAttribute('id'))
                 ->text($this->description ?? '')
                 ->addClass('custom-file-label'));

        return $element->addClass('custom-file');
    }

}
