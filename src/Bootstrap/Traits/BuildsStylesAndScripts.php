<?php

namespace MarvinLabs\Html\Bootstrap\Traits;

/**
 * @target \MarvinLabs\Html\Bootstrap\Bootstrap
 */
trait BuildsStylesAndScripts
{
    private static $BS4_CDN = 'https://maxcdn.bootstrapcdn.com/bootstrap/';

    /**
     * Link to the latest font-awesome CSS served from maxcdn.bootstrapcdn.com
     *
     * @param array $dependencies Dependencies to load before the BS4 script. ['jquery', 'jquery.slim', 'popper' ]
     *
     * @return \Spatie\Html\Elements\Element
     */
    public function js(array $dependencies = ['jquery.slim', 'popper'])
    {
        $dependencies[] = 'bs4';
        $urls = collect([
            'jquery'      => 'https://code.jquery.com/jquery-' . config('bs4.versions.jquery') . '.min.js',
            'jquery.slim' => 'https://code.jquery.com/jquery-' . config('bs4.versions.jquery') . '.slim.min.js',
            'popper'      => 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/' . config('bs4.versions.popper') . '/umd/popper.min.js',
            'bs4'         => self::$BS4_CDN . config('bs4.versions.bootstrap') . '/js/bootstrap.min.js',
        ]);

        return $this->html->div()->addChildren(
            $urls
                ->filter(function ($value, $key) use ($dependencies) {
                    return \in_array($key, $dependencies, true);
                })
                ->map(function ($v) {
                    return $this->mapScriptElement($v);
                }));
    }

    /**
     * Link to the latest font-awesome CSS served from maxcdn.bootstrapcdn.com
     *
     * @return \Spatie\Html\Elements\Element
     */
    public function css()
    {
        return $this->html->element('link')->attributes([
            'href'        => self::$BS4_CDN . config('bs4.versions.bootstrap') . '/css/bootstrap.min.css',
            'rel'         => 'stylesheet',
            'crossorigin' => 'anonymous',
        ]);
    }

    protected function mapScriptElement($url)
    {
        return $this->html->element('script')->attributes([
            'src'         => $url,
            'crossorigin' => 'anonymous',
        ]);
    }
}