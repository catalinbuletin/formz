<?php

namespace Formz\Fields;

class Text extends AbstractField
{
    public function __construct(string $name, $value, string $label = null)
    {
        parent::__construct('text', $name, $value, $label);
    }

    public static function makeFromArray(array $fieldData)
    {
        $field = new static(
            $fieldData['name'],
            $fieldData['value'] ?? null,
            $fieldData['label'] ?? null
        );

        $field->setId($fieldData['id']);
        $field->setAttributes($fieldData['attributes']);
        $field->rules($fieldData['rules']);
        $field->workflows($fieldData['workflows']);

        return $field;
    }
}
