<?php

namespace Formz\FieldTypes;

class TextType extends AbstractType
{
    public function type()
    {
        return 'text';
    }

    public function label()
    {
        return trans('forms.field-type.text');
    }

    public function icon()
    {
        return 'glyphicon glyphicon-text-width';
    }

    public function attributes()
    {
        return [
            'placeholder' => null,
            'max' => null
        ];
    }
}

