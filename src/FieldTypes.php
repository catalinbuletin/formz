<?php

namespace Formz;

use Formz\FieldTypes\{
    CheckboxType,
    DateType,
    DepartmentalEntityTreeType,
    AbstractType,
    FileType,
    MultiSelectType,
    NumberType,
    PasswordType,
    RadioType,
    SelectType,
    TextType,
    TextareaType
};

class FieldTypes
{
    const TYPES = [
        TextType::class,
        NumberType::class,
        TextareaType::class,
        SelectType::class,
        MultiSelectType::class,
        RadioType::class,
        CheckboxType::class,
        DateType::class,
        DepartmentalEntityTreeType::class,
        FileType::class,
        PasswordType::class,
    ];

    public static function get()
    {
        $types = [];

        /** @var AbstractType $typeObject */
        foreach (self::TYPES as $type) {
            $typeObject = new $type();
            $types[$typeObject->type()] = $typeObject;
        }

        return $types;
    }
}
