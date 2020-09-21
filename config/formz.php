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
            'active' => false,

            /**
             * The default message to display
             */
            'message' => 'The form has errors!',

            /**
             * Append to the default message
             *
             * Supported: "first", "all", "none"
             */
            'display' => 'first'
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

            'form_class' => '',

            'section_class' => 'form-row',

            'required_asterisk_class' => 'text-danger',

            'grid_map' => [
                'xs' => 'col-%s',
                'sm' => 'col-sm-%s',
                'md' => 'col-md-%s',
                'lg' => 'col-lg-%s',
                'xlg' => 'col-xlg-%s'
            ],

            'fields' => [
                'default' => [
                    'label_class' => '',
                    'input_class' => 'form-control',
                    'wrapper_class' => 'form-group'
                ],

                'select' => [
                    'label_class' => '',
                    'input_class' => 'custom-select',
                    'wrapper_class' => 'form-group'
                ],

                'multiselect' => [
                    'label_class' => '',
                    'input_class' => 'custom-select',
                    'wrapper_class' => 'form-group'
                ],

                'radio' => [
                    'label_class' => '',
                    'input_class' => 'custom-control-input',
                    'wrapper_class' => 'form-group'
                ],

                'checkbox' => [
                    'label_class' => '',
                    'input_class' => 'custom-control-input',
                    'wrapper_class' => 'form-group'
                ],

                'file' => [
                    'label_class' => '',
                    'input_class' => 'control-file-input',
                    'wrapper_class' => 'form-group'
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

            'error_class' => [
                'global' => 'alert alert-danger',
                'form' => '',
                'section' => '',
                'input' => 'is-invalid',
                'wrapper' => '',
                'label' => '',
            ]
        ],

        'foundation' => [

            'form_class' => '',

            'section_class' => 'grid-x grid-padding-x',

            'required_asterisk_class' => '',

            'grid_map' => [
                'xs' => 'small-%s',
                'sm' => 'medium-%s',
                'md' => 'large-%s',
                'lg' => 'large-%s',
                'xlg' => 'large-%s'
            ],

            'fields' => [
                'default' => [
                    'label_class' => '',
                    'input_class' => '',
                    'wrapper_class' => 'cell'
                ],

                'radio' => [
                    'label_class' => '',
                    'input_class' => '',
                    'wrapper_class' => 'cell'
                ],

                'checkbox' => [
                    'label_class' => '',
                    'input_class' => '',
                    'wrapper_class' => 'cell'
                ],

                'file' => [
                    'label_class' => '',
                    'input_class' => '',
                    'wrapper_class' => 'cell'
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

            'error_class' => [
                'global' => 'callout alert',
                'form' => '',
                'section' => '',
                'input' => 'is-invalid-input',
                'wrapper' => '',
                'label' => 'is-invalid-label'
            ]
        ],

        'bulma' => [

            'form_class' => '',

            'section_class' => 'columns is-multiline is-mobile',

            'required_asterisk_class' => 'has-text-danger',

            'grid_map' => [
                'xs' => 'is-%s-mobile',
                'sm' => 'is-%s-tablet',
                'md' => 'is-%s-desktop',
                'lg' => 'is-%s-widescreen',
                'xlg' => 'is-%s-fullhd'
            ],

            'fields' => [
                'default' => [
                    'label_class' => 'label',
                    'input_class' => 'input',
                    'wrapper_class' => 'field column'
                ],

                'textarea' => [
                    'label_class' => 'label',
                    'input_class' => 'textarea',
                    'wrapper_class' => 'field column'
                ],

                'select' => [
                    'label_class' => 'label',
                    'input_class' => '',
                    'wrapper_class' => 'field column'
                ],

                'multiselect' => [
                    'label_class' => 'label',
                    'input_class' => '',
                    'wrapper_class' => 'field column'
                ],

                'checkbox' => [
                    'label_class' => 'label',
                    'input_class' => '',
                    'wrapper_class' => 'field column'
                ],

                'radio' => [
                    'label_class' => 'label',
                    'input_class' => '',
                    'wrapper_class' => 'field column'
                ],

                'file' => [
                    'label_class' => 'label',
                    'input_class' => 'file-input',
                    'wrapper_class' => 'field column'
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

            'error_class' => [
                'global' => 'notification is-danger is-light',
                'form' => '',
                'section' => '',
                'input' => 'is-danger',
                'wrapper' => '',
                'label' => ''
            ]
        ],
    ]
];
