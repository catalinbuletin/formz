<?php

namespace Formz\Fields;

class Text extends AbstractField
{
    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('text', $name, $label, $value);
    }

    public static function makeFromArray(array $fieldData)
    {
        $field = new static(
            $fieldData['name'],
            $fieldData['label'] ?? null,
            $fieldData['value'] ?? null
        );

        $field->setId($fieldData['id']);
        $field->setAttributes($fieldData['attributes']);
        $field->rules($fieldData['rules']);
        $field->workflows($fieldData['workflows']);

        return $field;
    }
}
