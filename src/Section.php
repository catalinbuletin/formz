<?php

namespace Formz;

use Formz\Contracts\IField;
use Formz\Contracts\IForm;
use Formz\Contracts\ISection;
use Illuminate\Support\Collection;
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

class Section implements ISection
{
    use AddsFieldsTrait;

    private string $uuid;
    private string $label;
    private Collection $fields;

    protected IForm $context;

    /**
     * Section constructor.
     *
     * @param null|string $uuid
     * @param null|string $label
     * @param AbstractField[] $fields
     */
    private function __construct(string $uuid, string $label = null, array $fields = [])
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

        return $this;
    }

    public function setLabel($label = null): ISection
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param IField[] $fields
     *
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


    /**
     * @param IField $field
     *
     * @return ISection
     */
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
    public function getFields($only = [])
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


    public function toArray()
    {
        return [
            'id' => $this->uuid,
            'fields' => $this->fields,
            'name' => $this->label,
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
     */
    public static function hydrate(array $data)
    {
        $section = new static($data['id'] ?? null);

        $section->setLabel($data['name'] ?? null);

        // @todo move to config file
        $fieldsMapper = [
            'text' => Text::class,
            'password' => Password::class,
            'number' => Number::class,
            'textarea' => Textarea::class,
            'select' => Choice::class,
            'multiselect' => Choice::class,
            'checkbox' => Checkbox::class,
            'radio' => Radio::class,
            'date' => Date::class,
            'file' => File::class,
        ];

        foreach ($data['fields'] as $field) {
            // @ todo throw exception if type does not exist
            $fieldClass = $fieldsMapper[$field['type']];

            $section->addField($fieldClass::makeFromArray($field));
        }

        return $section;
    }
}
