<?php

namespace Formz\FieldTypes;

class DateType extends AbstractType
{
    protected bool $hasOptions = true;

    public function type()
    {
        return 'date';
    }

    public function label()
    {
        return trans('forms.field-type.date');
    }

    public function icon()
    {
        return 'glyphicon glyphicon-calendar';
    }

    public function attributes()
    {
        return [
            'placeholder' => null
        ];
    }
}
