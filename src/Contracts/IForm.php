<?php

namespace Formz\Contracts;

use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IForm extends \JsonSerializable, Arrayable
{
    /**
     * @param string $url
     *
     * @return $this
     */
    public function setAction(string $url): self;

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setMethod(string $method): self;

    /**
     * @param string $enctype
     *
     * @return $this
     */
    public function setEnctype(string $enctype): self;

    /**
     * @param Model|Collection|array $formData
     */
    public function setFormData($formData): self;

    /**
     * @param array|null $data
     *
     * @return $this
     */
    public function setValues(?array $data = null): self;

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function setAttributes(array $attributes): self;

    /**
     * @param array $attributes
     * @param string $glue
     *
     * @return $this
     */
    public function addAttributes(array $attributes, string $glue = ' '): self;

    /**
     * @param ISection $section
     *
     * @return $this
     */
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

    /**
     * @param string $fieldName
     *
     * @return IField|null
     */
    public function getField(string $fieldName): ?IField;

    /**
     * @return Data
     */
    public function getAttributes(): Data;

    /**
     * @param array $fields
     *
     * @return $this
     */
    public function except(array $fields): self;

    /**
     * @param array $fields
     *
     * @return $this
     */
    public function only(array $fields): self;

    /**
     * @return Collection|ISection[]
     */
    public function getSections();

    /**
     * The prefix argument is used to prefix all fields with it so laravel validator can validate groups of data
     */
    public function getValidationRules(string $prefix = ''): array;

    /**
     * @param string|null $fieldName
     *
     * @return array
     */
    public function getRules(?string $fieldName = null): array;

    /**
     * @return string
     */
    public function getTheme(): string;

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getEnctype(): string;

    /** @return Model|Collection|array */
    public function getFormData();

    /**
     *
     */
    public function resolve(): void;

    /**
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * @return string
     */
    public function errorMessage(): string;

    /**
     *
     */
    public function fill(): void;
}
