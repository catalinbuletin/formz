<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    |
    | Control the way you want your forms to look.
    | The package supports a few css frameworks out of the box. You can
    | configure them below in the specific theme config section.
    |
    | If none of the supported frameworks suit you, there is also a convenient
    | way to create your own specific theme. Check out the docs at:
    |
    | Supported: "bootstrap4", "foundation", "bulma"
    */

    'theme' => 'bulma',


    /*
    |--------------------------------------------------------------------------
    | Buttons
    |--------------------------------------------------------------------------
    |
    | Control the buttons on your form. The package can display the
    | "submit" and "cancel" buttons for your form out of the box.
    |
    */

    'buttons' => [
        /**
         * Show the buttons on top of the form
         */
        'active_top' => false,

        /**
         * Show the buttons at the bottom of the form
         */
        'active_bottom' => true,

        /**
         * The horizontal placement of the buttons
         *
         * Supports: "left", "center", "right"
         */
        'placement' => 'left',

        /**
         * Submit button's label
         */
        'submit_label' => 'Submit',

        /**
         * Cancel button's label
         */
        'cancel_label' => 'Cancel'
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation Errors
    |--------------------------------------------------------------------------
    |
    | Control the way you display the validation errors on your form.
    | The package supports out of the box a global validation message
    | and validation errors for each individual field.
    |
    */

    'errors' => [
        /**
         * Global validation error message
         */
        'global' => [
            /**
             * Show or hide the global validation message
             */
            'active' => true,

            /**
             * The class the alert box will have
             */
            'class' => 'formz-alert alert alert-danger',

            /**
             * The default message to display
             */
            'message' => 'The form has errors!',

            /**
             * Append to the default message
             *
             * Supported: "first", "all", "none"
             */
            'display' => 'none'
        ],

        'input' => [
            /**
             * Show or hide the input validation message
             */
            'active' => true,

            /**
             * Display only the first or all the validation errors for the input field
             *
             * Supported: "first", "all"
             */
            'display' => 'first'
        ]
    ],

    'themes' => [
        'bootstrap4' => [

            'form-class' => '',

            'section-class' => 'form-row',

            'grid-map' => [
                'xs' => 'col-%s',
                'sm' => 'col-sm-%s',
                'md' => 'col-md-%s',
                'lg' => 'col-lg-%s',
                'xlg' => 'col-xlg-%s'
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

            'buttons' => [
                'wrapper_class' => '',
                'submit' => [
                    'class' => 'btn btn-primary',
                    'icon' => 'fa fa-save'
                ],
                'cancel' => [
                    'class' => 'btn btn-secondary',
                    'icon' => 'fa fa-return'
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
                'xs' => 'small-%s',
                'sm' => 'medium-%s',
                'md' => 'large-%s',
                'lg' => 'large-%s',
                'xlg' => 'large-%s'
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

            'buttons' => [
                'wrapper_class' => '',
                'submit' => [
                    'class' => 'button',
                    'icon' => 'fa fa-save'
                ],
                'cancel' => [
                    'class' => 'button secondary',
                    'icon' => 'fa fa-return'
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

            'buttons' => [
                'wrapper_class' => 'control',
                'submit' => [
                    'class' => 'button is-link',
                    'icon' => 'fa fa-save'
                ],
                'cancel' => [
                    'class' => 'button is-link is-light',
                    'icon' => 'fa fa-return'
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
