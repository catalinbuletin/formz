<?php

namespace Formz\Fluent;

use Formz\Fluent\Fields\FluentCheckbox;
use Formz\Fluent\Fields\FluentChoice;
use Formz\Fluent\Fields\FluentDate;
use Formz\Fluent\Fields\FluentFile;
use Formz\Fluent\Fields\FluentHidden;
use Formz\Fluent\Fields\FluentNumber;
use Formz\Fluent\Fields\FluentPassword;
use Formz\Fluent\Fields\FluentRadio;
use Formz\Fluent\Fields\FluentTextarea;
use Formz\Fluent\Fields\FluentText;
use Formz\Options;

class FluentSection
{
    private \Formz\Contracts\ISection $section;
    private \Formz\Fluent\FluentForm $context;

    /**
     * @param string|null $label
     *
     * @return FluentSection
     */
    public static function make(?string $label = null): FluentSection
    {
        $instance = new static();

        $instance->section = \Formz\Section::make($label);

        return $instance;
    }

    /**
     * @param string|null $label
     *
     * @return FluentSection
     */
    public function section(?string $label = null): FluentSection
    {
        return $this->context->section($label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentText
     */
    public function text(string $name, string $label = null, $value = null): FluentText
    {
        $field = FluentText::make($name, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentPassword
     */
    public function password(string $name, string $label = null, $value = null): FluentPassword
    {
        $field =  FluentPassword::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentTextarea
     */
    public function textarea(string $name, string $label = null, $value = null): FluentTextarea
    {
        $field =  FluentTextarea::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;

    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentHidden
     */
    public function hidden(string $name, string $label = null, $value = null): FluentHidden
    {
        $field =  FluentHidden::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentNumber
     */
    public function number(string $name, string $label = null, $value = null): FluentNumber
    {
        $field = FluentNumber::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return FluentChoice
     */
    public function select(string $name, Options $options, string $label = null, $value = null): FluentChoice
    {
        $type = 'select';

        $field =  FluentChoice::make($type, $name, $options, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }


    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return FluentChoice
     */
    public function selectMultiple(string $name, Options $options, string $label = null, $value = null): FluentChoice
    {
        $type = 'multiselect';

        $field =  FluentChoice::make($type, $name, $options, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return FluentRadio
     */
    public function radio(string $name, Options $options, string $label = null, $value = null): FluentRadio
    {
        $field =  FluentRadio::make($name, $options, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return FluentCheckbox
     */
    public function checkbox(string $name, Options $options, string $label = null, $value = null): FluentCheckbox
    {
        $field =  FluentCheckbox::make($name, $options, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentDate
     */
    public function date(string $name, $label = null, $value = null): FluentDate
    {
        $field = FluentDate::make($name, $value, $label)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return FluentFile
     */
    public function file(string $name, $value = null, $label = null): FluentFile
    {
        $field = FluentFile::make($name, $value, $label)->setContext($this);

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
