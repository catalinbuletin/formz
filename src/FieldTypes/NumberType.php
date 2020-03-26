<?php

namespace Formz\FieldTypes;

class NumberType extends AbstractType
{
    public function type()
    {
        return 'number';
    }

    public function label()
    {
        return trans('forms.field-type.number');
    }

    public function icon()
    {
        return 'fa fa-sort-numeric-asc';
    }

    public function attributes()
    {
        return [
            'placeholder' => null,
            'min' => null,
            'max' => null
        ];
    }
}

