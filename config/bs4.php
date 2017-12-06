<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Row configurations for forms
    |--------------------------------------------------------------------------
    |
    | Each entry specifies the classes to be applied respectively to the label
    | and the control's div wrapper when rendering an horizontal form row.
    |
    */
    'form_rows' => [
        'default'  => [
            'label'           => ['col-sm-2'],
            'control_wrapper' => ['col-sm-10'],
        ],
        'no_label' => [
            'label'           => [],
            'control_wrapper' => ['offset-sm-2', 'col-sm-10'],
        ],
    ],

];