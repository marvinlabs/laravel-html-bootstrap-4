<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Label;

/**
 * A group of radio components
 */
class RadioGroup extends Div
{
    use Assemblable;

    /** @var array */
    private $options = [];

    /** @var string|null */
    private $selectedOption = null;

    /** @var string */
    private $name = 'radio_group';

    /** @var boolean */
    private $inline = false;

    /** @var \MarvinLabs\Html\Bootstrap\Contracts\FormState|null */
    private $formState = null;

    public function __construct($formState)
    {
        parent::__construct();
        $this->formState = $formState;
    }

    /** @return static */
    public function options(array $options)
    {
        $element = clone $this;
        $element->options = $options;

        return $element;
    }

    /** @return static */
    public function selectedOption($selectedOption)
    {
        $element = clone $this;
        $element->selectedOption = $selectedOption;

        return $element;
    }

    /** @return static */
    public function name(string $name)
    {
        $element = clone $this;
        $element->name = $name;

        return $element;
    }

    /** @return static */
    public function inline($inline = true)
    {
        $element = clone $this;
        $element->inline = $inline;

        return $element;
    }

    /** @Override */
    protected function assemble()
    {
        if (empty($this->options))
        {
            return $this;
        }

        $element = clone $this;

        foreach ($this->options as $value => $description)
        {
            $isChecked = $this->getFieldValue($this->name, $this->selectedOption === $value);

            $radio = new Radio($this->formState);
            $radio = $radio
                ->name($this->name)
                ->value($value)
                ->description($description)
                ->checked($isChecked)
                ->inline($this->inline);

            $element = $element->addChild($radio);
        }

        return $element->addClass('radio-group');
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    private function getFieldValue($name, $default)
    {
        return $this->formState !== null
            ? $this->formState->getFieldValue($name, $default)
            : $default;
    }

}
