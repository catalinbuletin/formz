<?php

namespace Formz\Fields;

use Illuminate\Support\Arr;

class File extends AbstractField
{
    // @todo - cleanup
    //private $fileCategory = null;
    private string $theme = 'list';
    private int $maxSize = 3;
    private ?int $maxFiles = null;
    //private string $helpText = 'Upload file or drag & drop'; @todo -> cleanup

    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('file', $name, $label, $value);
    }

    // @todo - cleanup
    /*public static function makeFromArray(array $fieldData)
    {
        $field = new static(
            $fieldData['name'],
            $fieldData['label'] ?? null,
            $fieldData['value'] ?? null
        );
        $field->setId($fieldData['id']);
        $field->setAttributes($fieldData['attributes']);
        $field->setFileConfig($fieldData['fileConfig']);
        $field->rules($fieldData['rules']);
        $field->workflows($fieldData['workflows']);

        return $field;
    }*/

    // @todo - cleanup
    /*private function setFileConfig($config)
    {
        $this->fileCategory = Arr::get($config, 'fileCategory', null);
        $this->maxSize = Arr::get($config, 'maxSize', $this->maxSize);
        $this->maxFiles = Arr::get($config, 'maxFiles', $this->maxFiles);
        $this->helpText = Arr::get($config, 'helpText', $this->helpText);
        $this->theme = Arr::get($config, 'theme', $this->theme);
    }*/

    public function maxSize(int $value): File
    {
        $this->maxSize = $value;

        return $this;
    }

    public function theme(string $value): File
    {
        $this->theme = $value;

        return $this;
    }

    public function maxFiles(?int $value = null): File
    {
        $this->maxFiles = $value;

        return $this;
    }

    // @todo -> cleanup
    /*public function helpText(string $value): File
    {
        $this->helpText = $value;

        return $this;
    }*/

    public function fileCategory($value): File
    {
        $this->fileCategory = $value;

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes()
    {
        $attributes = [
            'min' => null,
            'max' => null
        ];

        return array_merge(parent::defaultAttributes(), $attributes);
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'fileConfig' => [
                'fileCategory' => $this->fileCategory,
                'maxSize' => $this->maxSize,
                'theme' => $this->theme,
                'maxFiles' => $this->maxFiles,
                //'helpText' => $this->helpText, @todo -> cleanup
            ]
        ]);
    }
}
