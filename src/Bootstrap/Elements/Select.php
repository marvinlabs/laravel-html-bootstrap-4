<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Disablable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\SizableComponent;
use Spatie\Html\Elements\Option;
use Spatie\Html\Elements\Select as BaseSelect;

/**
 * Select element with some BS4 helpers
 */
class Select extends BaseSelect
{
    use SizableComponent, Disablable, Assemblable;

    // Used by SizableComponent
    protected $sizableClass = 'form-control';

    /** @var  \MarvinLabs\Html\Bootstrap\Contracts\FormState */
    private $formState;

    public function __construct($formState)
    {
        parent::__construct();
        $this->formState = $formState;
    }

    /**
     * @param string|null $text
     *
     * @return static
     */
    public function placeholder($text, $placeholderValue = null)
    {
        return $this->prependChild(
            Option::create()
                  ->value($placeholderValue)
                  ->text($text)
                  ->selectedIf(! $this->hasSelection())
        );
    }

    /** @Override */
    protected function assemble()
    {
        $element = $this->addClass('custom-select');

        // Add class for fields with error
        if (optional($this->formState)->hasFieldErrors($this->getAttribute('name')))
        {
            $element = $element->addClass('is-invalid');
        }

        return $element;
    }

}
