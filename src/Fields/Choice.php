<?php

namespace Formz\Fields;

use Formz\Options;
use Formz\ResourceOptions;

class Choice extends AbstractField
{
    /**
     * Possible options for select
     *
     * @var array|string
     */
    private $options = [];

    /**
     * @optionSource 'manual', 'resource', 'collection'
     */
    private string $optionSource = 'manual';

    private ?ResourceOptions $resource = null;

    /**
     * Field constructor.
     * @param string $type
     * @param string $name
     * @param mixed $options
     * @param string $label
     * @param mixed $value
     */
    public function __construct(string $type, string $name, Options $options, string $label = null, $value = null)
    {
        parent::__construct($type, $name, $label, $value);

        $this->setOptions($options);
    }

    public static function makeFromArray(array $fieldData)
    {
        $options = self::makeOptionsFromArray($fieldData);

        $field = new static(
            $fieldData['type'],
            $fieldData['name'],
            $options,
            $fieldData['label'] ?? null,
            $fieldData['value'] ?? null
        );

        $field->setId($fieldData['id']);
        $field->setAttributes($fieldData['attributes']);
        $field->rules($fieldData['rules']);
        $field->workflows($fieldData['workflows']);

        return $field;
    }

    /**
     * @param array $fieldData
     * @return Options
     */
    protected static function makeOptionsFromArray(array $fieldData)
    {
        switch ($fieldData['optionSource']) {
            case 'manual':
                return Options::fromDatabase($fieldData['options']);
            case 'resource':
                return Options::resource(
                    ResourceOptions::makeFromArray($fieldData['resource'])
                );
        }
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'options' => $this->options,
            'optionSource' => $this->optionSource,
            'resource' => $this->resource ? $this->resource->toArray() : null,
        ]);
    }

    /**
     * @param $options
     * @return void
     */
    private function setOptions(Options $options): void
    {
        if ($options->hasResource()) {
            $this->optionSource = 'resource';
            $this->resource = $options->getResource();
        }

        $this->options = $options->getOptions();
    }

    /**
     * @return array|string
     */
    public function getOptions()
    {
        return $this->options;
    }
}
