<?php

namespace Formz\Fields;

use Formz\Options;
use Webmozart\Assert\Assert;

class Checkbox extends Choice
{
    const INLINE_OPTIONS = false;

    public function __construct(string $name, Options $options, $value, string $label = null)
    {
        parent::__construct('checkbox', $name, $options, $value, $label);

        return $this;
    }

    public static function makeFromArray(array $fieldData)
    {
        $options = self::makeOptionsFromArray($fieldData);

        $field = new static(
            $fieldData['name'],
            $options,
            $fieldData['value'] ?? null,
            $fieldData['label'] ?? null
        );

        $field->setId($fieldData['id']);
        $field->setAttributes($fieldData['attributes']);
        $field->rules($fieldData['rules']);
        $field->workflows($fieldData['workflows']);

        return $field;
    }

    public function inlineOptions($value = true): Checkbox
    {
        Assert::boolean($value);

        $this->attributes->set('inlineOptions', $value);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes()
    {
        $attributes = [
            'inlineOptions' => self::INLINE_OPTIONS,
        ];

        return array_merge(parent::defaultAttributes(), $attributes);
    }
}