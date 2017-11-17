<?php

namespace MarvinLabs\Html\Bootstrap\Elements\Traits;


use RuntimeException;

/**
 * Trait HasControlSize
 * @package MarvinLabs\Html\Bootstrap\Elements\Traits
 * @target \Spatie\Html\BaseElement
 *
 *          Set the classes which influence a form field height
 */
trait SizableComponent
{

    /** @var string $sizableClass Classes using this trait must override this variable */
    // protected $sizableClass;

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
        if ( ! property_exists($this, 'sizableClass'))
        {
            throw new RuntimeException('You must specify the sizable CSS class');
        }

        $size = strtolower($size);
        if ( !\in_array($size, ['lg', 'sm'], true))
        {
            throw new RuntimeException('Invalid size');
        }

        return $this->addClass("{$this->sizableClass}-$size");
    }

    /**
     * Set the control size
     *
     * @return static
     */
    public function sizeSmall()
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $this->size('sm');
    }

    /**
     * Set the control size
     *
     * @return static
     */
    public function sizeLarge()
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $this->size('lg');
    }


}