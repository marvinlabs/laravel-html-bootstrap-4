<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Spatie\Html\BaseElement;

/**
 * Class Badge
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          A bootstrap badge
 */
class Badge extends BaseElement
{
    protected $tag = 'span';

    /**
     * Make the badge behave like a link
     *
     * @param string $url The link URL
     *
     * @return static
     */
    public function link($url)
    {
        $element = $this->attribute('href', $url);
        $element->tag = 'a';

        return $element;
    }

    /**
     * Set the type of the badge.
     *
     * @param string $type primary, secondary, error, etc.
     *
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function type($type = 'secondary')
    {
        return $this->addClass(['badge', "badge-{$type}"]);
    }

    /**
     * Make badges more rounded
     *
     * @return static
     */
    public function pill()
    {
        return $this->addClass('badge-pill');
    }

}