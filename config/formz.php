<?php

return [
    'style' => 'bootstrap4',

    'theme' => 'bootstrap4',

    'themes' => [
        'bootstrap4' => [

            'form-class' => '',

            'section-class' => 'form-row',

            'grid-map' => [
                'xs' => 'col-',
                'sm' => 'col-sm-',
                'md' => 'col-md-',
                'lg' => 'col-lg-',
            ],

            'fields' => [
                'default' => [
                    'label-class' => '',
                    'input-class' => 'form-control',
                    'wrapper-class' => 'form-group'
                ],

                'radio' => [
                    'label-class' => '',
                    'input-class' => 'form-check-input',
                    'wrapper-class' => 'form-group'
                ],

                'checkbox' => [
                    'label-class' => '',
                    'input-class' => 'form-check-input',
                    'wrapper-class' => 'form-group'
                ],

                'file' => [
                    'label-class' => '',
                    'input-class' => 'form-control-file',
                    'wrapper-class' => 'form-group'
                ],
            ],
        ]
    ]
];
