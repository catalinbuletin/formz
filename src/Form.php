<?php

namespace Formz;

use Formz\Contracts\IField;
use Formz\Contracts\IRule;
use Formz\Contracts\ISection;
use Formz\Contracts\IWorkflow;
use Formz\RulesLibrary;
use Illuminate\Support\Collection;
use Formz\Contracts\IForm;
use Formz\WorkflowFactory;

class Form implements IForm
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $type;

    /** @var array|mixed */
    protected $layout;

    /** @var Collection|ISection[] */
    protected $sections = [];

    /**
     * Form constructor.
     * @param array $sections
     * @param array $properties
     */
    public function __construct($sections = [], array $properties = [])
    {
        if (!empty($sections)) {
            foreach ($sections as $section) {
                $this->addSection(Section::makeFromArray($section));
            }
        }

        $this->name = array_key_exists('name', $properties) ? $properties['name'] : null;

        $this->type = array_key_exists('type', $properties) ? $properties['type'] : 'dynamicForm';

        $this->layout = array_key_exists('layout', $properties) ? $properties['layout'] : [
            'type' => 'labelValue',
            'params' => []
        ];
    }

    /**
     * @param null|array $sections
     * @param null|array $properties
     *
     * @return Form
     */
    public static function make(?array $sections = [], ?array $properties = [])
    {
        return new static($sections, $properties);
    }

    /**
     * @param array $fields
     * @param array $properties
     * @return Form
     */
    public static function makeWithFields(array $fields = [], array $properties = [])
    {
        $form = static::makeEmpty($properties);

        foreach ($fields as $field) {
            $form->addField($field);
        }

        return $form;
    }

    /**
     * @param array $formData
     * @return Form
     */
    public static function makeFromArray(array $formData)
    {
        $sections = $formData['sections'];
        unset($formData['sections']);

        return new static($sections, $formData);
    }

    /**
     * @param array $only
     * @return Collection|IField[]
     */
    public function getFields($only = [])
    {
        $fields = new Collection;

        foreach ($this->sections as $section) {
            $fields = $fields->merge($section->getFields($only));
        }

        return $fields;
    }

    /**
     * @param array $fields
     *
     * @return $this|IField|null
     */
    public function except(array $fields)
    {
        foreach ($this->sections as $section) {
            foreach ($fields as $fieldName) {
                $section->removeField($fieldName);
                unset($fields[$fieldName]);
            }
        }

        return $this;
    }

    /**
     * Returns an array of field names
     *
     * @param bool $assoc
     * @param null $prefix
     * @return array
     */
    public function getFieldNames($assoc = false, $prefix = null)
    {
        if (!$assoc) {
            return $this->getFields()->map(function (IField $field) {
                return $field->getName();
            })->toArray();
        }

        $fields = [];

        foreach ($this->getFields() as $field) {
            $key = $prefix ? $prefix . $field->getName() : $field->getName();
            $fields[$key] = $field->getLabel();
        }

        return $fields;
    }

    /**
     * Returns an array of field values
     *
     * @param bool $assoc
     * @param null $prefix
     * @return array
     */
    public function getFormValues($assoc = false, $prefix = null)
    {
        if (!$assoc) {
            return $this->getFields()->map(function (IField $field) {
                return $field->getValue();
            })->toArray();
        }

        $fields = [];

        foreach ($this->getFields() as $field) {
            $key = $prefix ? $prefix . $field->getName() : $field->getName();
            $fields[$key] = [
                'label' => $field->getLabel(),
                'value' => $field->getValue()
            ];
        }

        return $fields;
    }

    /**
     * @param $fieldName
     * @return IField|null
     */
    public function getField($fieldName)
    {
        return $this->getFields()->first(function (IField $field) use ($fieldName) {
            return $field->getName() === $fieldName;
        });
    }


    /**
     * @return Collection|Section[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param null|string $fieldName
     * @return array
     */
    public function getRules($fieldName = null)
    {
        $rules = [];

        if ($fieldName && $field = $this->getField($fieldName)) {
            return $field->getRules();
        }

        /** @var IField $field */
        foreach ($this->getFields() as $field) {
            $rules[$field->getName()] = $field->getRules();
        }

        return $rules;
    }

    /**
     * The prefix argument is used to prefix all fields with it so laravel validator can validate groups of data
     *
     * @param string $prefix
     * @return array
     * @throws \ReflectionException
     */
    public function getValidationRules($prefix = '')
    {
        $validationArray = [];
        $fields = $this->getRules();

        foreach ($fields as $fieldName => $rules) {
            $prefixedFieldName = $prefix ? "{$prefix}.{$fieldName}" : $fieldName;
            $validationArray[$prefixedFieldName] = [];
            foreach ($rules as $rule) {
                // check if the rule is an array and if so, create a rule object out of it
                if (!$rule instanceof IRule) {
                    $rule = RulesLibrary::makeRule($rule['name'], $rule['params'] ?: []);
                }

                $validationArray[$prefixedFieldName][] = $rule->__toString();
            }
        }

        return $validationArray;
    }


    /**
     * Shortcut for adding a field without a form section. The section will be created automatically
     *
     * @param IField $field
     * @return IForm
     */
    public function addField(IField $field): IForm
    {
        $section = new Section(null, [$field]);

        return $this->addSection($section);
    }

    /**
     * Shortcut for adding an array of fields. The sections will be created automatically
     *
     * @param IField[]|array $fields
     * @return IForm
     */
    public function addFields(array $fields): IForm
    {
        $section = new Section(null, $fields);

        return $this->addSection($section);

//        foreach ($fields as $field) {
//            $this->addField($field);
//        }
//
//        return $this;
    }

    /**
     * @param ISection $section
     * @return IForm
     */
    public function addSection(ISection $section): IForm
    {
        if (!$this->sections instanceof Collection) {
            $this->sections = new Collection;
        }

        $this->sections->push($section);

        return $this;
    }

    public function addWorkflows(array $workflows): IForm
    {
        foreach ($workflows as $workflow) {
            $this->addWorkflow($workflow);
        }

        return $this;
    }

    /**
     * @param array $data
     * @return IForm
     */
    public function setValues(?array $data): IForm
    {
        if (empty($data)) {
            return $this;
        }

        foreach ($this->getFields() as $field) {
            if (!isset($data[$field->getName()])) {
                continue;
            }

            $field->setValue($data[$field->getName()]);
        }

        return $this;
    }

    public function addWorkflow(IWorkflow $workflow)
    {
        $workflow->setContext($this);

        $this->getField($workflow->getFieldName())->workflows([
            $workflow
        ]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'sections' => $this->sections,
            'layout' => $this->layout
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
