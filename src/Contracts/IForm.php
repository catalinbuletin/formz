<?php

namespace Formz\Contracts;

use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IForm extends \JsonSerializable
{
    /**
     * @param string $url
     * @return IForm
     */
    public function setAction(string $url): IForm;

    /**
     * @param string $method
     * @return IForm
     */
    public function setMethod(string $method): IForm;

    /**
     * @param string $enctype
     * @return IForm
     */
    public function setEnctype(string $enctype): IForm;

    /**
     * @param array $data
     * @return IForm
     */
    public function setValues(?array $data): IForm;

    /**
     * Set Form attributes
     *
     * @param array $attributes
     * @return static
     */
    public function setAttributes(array $attributes): self;

    /**
     * @param ISection $section
     * @return IForm
     */
    public function addSection(ISection $section): IForm;

    /**
     * @param array|IField[] $fields
     * @return IForm
     */
    public function addFields(array $fields): IForm;

    // @todo -> cleanup
    /**
     * @param array $array
     * @return mixed
     */
    //public function addWorkflows(array $array): IForm;

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function validate(Request $request);

    /**
     * @param string $theme
     *
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
    public function getFieldNames($assoc = false, $prefix = null);

    /**
     * @param bool $assoc - if true, returns a key-value array where key is the name of the field and value an array: ['label' => "Label", 'value' => 123]
     * @param null $prefix - if assoc is true and prefix has a value, it prefixes the key
     * @return array
     */
    public function getFormValues($assoc = false, $prefix = null);

    /**
     * @param $fieldName
     * @return IField|null
     */
    public function getField($fieldName);

    /**
     * Set Form attributes
     *
     * @return Data
     */
    public function getAttributes(): Data;

    /**
     * @param array $fields
     * @return IField|null
     */
    public function except(array $fields);

    /**
     * @param array $fields
     * @return IField|null
     */
    public function only(array $fields);

    /**
     * @return Collection|ISection[]
     */
    public function getSections();

    /**
     * @param string $prefix
     * @return array
     */
    public function getValidationRules($prefix = '');

    /**
     * @param null $fieldName
     * @return mixed
     */
    public function getRules($fieldName = null);

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

    /**
     * @return array
     */
    public function toArray(): array;
}
