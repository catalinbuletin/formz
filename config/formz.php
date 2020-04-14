<?php

return [
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

            'section-class' => 'grid-x grid-padding-x',

            'grid-map' => [
                'xs' => 'small-',
                'sm' => 'medium-',
                'md' => 'large-',
                'lg' => 'large-',
                'xlg' => 'large-'
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

            'section-class' => 'columns is-multiline is-mobile',

            'grid-map' => [
                'xs' => 'is-%s-mobile',
                'sm' => 'is-%s-tablet',
                'md' => 'is-%s-desktop',
                'lg' => 'is-%s-widescreen',
                'xlg' => 'is-%s-fullhd'
            ],

            'fields' => [
                'default' => [
                    'label-class' => 'label',
                    'input-class' => 'input',
                    'wrapper-class' => 'field column'
                ],

                'textarea' => [
                    'label-class' => 'label',
                    'input-class' => 'textarea',
                    'wrapper-class' => 'field column'
                ],

                'select' => [
                    'label-class' => 'label',
                    'input-class' => '',
                    'wrapper-class' => 'field column'
                ],

                'multiselect' => [
                    'label-class' => 'label',
                    'input-class' => '',
                    'wrapper-class' => 'field column'
                ],

                'checkbox' => [
                    'label-class' => 'label',
                    'input-class' => '',
                    'wrapper-class' => 'field column'
                ],

                'radio' => [
                    'label-class' => 'label',
                    'input-class' => '',
                    'wrapper-class' => 'field column'
                ],

                'file' => [
                    'label-class' => 'label',
                    'input-class' => 'file-input',
                    'wrapper-class' => 'field column'
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
