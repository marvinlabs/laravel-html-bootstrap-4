<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Spatie\Html\Elements\Label;

/**
 * A custom file input. See https://getbootstrap.com/docs/4.0/components/forms/#file-browser
 *
 * <div class="custom-file">
 *   <input type="file" class="custom-file-input" id="customFile" lang="es">
 *   <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
 * </div>
 */
class CustomFile extends ControlWrapper
{
    /** @var  string|null */
    private $description;

    public function __construct($formState)
    {
        parent::__construct(
            (new Input($formState))->type('file'),
            ['custom-file']);
    }

    /**
     * @param string|null $text
     * @return static
     */
    public function description($text)
    {
        $element = clone $this;
        $element->description = $text;

        return $element;
    }

    protected function wrapControl()
    {
        $element = clone $this;
        $element = $element->addChild($this->control);

        // Label
        $element = $element->addChild(
            Label::create()
                 ->for($this->getControlAttribute('id'))
                 ->text($this->description ?? '')
                 ->addClass('custom-file-label'));

        return $element;
    }

}
