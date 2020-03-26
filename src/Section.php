<?php

namespace Formz;

use Formz\Contracts\IField;
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
    protected string $id;

    /** @var array|Collection|AbstractField[]  */
    protected Collection $fields;

    /** @var string|null */
    private ?string $name;

    /**
     * Section constructor.
     *
     * @param null|string $id
     * @param AbstractField[] $fields
     * @param null|string $name
     */
    public function __construct(?string $id = null, ?array $fields = [], ?string $name = null)
    {
        $this->id = is_null($id) ? Str::random(10) : $id;
        $this->fields = $fields instanceof Collection ? $fields : new Collection($fields);
        $this->name = $name;
    }

    /**
     * @param array $sectionData
     *
     * @return Section
     */
    public static function makeFromArray(array $sectionData)
    {
        $section = new static($sectionData['id'] ?? null);

        $section->setName($sectionData['name'] ?? null);

        // @todo need a way to register available fields. as developer custom fields might be registered
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

        if (!empty($sectionData['fields'])) {
            foreach ($sectionData['fields'] as $field) {
                $fieldClass = $fieldsMapper[$field['type']] ?? AbstractField::class;

                $section->addField($fieldClass::makeFromArray($field));
            }
        }

        return $section;
    }

    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
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

    /**
     * @param IField $field
     *
     * @return ISection
     */
    public function addField(IField $field)
    {
        $this->fields->push($field);

        return $this;
    }

    /**
     * @param string $fieldName
     */
    public function removeField(string $fieldName)
    {
        $this->fields = $this->fields->filter(function (AbstractField $field) use ($fieldName) {
            return $field->getName() !== $fieldName;
        });
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'fields' => $this->fields,
            'name' => $this->name,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
