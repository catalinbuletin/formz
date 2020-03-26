<?php

namespace Formz\FieldTypes;

class DepartmentalEntityTreeType extends AbstractType
{
    public function type()
    {
        return 'departmentalEntityTree';
    }

    public function label()
    {
        return trans('forms.field-type.departmentalEntityTree');
    }

    public function icon()
    {
        return 'icon-share';
    }

    public function attributes()
    {
        return [
            'placeholder' => null
        ];
    }
}

