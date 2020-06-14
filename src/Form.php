<?php

namespace Formz;

use Dflydev\DotAccessData\Data;
use Formz\Contracts\IField;
use Formz\Contracts\IRule;
use Formz\Contracts\ISection;
use Formz\Contracts\IWorkflow;
use Formz\RulesLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Formz\Contracts\IForm;
use Formz\WorkflowFactory;
use Illuminate\Support\Facades\Config;

class Form implements IForm
{
    use AttributesTrait;

    protected ?string $name;
    protected array $layout;
    protected string $action;
    protected string $method;
    protected string $theme;
    protected string $enctype = '';

    /**
     * @var Collection|ISection[]
     */
    protected $sections = [];

    protected Data $attributes;

    /**
     * Form constructor.
     *
     * @param array $sections
     * @param array $config
     */
    public function __construct(array $sections = [], array $config = [])
    {
        $this->name = Arr::get($config, 'name');

        $this->layout = Arr::get($config, 'layout', [
            'type' => 'labelValue',
            'params' => []
        ]);

        $this->theme = Arr::get($config, 'theme', Config::get('formz.theme'));

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
     * @param null|array $config
     *
     * @return Form
     */
    public static function make(?array $sections = [], ?array $config = [])
    {
        return new static($sections, $config);
    }

    /**
     * @param string $url
     * @return IForm
     */
    public function setAction(string $url): IForm
    {

    }

    /**
     * @param string $method
     * @return IForm
     */
    public function setMethod(string $method): IForm
    {

    }

    public function setTheme(string $theme): IForm
    {
        $this->theme = $theme;

        $this->setDefaultAttributesOnce();

        return $this;
    }

    public function setEnctype(string $enctype): IForm
    {
        $this->enctype = $enctype;

        return $this;
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getEnctype(): string
    {
        return $this->enctype;
    }

    protected function defaultAttributes(): array
    {
        return [
            'class' => config('formz.themes.' . $this->getTheme() . '.form_class')
        ];
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

    public function validate(Request $request)
    {
        try {
            return $request->validate(
                $this->getValidationRules()
            );
        } catch (\ReflectionException $e) {
            // @todo - handle exception
        }
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

        return $this->getRules();

        /**
         *
         * @todo - used with the UI Designer
         */
//        foreach ($fields as $fieldName => $rules) {
//            $prefixedFieldName = $prefix ? "{$prefix}.{$fieldName}" : $fieldName;
//            $validationArray[$prefixedFieldName] = [];
//            foreach ($rules as $rule) {
//                // check if the rule is an array and if so, create a rule object out of it
//                if (!$rule instanceof IRule) {
//                    $rule = RulesLibrary::makeRule($rule['name'], $rule['params'] ?: []);
//                }
//
//                $validationArray[$prefixedFieldName][] = $rule->__toString();
//            }
//        }
//
//        return $validationArray;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'theme' => $this->theme,
            'sections' => $this->sections,
            'layout' => $this->layout,
            'attributes' => $this->attributes->export(),
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
