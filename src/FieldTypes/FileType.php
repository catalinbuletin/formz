<?php

namespace Formz\FieldTypes;

class FileType extends AbstractType
{
    public function type()
    {
        return 'file';
    }

    public function label()
    {
        return trans('forms.field-type.file');
    }

    public function icon()
    {
        return 'glyphicon glyphicon-file';
    }

    public function attributes()
    {
        return [
            'placeholder' => null,
        ];
    }
}

