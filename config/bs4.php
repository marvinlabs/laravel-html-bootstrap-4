<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Versions
    |--------------------------------------------------------------------------
    |
    | Specifies which version of Bootstrap will be used when outputting styles
    | and scripts from CDN
    |
    */
    'versions'  => [
        'bootstrap' => '4.1.0',
        'jquery'    => '3.3.1',
        'popper'    => '1.14.0',
    ],

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
        'centered' => [
            'label'           => [],
            'control_wrapper' => ['text-center', 'col-sm-12'],
        ],
    ],

];
