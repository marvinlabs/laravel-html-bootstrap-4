<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Spatie\Html\BaseElement;

/**
 * Class BootstrapIcon
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          A font-awesome icon element
 */
class BootstrapIcon extends BaseElement
{
    protected $tag = 'i';

    /**
     * Set the icon to be used
     *
     * @param string $name Name of the icon (without any 'fa-' prefix)
     *
     * @return static
     */
    public function name($name)
    {
        return $this->addClass(['fa', "fa-{$name}"]);
    }

    /**
     * To increase icon sizes relative to their container.
     *
     * @param string $size One of: lg, 2x, 3x, 4x, 5x
     *
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function size($size = 'lg')
    {
        if ( !in_array($size, ['lg', '2x', '3x', '4x', '5x'], true))
        {
            throw new \InvalidArgumentException('Invalid icon size. Should either be: lg, 2x, 3x, 4x, 5x');
        }

        return $this->addClass("fa-{$size}");
    }

    /**
     * Great to use when different icon widths throw off alignment. Especially useful in things like nav lists & list
     * groups.
     *
     * @return static
     */
    public function fixedWidth()
    {
        return $this->addClass('fa-fw');
    }

    /**
     * Rotate
     *
     * @return static
     */
    public function spin()
    {
        return $this->addClass('fa-spin');
    }

    /**
     * Rotate with 8 steps.
     *
     * @return static
     */
    public function pulse()
    {
        return $this->addClass('fa-pulse');
    }

    /**
     * Easily replace default bullets in unordered lists.
     *
     * @return static
     */
    public function forList()
    {
        return $this->addClass('fa-li');
    }

    /**
     * Rotate
     *
     * @param int $angle Either 90, 180, or 270
     *
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function rotate($angle)
    {
        if ( !in_array($angle, [90, 180, 270], true))
        {
            throw new \InvalidArgumentException('Invalid angle. Should either be: 90, 180, 270');
        }

        return $this->addClass("fa-rotate-{$angle}");
    }

    /**
     * Alternate color (white)
     *
     * @return static
     */
    public function inverse()
    {
        return $this->addClass('fa-inverse');
    }

    /**
     * Flip horizontal
     *
     * @return static
     */
    public function flipX()
    {
        return $this->addClass('fa-flip-horizontal');
    }

    /**
     * Flip vertical
     *
     * @return static
     */
    public function flipY()
    {
        return $this->addClass('fa-flip-vertical');
    }

    /**
     * Flip in both directions
     *
     * @return static
     */
    public function flip()
    {
        return $this->flipX()->flipY();
    }
}