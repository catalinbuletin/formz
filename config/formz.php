<?php

return [
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
                'xlg' => 'col-xlg-'
            ],

            'fields' => [
                'default' => [
                    'label-class' => '',
                    'input-class' => 'form-control',
                    'wrapper-class' => 'form-group'
                ],

                'select' => [
                    'label-class' => '',
                    'input-class' => 'custom-select',
                    'wrapper-class' => 'form-group'
                ],

                'multiselect' => [
                    'label-class' => '',
                    'input-class' => 'custom-select',
                    'wrapper-class' => 'form-group'
                ],

                'radio' => [
                    'label-class' => '',
                    'input-class' => 'custom-control-input',
                    'wrapper-class' => 'form-group'
                ],

                'checkbox' => [
                    'label-class' => '',
                    'input-class' => 'custom-control-input',
                    'wrapper-class' => 'form-group'
                ],

                'file' => [
                    'label-class' => '',
                    'input-class' => 'control-file-input',
                    'wrapper-class' => 'form-group'
                ],
            ],

            'error-class' => [
                'input' => 'is-invalid',
                'wrapper' => '',
                'label' => ''
            ]
        ],

        'foundation' => [

            'form-class' => '',

            'section-class' => 'form-row',

            'grid-map' => [
                'xs' => 'small-',
                'sm' => 'medium-',
                'md' => 'large-',
                'lg' => 'large-',
                'xlg' => 'column is-'
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

            'error-class' => [
                'input' => 'is-invalid-input',
                'wrapper' => '',
                'label' => 'is-invalid-label'
            ]
        ],

        'bulma' => [

            'form-class' => '',

            'section-class' => 'columns is-multiline',

            'grid-map' => [
                'xs' => 'column is-%s-mobile',
                'sm' => 'column is-%s-tablet',
                'md' => 'column is-%s-desktop',
                'lg' => 'column is-%s-widescreen',
                'xlg' => 'column is-%s-fullhd'
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
