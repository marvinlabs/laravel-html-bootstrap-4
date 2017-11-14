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
trait HasControlSize
{

    /**
     * Set the control size
     *
     * @param string $size
     *
     * @return static
     * @throws \RuntimeException When $size does not have a valid value
     */
    private function size($size)
    {
        $size = strtolower($size);
        if ( !in_array($size, ['lg', 'sm'], true))
        {
            throw new RuntimeException('Invalid control size');
        }

        return $this->addClass("form-control-$size");
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