<?php

namespace Formz\FieldTypes;

class TextareaType extends AbstractType
{
    public function type()
    {
        return 'textarea';
    }

    public function label()
    {
        return trans('forms.field-type.textarea');
    }

    public function icon()
    {
        return 'glyphicon glyphicon-text-height';
    }

    public function attributes()
    {
        return [
            'placeholder' => null,
            'min' => null,
            'max' => null,
            'rows' => 3,
            'cols' => null
        ];
    }
}

