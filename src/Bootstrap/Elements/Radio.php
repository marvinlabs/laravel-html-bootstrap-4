<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

/**
 * A custom radio. See https://getbootstrap.com/docs/4.0/components/forms/#checkboxes-and-radios-1
 *
 * <div class="custom-control custom-radio">
 *   <input type="checkbox" class="custom-control-input" id="customCheck1">
 *   <label class="custom-control-label" for="customCheck1">Select this custom radio</label>
 * </div>
 */
class Radio extends CheckableButton
{

    public function __construct($formState)
    {
        parent::__construct($formState, 'radio');
    }

    /**
     * @param $element
     * @return string
     */
    protected function controlId($element): string
    {
        return \field_name_to_id($element->getAttribute('name')) . '_' . ($element->value ?? '1');
    }

}
