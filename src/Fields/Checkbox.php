<?php

namespace Formz\Fields;

use Formz\Options;
use Webmozart\Assert\Assert;

class Checkbox extends Choice
{
    public const INLINE_OPTIONS = false;

    /**
     * Checkbox constructor.
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param null $value
     */
    public function __construct(string $name, $options, string $label = null, $value = null)
    {
        parent::__construct('checkbox', $name, $options, $label, $value);
    }

    /*public static function makeFromArray(array $fieldData)
    {
        $options = self::makeOptionsFromArray($fieldData);

        $field = new static(
            $fieldData['name'],
            $options,
            $fieldData['label'] ?? null,
            $fieldData['value'] ?? []
        );

        $field->setId($fieldData['id']);
        $field->setAttributes($fieldData['attributes']);
        $field->rules($fieldData['rules']);
        $field->workflows($fieldData['workflows']);

        return $field;
    }*/

    public function inlineOptions($value = true): Checkbox
    {
        Assert::boolean($value);

        $this->setAttributes(['inlineOptions' => $value]);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes(): array
    {
        $defaultAttributes = [
            'inlineOptions' => self::INLINE_OPTIONS,
        ];

        return array_merge_recursive(parent::defaultAttributes(), $defaultAttributes);
    }
}
