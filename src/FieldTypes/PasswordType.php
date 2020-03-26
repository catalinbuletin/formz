<?php

namespace Formz\FieldTypes;

class PasswordType extends AbstractType
{
    public function type()
    {
        return 'password';
    }

    public function label()
    {
        return trans('forms.field-type.password');
    }

    public function icon()
    {
        return 'fa fa-key';
    }

    public function attributes()
    {
        return [
            'min' => null,
            'max' => null
        ];
    }
}

