<?php

namespace Formz\Fields;

use Illuminate\Support\Arr;

class File extends AbstractField
{
    private string $theme = 'list';
    private int $maxSize = 3;
    private ?int $maxFiles = null;

    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('file', $name, $label, $value);
    }

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

    protected function defaultAttributes(): array
    {
        $defaultAttributes = [
            'min' => null,
            'max' => null,
        ];

        return array_merge_recursive(parent::defaultAttributes(), $defaultAttributes);
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'fileConfig' => [
                'fileCategory' => $this->fileCategory,
                'maxSize' => $this->maxSize,
                'theme' => $this->theme,
                'maxFiles' => $this->maxFiles,
            ]
        ]);
    }
}
