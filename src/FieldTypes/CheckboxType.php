<?php

namespace Formz\FieldTypes;

class CheckboxType extends AbstractType
{
    protected bool $hasOptions = true;

    public function type()
    {
        return 'checkbox';
    }

    public function label()
    {
        return trans('forms.field-type.checkbox');
    }

    public function icon()
    {
        return 'glyphicon glyphicon-check';
    }

    public function attributes()
    {
        return [
            'placeholder' => null
        ];
    }
}

