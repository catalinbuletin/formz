<?php

return [
    'style' => 'bootstrap4',

    'theme' => 'bulma',

    'themes' => [
        'bootstrap4' => [

            'form-class' => '',

            'section-class' => 'form-row',

            'grid-map' => [
                'xs' => 'col-',
                'sm' => 'col-sm-',
                'md' => 'col-md-',
                'lg' => 'col-lg-',
                'xlg' => 'col-xlg-'
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

            'error-class' => [
                'input' => 'is-invalid',
                'wrapper' => '',
                'label' => ''
            ]
        ],

        'bulma' => [

            'form-class' => '',

            'section-class' => 'columns',

            'grid-map' => [
                'xs' => 'column is-',
                'sm' => 'column is-',
                'md' => 'column is-',
                'lg' => 'column is-',
                'xlg' => 'column is-'
            ],

            'fields' => [
                'default' => [
                    'label-class' => 'label',
                    'input-class' => 'input',
                    'wrapper-class' => 'field'
                ],

                'textarea' => [
                    'label-class' => 'label',
                    'input-class' => 'textarea',
                    'wrapper-class' => 'field'
                ],

                'select' => [
                    'label-class' => 'label',
                    'input-class' => '',
                    'wrapper-class' => 'field'
                ],

                'multiselect' => [
                    'label-class' => 'label',
                    'input-class' => '',
                    'wrapper-class' => 'field'
                ],

                'checkbox' => [
                    'label-class' => 'label',
                    'input-class' => '',
                    'wrapper-class' => 'field'
                ],

                'radio' => [
                    'label-class' => 'label',
                    'input-class' => '',
                    'wrapper-class' => 'field'
                ],

                'file' => [
                    'label-class' => 'label',
                    'input-class' => 'file-input',
                    'wrapper-class' => 'field'
                ],
            ],

            'error-class' => [
                'input' => 'is-danger',
                'wrapper' => '',
                'label' => ''
            ]
        ],
    ]
];
