<?php

namespace Formz\Fluent;

use Formz\Fluent\Fields\FluentCheckboxField;
use Formz\Fluent\Fields\FluentChoiceField;
use Formz\Fluent\Fields\FluentDateField;
use Formz\Fluent\Fields\FluentFileField;
use Formz\Fluent\Fields\FluentHiddenField;
use Formz\Fluent\Fields\FluentNumberField;
use Formz\Fluent\Fields\FluentPasswordField;
use Formz\Fluent\Fields\FluentRadioField;
use Formz\Fluent\Fields\FluentTextareaField;
use Formz\Fluent\Fields\FluentTextField;
use Formz\Options;

class FluentSection
{
    private \Formz\Contracts\ISection $section;
    private \Formz\Fluent\FluentForm $context;

    public static function make(?string $label = null): FluentSection
    {
        $instance = new static();

        $instance->section = \Formz\Section::make($label);

        return $instance;
    }

    public function section(?string $label = null): FluentSection
    {
        return $this->context->section($label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentTextField
     */
    public function text(string $name, string $label = null, $value = null): FluentTextField
    {
        $field = FluentTextField::make($name, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentPasswordField
     */
    public function password(string $name, string $label = null, $value = null): FluentPasswordField
    {
        $field =  FluentPasswordField::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentTextareaField
     */
    public function textarea(string $name, string $label = null, $value = null): FluentTextareaField
    {
        $field =  FluentTextareaField::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;

    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentHiddenField
     */
    public function hidden(string $name, string $label = null, $value = null): FluentHiddenField
    {
        $field =  FluentHiddenField::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return FluentNumberField
     */
    public function number(string $name, string $label = null, $value = null): FluentNumberField
    {
        $field =  FluentNumberField::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return FluentChoiceField
     */
    public function select(string $name, Options $options, string $label = null, $value = null): FluentChoiceField
    {
        $type = 'select';

        $field =  FluentChoiceField::make($type, $name, $options, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }


    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return FluentChoiceField
     */
    public function selectMultiple(string $name, Options $options, string $label = null, $value = null): FluentChoiceField
    {
        $type = 'multiselect';

        $field =  FluentChoiceField::make($type, $name, $options, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return FluentRadioField
     */
    public function radio(string $name, Options $options, string $label = null, $value = null): FluentRadioField
    {
        $field =  FluentRadioField::make($name, $options, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return FluentCheckboxField
     */
    public function checkbox(string $name, Options $options, string $label = null, $value = null): FluentCheckboxField
    {
        $field =  FluentCheckboxField::make($name, $options, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return FluentDateField
     */
    public function date(string $name, $label = null, $value = null): FluentDateField
    {
        $field =  FluentDateField::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return FluentFileField
     */
    public function file(string $name, $value = null, $label = null): FluentFileField
    {
        $field =  FluentFileField::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    public function setContext(FluentForm $context)
    {
        $this->context = $context;

        return $this;
    }

    public function getSection(): \Formz\Contracts\ISection
    {
        return $this->section;
    }

    public function get(): \Formz\Contracts\IForm
    {
        return $this->context->get();
    }
}
