<?php

namespace Formz\Contracts;

use Illuminate\Support\Collection;

interface IForm extends \JsonSerializable
{
    /**
     * @param array $only
     * @return Collection|IField[]
     */
    public function getFields($only = []);

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
     * @param array $fields
     * @return IField|null
     */
    public function except(array $fields);

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
     * @param IField $field
     * @return IForm
     */
    public function addField(IField $field): IForm;

    /**
     * @param array|IField[] $fields
     * @return IForm
     */
    public function addFields(array $fields): IForm;

    /**
     * @param ISection $section
     * @return IForm
     */
    public function addSection(ISection $section): IForm;

    /**
     * @param array $array
     * @return mixed
     */
    public function addWorkflows(array $array): IForm;

    /**
     * @param array $data
     * @return IForm
     */
    public function setValues(?array $data): IForm;

    /**
     * @return array
     */
    public function toArray(): array;
}
