<?php

namespace MarvinLabs\Html\Bootstrap\Elements\Traits;


use RuntimeException;

/**
 * Set the classes which influence a form field height
 *
 * @target \Spatie\Html\BaseElement
 */
trait SizableComponent
{

    // @var string $sizableClass Classes using this trait must override this variable
    // protected $sizableClass;

    public function sizeSmall()
    {
        return $this->size('sm');
    }

    public function sizeLarge()
    {
        return $this->size('lg');
    }

    /**
     * Set the control size
     *
     * @param string $size
     *
     * @return static
     * @throws \RuntimeException When $size does not have a valid value
     */
    protected function size($size)
    {
        if (!property_exists($this, 'sizableClass'))
        {
            throw new RuntimeException('You must specify the sizable CSS class');
        }

        $size = strtolower($size);
        if (!\in_array($size, ['lg', 'sm'], true))
        {
            throw new RuntimeException('Invalid size');
        }

        return $this->addClass("{$this->sizableClass}-$size");
    }
}
