<?php

namespace MarvinLabs\Html\Bootstrap\Elements;

/**
 * A custom checkbox. See https://getbootstrap.com/docs/4.0/components/forms/#checkboxes-and-radios-1
 *
 * <div class="custom-control custom-checkbox">
 *   <input type="checkbox" class="custom-control-input" id="customCheck1">
 *   <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
 * </div>
 */
class CheckBox extends CheckableButton
{
    public function __construct($formState)
    {
        parent::__construct($formState, 'checkbox');
    }
}
