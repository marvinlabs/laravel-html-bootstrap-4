<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\Disablable;
use MarvinLabs\Html\Bootstrap\Elements\Traits\SizableComponent;
use Spatie\Html\Elements\Button as BaseButton;

/**
 * Class Button
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          Button element with some BS4 helpers
 */
class Button extends BaseButton
{
    use SizableComponent, Disablable;

    // Used by SizableComponent
    protected $sizableClass = 'btn';

    /**
     * Make the button occupy the whole width
     *
     * @return static
     */
    public function fullWidth()
    {
        return $this->addClass('btn-block');
    }

    /**
     * Set the button variant (primary, secondary, etc.)
     *
     * @param bool $variant (primary, secondary, etc.)
     * @param bool $outlined
     *
     * @return static
     */
    public function variant($variant, $outlined = false)
    {
        return $this->addClass(['btn', $outlined ? "btn-outline-$variant" : "btn-$variant"]);
    }
}
