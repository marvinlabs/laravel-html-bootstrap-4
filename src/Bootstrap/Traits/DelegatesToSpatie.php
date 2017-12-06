<?php

namespace MarvinLabs\Html\Bootstrap\Traits;


/**
 * @target \MarvinLabs\Html\Bootstrap\Bootstrap
 */
trait DelegatesToSpatie
{

    /**
     * @param string $tag
     *
     * @return \Spatie\Html\Elements\Element
     */
    public function element($tag)
    {
        return $this->html->element($tag);
    }

    /**
     * @param \Spatie\Html\HtmlElement|string|null $legend
     *
     * @return \Spatie\Html\Elements\Fieldset
     */
    public function fieldset($legend = null)
    {
        return $this->html->fieldset($legend);
    }

    /**
     * @param \Spatie\Html\HtmlElement|string|null $contents
     *
     * @return \Spatie\Html\Elements\Legend
     */
    public function legend($contents = null)
    {
        return $this->html->legend($contents);
    }

    /**
     * @param \Spatie\Html\HtmlElement|string|null $contents
     *
     * @return \Spatie\Html\Elements\Div
     */
    public function div($contents = null)
    {
        return $this->html->div($contents);
    }

    /**
     * @param \Spatie\Html\HtmlElement|string|null $contents
     *
     * @return \Spatie\Html\Elements\Span
     */
    public function span($contents = null)
    {
        return $this->html->span($contents);
    }


}