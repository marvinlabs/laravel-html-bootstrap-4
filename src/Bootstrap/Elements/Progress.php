<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

use MarvinLabs\Html\Bootstrap\Elements\Traits\Assemblable;
use Spatie\Html\Elements\Div;

/**
 * Class Progress
 * @package MarvinLabs\Html\Bootstrap\Elements
 *
 *          A bootstrap progress bar
 */
class Progress extends Div
{
    use Assemblable;

    /** @var int */
    private $height;

    /** @var array */
    private $bars = [];

    /**
     * @param double $progress The current progress value
     * @param array  $options
     *
     * The options may contain the following keys:
     *
     *    background  : string
     *    height      : int
     *    min         : double
     *    max         : double
     *    label       : string
     *    autoLabel   : bool
     *
     * @return \MarvinLabs\Html\Bootstrap\Elements\Progress
     */
    public function addProgress($progress, $options = [])
    {
        $options['progress'] = $progress;

        $element = clone $this;
        $element->bars[] = $options;

        return $element;
    }

    /**
     * Set the global progress height
     *
     * @param int $value in pixels
     *
     * @return static
     *
     */
    public function height($value)
    {
        $element = clone $this;
        $element->height = $value;

        return $element;
    }

    /** @Override */
    protected function assemble()
    {
        $element = clone $this;

        // Add all progress bars
        $element = $element->addChild($this->bars, function ( $bar) {
            $bg = $bar['background'] ?? false;
            $striped = $bar['striped'] ?? false;
            $min = $bar['min'] ?? 0;
            $max = $bar['max'] ?? 100;
            $progress = max($min, min($max, $bar['progress'] ?? 0));
            $label = ($bar['autoLabel'] ?? false)
                ? "$progress%"
                : $bar['label'] ?? '';

            // Bring our absolute progress value to a value between 0 and 100
            $relativeWidth = 100 * ($progress - $min) / ($max - $min);
            $relativeWidth = max(0, min($relativeWidth, 100));

            return (new Div())
                ->addClass('progress-bar')
                ->addClassIf($bg, "bg-$bg")
                ->addClassIf($striped, 'progress-bar-striped')
                ->style("width: $relativeWidth%;")
                ->text($label)
                ->attributes([
                    'aria-valuemin' => $min,
                    'aria-valuemax' => $max,
                    'aria-valuenow' => $progress,
                    'role'          => 'progressbar',
                ]);
        });

        return $element
            ->styleIf($this->height !== null, "height: {$this->height}px;")
            ->addClass('progress');
    }

}