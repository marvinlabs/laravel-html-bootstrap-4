<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Illuminate\Contracts\Support\Htmlable;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Span;

/**
 * Class InputGroup
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          InputGroup element with some BS4 helpers
 */
class InputGroup extends Div
{
    /** @var \Spatie\Html\BaseElement */
    private $control;

    /** @var bool */
    private $isAssembled = false;

    /** @var array */
    private $prefixes = [];

    /** @var array */
    private $suffixes = [];

    /**
     * InputGroup constructor.
     *
     * @param \Spatie\Html\BaseElement $control
     */
    public function __construct($control = null)
    {
        parent::__construct();

        $this->control = $control;
    }

    /**
     * @param \Spatie\Html\BaseElement $control
     *
     * @return static
     */
    public function control($control)
    {
        if ($control === null)
        {
            return $this;
        }

        $element = clone $this;
        $element->control = $control;

        return $element;
    }

    /**
     * Make the input read only
     *
     * @param string|array $prefixes One or more prefixes to append before the field
     *
     * @return static
     */
    public function prefixWith($prefixes)
    {
        $element = clone $this;
        $element->prefixes = array_merge($this->prefixes, array_wrap($prefixes));

        return $element;
    }

    /**
     * Make the input read only
     *
     * @param string|array $suffixes One or more prefixes to append before the field
     *
     * @return static
     */
    public function suffixWith($suffixes)
    {
        $element = clone $this;
        $element->suffixes = array_merge($this->suffixes, array_wrap($suffixes));

        return $element;
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

        if ($this->control === null)
        {
            return $this;
        }

        $element = clone $this;
        $element = $element->assembleAddons($this->prefixes);

        // Control
        if ($this->control !== null)
        {
            $element = $element->addChild($this->control);
        }

        $element = $element->assembleAddons($this->suffixes);


        return $element->addClass('input-group');
    }

    private function assembleAddons($addons)
    {
        if (0 === \count($addons))
        {
            return $this;
        }

        return $this->addChildren($addons, function ($token) {
            $span = Span::create()->addClass('input-group-addon');

            return \is_string($token)
                ? $span->text($token)
                : $span->addChild($token);
        });
    }
}
