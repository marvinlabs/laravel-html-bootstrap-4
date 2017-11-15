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
     * Set the variant of the badge.
     *
     * @param string $variant primary, secondary, error, etc.
     *
     * @return static
     */
    public function variant($variant = 'secondary')
    {
        return $this->addClass(['badge', "badge-{$variant}"]);
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