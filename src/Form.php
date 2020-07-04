<?php

namespace Formz;

use Dflydev\DotAccessData\Data;
use Formz\Contracts\IField;
use Formz\Contracts\IRule;
use Formz\Contracts\ISection;
use Formz\Contracts\IWorkflow;
use Formz\RulesLibrary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Formz\Contracts\IForm;
use Formz\WorkflowFactory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ViewErrorBag;

class Form implements IForm
{
    use AttributesTrait;

    protected ?string $name;
    protected array $layout;
    protected string $action;
    protected string $method;
    protected string $theme;
    protected string $enctype = '';
    protected array $config;
    protected bool $resolved = false;

    /**
     * @var Collection|ISection[]
     */
    protected $sections = [];

    protected Data $attributes;

    public function __construct(array $sections = [], array $config = [])
    {
        $this->name = Arr::get($config, 'name');

        $this->layout = Arr::get($config, 'layout', [
            'type' => 'labelValue',
            'params' => []
        ]);

        $this->theme = Arr::get($config, 'theme', Config::get('formz.theme'));

        $this->config = [
            'buttons' => Config::get('formz.buttons'),
            'errors' => Config::get('formz.errors'),
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

    public static function make(?array $sections = [], ?array $config = []): IForm
    {
        return new static($sections, $config);
    }

    public function setAction(string $url): IForm
    {
        $this->action = $url;

        return $this;
    }

    public function setMethod(string $method): IForm
    {
        $this->method = $method;

        return $this;
    }

    public function setTheme(string $theme): IForm
    {
        $this->theme = $theme;
        $this->setDefaultAttributes();

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

    public function getConfig(): array
    {
        return $this->config;
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
            'class' => Config::get('formz.themes.' . $this->getTheme() . '.form_class'),
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

    public function setValues(?array $data = null): IForm
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
     * @param array|Model|Collection $formData
     * @return bool
     */
    public static function bind($formData): bool
    {
        return true;

        /*$sections = $formData['sections'];
        unset($formData['sections']);

        return new static($sections, $formData);*/
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

    public function except(array $fields): IForm
    {
        foreach ($this->sections as $section) {
            $fieldsToRemove = $section->getFields()->filter(
                fn (IField $field) => in_array($field->getName(), $fields)
            );

            $section->removeFields($fieldsToRemove->toArray());
        }

        return $this;
    }

    public function only(array $fields): IForm
    {
        foreach ($this->sections as $section) {
            $fieldsToRemove = $section->getFields()->filter(
                fn (IField $field) => !in_array($field->getName(), $fields)
            );

            $section->removeFields($fieldsToRemove->toArray());
        }

        return $this;
    }


    public function getFieldNames($assoc = false, $prefix = null): array
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

    public function getFormValues(bool $assoc = false, ?string $prefix = null): array
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

    public function getField($fieldName): ?IField
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

    public function getRules(?string $fieldName = null): array
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

    public function hasErrors(): bool
    {
        if (Session::has('errors')) {
            $errors = Session::get('errors');
            if ($errors instanceof ViewErrorBag) {
                foreach ($this->getFields() as $field) {
                    if ($errors->has($field->getName())) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function errorMessage(): string
    {
        if ($this->getConfig()['errors']['global']['active']) {
            $errorMessages = $this->getFieldsErrors();
            if ($errorMessages) {
                $errorMessages = array_merge([$this->getConfig()['errors']['global']['message'], ''], $errorMessages);
            }
            return implode("\n", $errorMessages);
        }

        return '';
    }

    private function getFieldsErrors(): array
    {
        $errorMessages = [];

        if (Session::has('errors')) {
            $errors = Session::get('errors');
            if ($errors instanceof ViewErrorBag) {
                foreach ($this->getFields() as $field) {
                    if ($errors->has($field->getName())) {
                        switch ($this->getConfig()['errors']['global']['display']) {
                            case 'first':
                                $fieldErrors = $errors->get($field->getName());
                                $errorMessages[] = reset($fieldErrors);
                                break;

                            case 'all':
                                $errorMessages = array_merge($errorMessages, $errors);
                                break;

                            case 'none':
                            default:
                                return $this->getConfig()['errors']['global']['message'];
                                break;
                        }
                    }
                }
            }
        }

        return $errorMessages;
    }

    public function getValidationRules(string $prefix = ''): array
    {
        return $this->getRules();
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

    private function addErrorClasses()
    {
        if ($this->hasErrors()) {
            $this->mergeAttributes([
                'class' => Config::get('formz.themes.' . $this->getTheme() . '.error_class.form'),
            ]);
        }
        if ($this->getFieldsErrors()) {
            $this->mergeAttributes([
                'global_error_class' => Config::get('formz.themes.' . $this->getTheme() . '.error_class.global'),
            ]);
        }
    }

    public function resolve(): void
    {
        if (!$this->resolved) {
            $this->addErrorClasses();
            foreach ($this->getSections() as $section) {
                $section->resolve();
            }
            $this->resolved = true;
        }
    }
}
