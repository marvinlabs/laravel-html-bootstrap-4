<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use Spatie\Html\Elements\A as BaseA;

/**
 * Class A
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          A element with some BS4 helpers
 */
class A extends BaseA
{
    /**
     * Make the input read only
     *
     * @param bool $variant Style the input just like plain text (no border, padding, etc.)
     * @param bool $outlined
     *
     * @return static
     */
    public function asButton($variant, $outlined = false)
    {
        return $this->attribute('role', 'button')
            ->addClass(['btn', $outlined ? "btn-outline-$variant" : "btn-$variant"]);
    }
}
