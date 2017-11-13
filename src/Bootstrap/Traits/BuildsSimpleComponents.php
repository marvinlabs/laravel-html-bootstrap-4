<?php

namespace MarvinLabs\Html\Bootstrap\Traits;

use MarvinLabs\Html\Bootstrap\Elements\Badge;

/**
 * @target \MarvinLabs\Html\Bootstrap\Bootstrap
 */
trait BuildsSimpleComponents
{
    public function badge($type = 'secondary')
    {
        return Badge::create()->type($type);
    }
}