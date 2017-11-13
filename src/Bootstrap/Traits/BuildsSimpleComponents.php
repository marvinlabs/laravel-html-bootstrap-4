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
     * @param string $type Type of badge (primary, secondary, error, etc.)
     *
     * @return Badge
     */
    public function badge($type = 'secondary')
    {
        return Badge::create()->type($type);
    }

}