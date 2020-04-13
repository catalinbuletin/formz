<?php

return [
    'style' => 'bootstrap4',

    'theme' => 'foundation',

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
        ],

        'foundation' => [

            'form-class' => '',

            'section-class' => 'form-row',

            'grid-map' => [
                'xs' => 'small-',
                'sm' => 'medium-',
                'md' => 'large-',
                'lg' => 'large-',
            ],

            'fields' => [
                'default' => [
                    'label-class' => '',
                    'input-class' => '',
                    'wrapper-class' => 'cell'
                ],

                'radio' => [
                    'label-class' => '',
                    'input-class' => '',
                    'wrapper-class' => 'cell'
                ],

                'checkbox' => [
                    'label-class' => '',
                    'input-class' => '',
                    'wrapper-class' => 'cell'
                ],

                'file' => [
                    'label-class' => '',
                    'input-class' => '',
                    'wrapper-class' => 'cell'
                ],
            ],
        ]
    ]
];
