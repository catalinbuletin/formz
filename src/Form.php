<?php

namespace Formz;

use Dflydev\DotAccessData\Data;
use Formz\Contracts\IField;
use Formz\Contracts\ISection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Formz\Contracts\IForm;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ViewErrorBag;

class Form implements IForm
{
    use HasAttributes;

    /**
     * @var mixed|string|null
     */
    protected ?string $name;
    /**
     * @var array|mixed
     */
    protected array $layout;
    /**
     * @var string
     */
    protected string $action;
    /**
     * @var string
     */
    protected string $method;
    /**
     * @var mixed|string
     */
    protected string $theme;
    /**
     * @var string
     */
    protected string $enctype = '';
    /**
     * @var array
     */
    protected array $config;
    /**
     * @var Model|Collection|array
     */
    protected $formData;
    /**
     * @var bool
     */
    protected bool $resolved = false;

    /**
     * @var Collection|ISection[]
     */
    protected $sections = [];

    /**
     * Form constructor.
     *
     * @param array $sections
     * @param array $config
     *
     * @throws FormzException
     */
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

        $this->setDefaultAttributes();

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
     * @param array|null $sections
     * @param array|null $config
     *
     * @return IForm
     * @throws FormzException
     */
    public static function make(?array $sections = [], ?array $config = []): IForm
    {
        return new static($sections, $config);
    }

    /**
     * @param string $url
     *
     * @return IForm
     */
    public function setAction(string $url): IForm
    {
        $this->action = $url;

        return $this;
    }

    /**
     * @param string $method
     *
     * @return IForm
     */
    public function setMethod(string $method): IForm
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param string $theme
     *
     * @return IForm
     */
    public function setTheme(string $theme): IForm
    {
        $this->theme = $theme;
        $this->setDefaultAttributes();

        return $this;
    }

    /**
     * @param string $enctype
     *
     * @return IForm
     */
    public function setEnctype(string $enctype): IForm
    {
        $this->enctype = $enctype;

        return $this;
    }

    /**
     * @param Model|Collection|array $formData
     *
     * @return IForm
     */
    public function setFormData($formData): IForm
    {
        $this->formData = $formData;

        return $this;
    }

    /**
     * @return string
     */
    public function getTheme(): string
    {
        return $this->theme;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getEnctype(): string
    {
        return $this->enctype;
    }

    /**
     * @return Model|Collection|array
     */
    public function getFormData()
    {
        return $this->formData;
    }

    /**
     * @return array
     */
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
     *
     * @return IForm
     */
    public function addFields(array $fields): IForm
    {
        $section = Section::make(null, $fields)->setContext($this);

        return $this->addSection($section);
    }

    /**
     * @param ISection $section
     *
     * @return IForm
     */
    public function addSection(ISection $section): IForm
    {
        $section->setContext($this);

        $this->sections->push($section);

        return $this;
    }

    /**
     * @param array|null $data
     *
     * @return IForm
     */
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
     * @throws FormzException
     */
    public function fill(): void
    {
        if (is_array($this->formData)) {
            $this->formData = collect($this->formData);
        }

        if ($this->formData instanceof Collection) {
            $this->fillUsingCollection();
        }

        if ($this->formData instanceof Model) {
            $this->fillUsingModel();
        }
    }

    /**
     * @param Request $request
     *
     * @return array|mixed
     */
    public function validate(Request $request)
    {
        return $request->validate(
            $this->getValidationRules()
        );
    }

    /**
     * @param array $only
     *
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
     * @return IForm
     */
    public function except(array $fields): IForm
    {
        foreach ($this->sections as $section) {
            $fieldsToRemove = $section->getFields()->filter(
                fn(IField $field) => in_array($field->getName(), $fields)
            );

            $section->removeFields($fieldsToRemove->toArray());
        }

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return IForm
     */
    public function only(array $fields): IForm
    {
        foreach ($this->sections as $section) {
            $fieldsToRemove = $section->getFields()->filter(
                fn(IField $field) => !in_array($field->getName(), $fields)
            );

            $section->removeFields($fieldsToRemove->toArray());
        }

        return $this;
    }


    /**
     * @param bool $assoc
     * @param null $prefix
     *
     * @return array
     */
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

    /**
     * @param bool $assoc
     * @param string|null $prefix
     *
     * @return array
     */
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

    /**
     * @param string $fieldName
     *
     * @return IField|null
     */
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

    /**
     * @param string|null $fieldName
     *
     * @return array
     */
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

    /**
     * @return bool
     */
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

    /**
     * @return string
     */
    public function errorMessage(): string
    {
        if ($this->getConfig()['errors']['global']['active']) {
            $errorMessages = $this->getFormErrors();
            if ($errorMessages) {
                $errorMessages = array_merge([$this->getConfig()['errors']['global']['message'], ''], $errorMessages);
            }
            return implode("\n", $errorMessages);
        }

        return '';
    }

    /**
     * @return array
     */
    private function getFormErrors(): array
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

    /**
     * @param string $prefix
     *
     * @return array
     */
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

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     *
     */
    private function addErrorClasses()
    {
        if ($this->hasErrors()) {
            $this->addAttributes([
                'class' => Config::get('formz.themes.' . $this->getTheme() . '.error_class.form'),
            ]);
        }
        if ($this->getFormErrors()) {
            $this->addAttributes([
                'global_error_class' => Config::get('formz.themes.' . $this->getTheme() . '.error_class.global'),
            ]);
        }
    }

    /**
     * @throws FormzException
     */
    public function resolve(): void
    {
        if ($this->resolved) {
            return;
        }

        $this->fill();

        $this->addErrorClasses();

        foreach ($this->getSections() as $section) {
            $section->resolve();
        }

        $this->resolved = true;

    }

    /**
     * @throws FormzException
     */
    protected function fillUsingCollection()
    {
        if (!$this->formData instanceof Collection) {
            throw new FormzException('formData is not a Collection.');
        }

        foreach ($this->getFields() as $field) {
            if ($value = $this->formData->get($field->getName())) {
                $field->setValue($value);
            }
        }
    }

    /**
     * @throws FormzException
     */
    protected function fillUsingModel()
    {
        if (!$this->formData instanceof Model) {
            throw new FormzException('formData must be an instance of ' . Model::class);
        }

        // @todo - handle model relationships here and return the id or array of ids
        foreach ($this->getFields() as $field) {
            if (array_key_exists($field->getName(), $this->formData->getAttributes())) {
                $field->setValue($this->formData->{$field->getName()});
                continue;
            }

            if (method_exists($this->formData, $field->getName())) {
                $field->setValue($this->formData->{$field->getName()}());
            }
        }
    }
}
