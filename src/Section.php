<?php

namespace Formz;

use Dflydev\DotAccessData\Data;
use Formz\Contracts\IField;
use Formz\Contracts\IForm;
use Formz\Contracts\ISection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Formz\Fields\Checkbox;
use Formz\Fields\Choice;
use Formz\Fields\Date;
use Formz\Fields\AbstractField;
use Formz\Fields\File;
use Formz\Fields\Number;
use Formz\Fields\Password;
use Formz\Fields\Radio;
use Formz\Fields\Textarea;
use Formz\Fields\Text;
use Illuminate\Support\ViewErrorBag;

class Section implements ISection
{
    use AttributesTrait;

    private string $uuid;
    private string $label;
    private Collection $fields;
    private string $helpText;
    protected IForm $context;
    protected bool $resolved = false;

    /**
     * Section constructor.
     *
     * @param null|string $uuid
     * @param null|string $label
     * @param AbstractField[] $fields
     */
    private function __construct(?string $uuid = null, ?string $label = null, array $fields = [])
    {
        $this->uuid = $uuid;
        $this->label = $label;
        $this->fields = new Collection();

        $this->addFields($fields);
    }

    public static function make(?string $label = null, ?array $fields = [])
    {
        $uuid = self::generateId($label);

        return new static($uuid, $label ?: '', $fields);
    }

    public function setContext(IForm $context): ISection
    {
        $this->context = $context;
        $this->setDefaultAttributes();
        return $this;
    }

    public function setLabel(?string $label = null): ISection
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param IField[] $fields
     * @return ISection
     */
    public function addFields(array $fields): ISection
    {
        /** @var IField $field */
        foreach ($fields as $field) {
            $field->setContext($this);
            $this->addField($field);
        }

        return $this;
    }


    public function addField(IField $field): ISection
    {
        $field->setContext($this);
        $this->fields->push($field);

        return $this;
    }

    /**
     * @param string|IField $field
     */
    public function removeField($field)
    {
        $fieldName = $field instanceof IField ? $field->getName() : $field;

        $this->fields = $this->fields->filter(function (IField $field) use ($fieldName) {
            return $field->getName() !== $fieldName;
        });
    }

    /**
     * @param array|IField[] $fields
     */
    public function removeFields(array $fields)
    {
        foreach ($fields as $field) {
            $this->removeField($field);
        }
    }

    /**
     * @param array $only
     *
     * @return Collection|AbstractField[]
     */
    public function getFields(array $only = [])
    {
        if (!$only) {
            return $this->fields;
        }

        return $this->fields->filter(function (IField $field) use ($only) {
            return in_array($field->getName(), $only);
        });
    }

    public function getContext(): IForm
    {
        return $this->context;
    }


    public function setHelpText(string $helpText): ISection
    {
        $this->helpText = $helpText;

        return $this;
    }

    public function getHelpText(): string
    {
        return $this->helpText ?? '';
    }

    protected function defaultAttributes(): array
    {
        return [
            'class' => Config::get('formz.themes.' . $this->getContext()->getTheme() . '.section_class')
        ];
    }

    public function toArray()
    {
        return [
            'id' => $this->uuid,
            'fields' => $this->fields,
            'name' => $this->label,
            'attributes' => $this->attributes->export(),
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    private static function generateId(?string $label = '')
    {
        $random = Str::random(8);
        $label = Str::snake($label);

        return $label ? "{$label}_{$random}" : $random;
    }

    /**
     * @param array $data
     *
     * @return Section
     * @throws FormzException
     */
    public static function hydrate(array $data)
    {
        $section = new static($data['id'] ?? null);

        $section->setLabel($data['name'] ?? null);

        foreach ($data['fields'] as $field) {
            if (!isset(AbstractField::FIELDS_MAPPER[$field['type']])) {
                throw new FormzException($field['type'] . ' field type does not exist.');
            }
            // @ todo throw exception if type does not exist
            $fieldClass = AbstractField::FIELDS_MAPPER[$field['type']];

            $section->addField($fieldClass::makeFromArray($field));
        }

        return $section;
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

    public function getFieldsErrors(): array
    {
        $errorMessages = [];

        if (Session::has('errors')) {
            $errors = Session::get('errors');
            if ($errors instanceof ViewErrorBag) {
                foreach ($this->getFields() as $field) {
                    if ($errors->has($field->getName())) {
                        switch ($this->getContext()->getConfig()['errors']['global']['display']) {
                            case 'first':
                                $fieldErrors = $errors->get($field->getName());
                                $errorMessages[] = reset($fieldErrors);
                                break;

                            case 'all':
                                $errorMessages = array_merge($errorMessages, $errors);
                                break;

                            case 'none':
                            default:
                                break;
                        }
                    }
                }
            }
        }

        return $errorMessages;
    }

    private function addErrorClasses()
    {
        if ($this->hasErrors()) {
            $this->mergeAttributes([
                'class' => Config::get('formz.themes.' . $this->getContext()->getTheme() . '.error_class.section'),
            ]);
        }
    }

    public function resolve(): void
    {
        if (!$this->resolved) {
            $this->addErrorClasses();
            foreach ($this->getFields() as $field) {
                $field->resolve();
            }
            $this->resolved = true;
        }
    }
}
