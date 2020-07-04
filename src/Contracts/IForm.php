<?php

namespace Formz\Contracts;

use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IForm extends \JsonSerializable, Arrayable
{
    public function setAction(string $url): self;

    public function setMethod(string $method): self;

    public function setEnctype(string $enctype): self;

    public function setValues(?array $data = null): self;

    public function setAttributes(array $attributes): self;

    public function mergeAttributes(array $attributes, string $glue = ' '): self;

    public function addSection(ISection $section): self;

    /**
     * @param array|IField[] $fields
     * @return self
     */
    public function addFields(array $fields): self;

    /**
     * @param Request $request
     * @return mixed
     */
    public function validate(Request $request);

    /**
     * @param string $theme
     * @return mixed
     */
    public function setTheme(string $theme);

    /**
     * @param array $only
     * @return Collection|IField[]
     */
    public function getFields(array $only = []);

    /**
     * @param bool $assoc - if true, returns a key-value array where key is the name of the field and value is the label
     * @param null $prefix - if assoc is true and prefix has a value, it prefixes the key
     * @return array
     */
    public function getFieldNames($assoc = false, $prefix = null): array;

    /**
     * @param bool $assoc - if true, returns a key-value array where key is the name of the field and value an array: ['label' => "Label", 'value' => 123]
     * @param string|null $prefix - if assoc is true and prefix has a value, it prefixes the key
     * @return array
     */
    public function getFormValues(bool $assoc = false, ?string $prefix = null): array;

    public function getField(string $fieldName): ?IField;

    public function getAttributes(): Data;

    public function except(array $fields): self;

    public function only(array $fields): self;

    /**
     * @return Collection|ISection[]
     */
    public function getSections();

    /**
     * The prefix argument is used to prefix all fields with it so laravel validator can validate groups of data
     */
    public function getValidationRules(string $prefix = ''): array;

    public function getRules(?string $fieldName = null): array;

    public function getTheme(): string;

    public function getAction(): string;

    public function getMethod(): string;

    public function getEnctype(): string;

    public function resolve(): void;

    public function hasErrors(): bool;

    public function errorMessage(): string;

    /**
     * @param array|Collection|Model $formData
     * @return bool
     */
    public static function bind(array $formData): bool;
}
