<?php

namespace Formz\FieldTypes;

class SelectType extends AbstractType
{
    protected bool $hasOptions = true;

    public function type()
    {
        return 'select';
    }

    public function label()
    {
        return trans('forms.field-type.select');
    }

    public function icon()
    {
        return 'glyphicon glyphicon-th-list';
    }

    public function attributes()
    {
        return [
            'placeholder' => null
        ];
    }
}

