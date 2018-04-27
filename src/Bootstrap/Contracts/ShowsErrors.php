<?php

namespace MarvinLabs\Html\Bootstrap\Contracts;


interface ShowsErrors
{
    /**
     * @param \Spatie\Html\BaseElement|null $error
     * @return static
     */
    public function showError($error);
}
