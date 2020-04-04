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
    protected ?string $name;

    protected ?string $type;

    protected array $layout;

    /** @var Collection|ISection[] */
    protected $sections = [];

    /**
     * Form constructor.
     *
     * @param array $sections
     * @param array $config
     */
    public function __construct(array $sections = [], array $config = [])
    {
        $this->name = array_key_exists('name', $config) ? $config['name'] : null;

        $this->type = 'dynamicForm';

        $this->layout = array_key_exists('layout', $config) ? $config['layout'] : [
            'type' => 'labelValue',
            'params' => []
        ];

        $this->sections = new Collection();

        foreach ($sections as $section) {
            if ($section instanceof Section) {
                $this->addSection($section);
                continue;
            }

            $this->addSection(Section::hydrate($section));
        }
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
     * Shortcut for adding an array of fields. The sections will be created automatically
     *
     * @param IField[]|array $fields
     * @return IForm
     */
    public function addFields(array $fields): IForm
    {
        $section = Section::make(null, $fields);
        $section->setContext($this);

        return $this->addSection($section);
    }

    /**
     * @param ISection $section
     * @return IForm
     */
    public function addSection(ISection $section): IForm
    {
        $section->setContext($this);

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
     * @param array $formData
     * @return Form
     */
    public static function hydrate(array $formData)
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
            $fieldsToRemove = $section->getFields()->filter(
                fn (IField $field) => in_array($field->getName(), $fields)
            );

            $section->removeFields($fieldsToRemove->toArray());
        }

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return $this|IField|null
     */
    public function only(array $fields)
    {
        foreach ($this->sections as $section) {
            $fieldsToRemove = $section->getFields()->filter(
                fn (IField $field) => !in_array($field->getName(), $fields)
            );

            $section->removeFields($fieldsToRemove->toArray());
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
