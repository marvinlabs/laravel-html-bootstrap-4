<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\WrapsFormControl;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Span;

/**
 * Class InputGroup
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Allows adding stuff on either side of a textual input field
 */
class InputGroup extends Div
{
    use WrapsFormControl;

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
     * Add an addon before the field
     *
     * @param string|\Spatie\Html\BaseElement $prefix      One or more prefixes to append before the field
     * @param bool                            $isPlainText Is the prefix to be handled like a button, dropdown, etc.
     *
     * @return static
     */
    public function prefix($prefix, $isPlainText = true)
    {
        if ($prefix === null)
        {
            return $this;
        }

        $element = clone $this;
        $element->prefixes[] = [
            'content'   => $prefix,
            'plaintext' => $isPlainText,
        ];

        return $element;
    }

    /**
     * Add an addon after the field
     *
     * @param string|\Spatie\Html\BaseElement $suffix      One or more suffixes to append before the field
     * @param bool                            $isPlainText Is the prefix to be handled like a button, dropdown, etc.
     *
     * @return static
     */
    public function suffix($suffix, $isPlainText = true)
    {
        if ($suffix === null)
        {
            return $this;
        }

        $element = clone $this;
        $element->suffixes[] = [
            'content'   => $suffix,
            'plaintext' => $isPlainText,
        ];

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

    /**
     * Add the child elements corresponding to the given addons
     *
     * @param array $addons
     *
     * @return static
     */
    private function assembleAddons($addons)
    {
        if (0 === \count($addons))
        {
            return $this;
        }

        return $this->addChildren($addons, function ($token) {
            $span = Span::create()
                ->addClass($token['plaintext'] ? 'input-group-addon' : 'input-group-btn');

            $content = $token['content'];

            return \is_string($content)
                ? $span->text($content)
                : $span->addChild($content);
        });
    }
}
