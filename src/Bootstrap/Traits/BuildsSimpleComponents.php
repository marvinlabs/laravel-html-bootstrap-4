<?php

namespace MarvinLabs\Html\Bootstrap\Traits;

use MarvinLabs\Html\Bootstrap\Elements\A;
use MarvinLabs\Html\Bootstrap\Elements\Badge;
use MarvinLabs\Html\Bootstrap\Elements\Progress;

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

    /**
     * @param string|null $href
     * @param null        $contents
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\A
     */
    public function a($href = null, $contents = null): A
    {
        return A::create()
            ->attributeIf($href, 'href', $href)
            ->html($contents);
    }

    /**
     * @param string      $number
     * @param string|null $text
     *
     * @return \Spatie\Html\Elements\A
     */
    public function tel($number, $text = null)
    {
        return $this->a('tel:' . $number, $text);
    }

    /**
     * @param string      $email
     * @param string|null $text
     *
     * @return \Spatie\Html\Elements\A
     */
    public function mailto($email, $text = null)
    {
        return $this->a('mailto:' . $email, $text);
    }

    /**
     * @return \MarvinLabs\Html\Bootstrap\Elements\Progress
     */
    public function progress(): Progress
    {
        return Progress::create();
    }
}