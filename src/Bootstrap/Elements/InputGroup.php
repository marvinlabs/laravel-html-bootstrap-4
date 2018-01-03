<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\SizableComponent;
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
    use WrapsFormControl, Assemblable, SizableComponent;

    // Used by SizableComponent
    protected $sizableClass = 'input-group';

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
    protected function assemble()
    {
        if ($this->control === null)
        {
            return $this;
        }

        $element = clone $this;
        $element = $element->assembleAddons($this->prefixes, 'input-group-prepend');

        // Control
        if ($this->control !== null)
        {
            $element = $element->addChild($this->control);
        }

        $element = $element->assembleAddons($this->suffixes, 'input-group-append');

        return $element->addClass('input-group');
    }

    /**
     * Add the child elements corresponding to the given addons
     *
     * @param array  $addons
     * @param string $addonContainerClass
     *
     * @return static
     */
    private function assembleAddons($addons, $addonContainerClass)
    {
        if (0 === \count($addons))
        {
            return $this;
        }

        $div = Div::create()
            ->addClass($addonContainerClass)
            ->addChildren($addons, function ($token) {
                $content = $token['content'] ?? '';
                $plainText = $token['plaintext'] ?? true;

                // When not instructed to treat as plain text, use it directly
                if ( !$plainText)
                {
                    return $content;
                }

                // When instructed to use as plain text, we wrap inside a span
                $span = Span::create()->addClass('input-group-text');

                return \is_string($content)
                    ? $span->text($content)
                    : $span->addChild($content);
            });

        return $this->addChild($div);
    }
}
