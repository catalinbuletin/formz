<?php

namespace Formz\FieldTypes;

class MultiSelectType extends AbstractType
{
    protected bool $hasOptions = true;

    public function type()
    {
        return 'multiselect';
    }

    public function label()
    {
        return trans('forms.field-type.multiselect');
    }

    public function icon()
    {
        return 'glyphicon glyphicon-tasks';
    }

    public function attributes()
    {
        return [
            'placeholder' => null
        ];
    }
}

