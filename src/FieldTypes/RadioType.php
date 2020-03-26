<?php

namespace Formz\FieldTypes;

class RadioType extends AbstractType
{
    protected bool $hasOptions = true;

    public function type()
    {
        return 'radio';
    }

    public function label()
    {
        return trans('forms.field-type.radio');
    }

    public function icon()
    {
        return 'glyphicon glyphicon-record';
    }

    public function attributes()
    {
        return [
            'placeholder' => null
        ];
    }
}

