<?php

namespace MarvinLabs\Html\Bootstrap\Traits;

use MarvinLabs\Html\Bootstrap\Elements\Badge;

/**
 * @target \MarvinLabs\Html\Bootstrap\Bootstrap
 */
trait BuildsSimpleComponents
{

    /**
     * Small count and labeling component.
     *
     * @param string $variant Type of badge (primary, secondary, error, etc.)
     *
     * @return Badge
     */
    public function badge($variant = 'secondary'): Badge
    {
        return Badge::create()->variant($variant);
    }

}