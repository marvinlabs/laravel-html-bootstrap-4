<?php

namespace MarvinLabs\Html\Bootstrap\Traits;

/**
 * @target \MarvinLabs\Html\Bootstrap\Bootstrap
 */
trait BuildsStylesAndScripts
{

    private static $BS4_CDN = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/';


    /**
     * Link to the latest font-awesome CSS served from maxcdn.bootstrapcdn.com
     *
     * @return \Spatie\Html\Elements\Element
     */
    public function js($dependencies = ['jquery.slim', 'tether'])
    {
        $dependencies[] = 'bs4';
        $urls = collect([
            'jquery'      => 'https://code.jquery.com/jquery-3.1.1.min.js',
            'jquery.slim' => 'https://code.jquery.com/jquery-3.1.1.slim.min.js',
            'tether'      => 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js',
            'bs4'         => self::$BS4_CDN . '/js/bootstrap.min.js',
        ]);

        return $this->html->div()->addChildren(
            $urls
                ->filter(function ($key, $value) use ($dependencies) {
                    return in_array($key, $dependencies, true);
                })
                ->map([$this, 'mapScriptElement']));
    }

    /**
     * Link to the latest font-awesome CSS served from maxcdn.bootstrapcdn.com
     *
     * @return \Spatie\Html\Elements\Element
     */
    public function css()
    {
        /** @var \MarvinLabs\Html\Bootstrap\Bootstrap $this */
        return $this->html->element('link')->attributes([
            'href'        => self::BS4_CDN . '/css/bootstrap.min.css',
            'rel'         => 'stylesheet',
            'crossorigin' => 'anonymous',
        ]);
    }

    protected function mapScriptElement($id, $url)
    {
        return $this->html->element('script')->attributes([
            'src'         => $url,
            'crossorigin' => 'anonymous',
        ]);
    }
}