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
     * @param string|null $label
     * @param $value
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
     * @param string|null $label
     * @param $value
     *
     * @return FluentPassword
     */
    public function password(string $name, string $label = null, $value = null): FluentPassword
    {
        $field =  FluentPassword::make($name, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return FluentTextarea
     */
    public function textarea(string $name, string $label = null, $value = null): FluentTextarea
    {
        $field =  FluentTextarea::make($name, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;

    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return FluentHidden
     */
    public function hidden(string $name, string $label = null, $value = null): FluentHidden
    {
        $field =  FluentHidden::make($name, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return FluentNumber
     */
    public function number(string $name, string $label = null, $value = null): FluentNumber
    {
        $field = FluentNumber::make($name, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param $value
     *
     * @return FluentChoice
     */
    public function select(string $name, $options, string $label = null, $value = null): FluentChoice
    {
        $type = 'select';

        $field =  FluentChoice::make($type, $name, $options, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }


    /**
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param $value
     *
     * @return FluentChoice
     */
    public function selectMultiple(string $name, $options, string $label = null, array $value = []): FluentChoice
    {
        $type = 'multiselect';

        $field =  FluentChoice::make($type, $name, $options, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param $value
     *
     * @return FluentRadio
     */
    public function radio(string $name, $options, string $label = null, $value = null): FluentRadio
    {
        $field =  FluentRadio::make($name, $options, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param $value
     *
     * @return FluentCheckbox
     */
    public function checkbox(string $name, $options, string $label = null, array $value = []): FluentCheckbox
    {
        $field = FluentCheckbox::make($name, $options, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return FluentDate
     */
    public function date(string $name, $label = null, $value = null): FluentDate
    {
        $field = FluentDate::make($name, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return FluentFile
     */
    public function file(string $name, string $label = null, $value = null): FluentFile
    {
        $field = FluentFile::make($name, $label, $value)->setContext($this);

        $this->section->addField($field->getField());

        return $field;
    }


    public function helpText(string $helpText): FluentSection
    {
        $this->section->setHelpText($helpText);

        return $this;
    }

    public function attr(array $attributes): self
    {
        $this->section->setAttributes($attributes);

        return $this;
    }

    public function mergeAttr(array $attributes, string $glue): self
    {
        $this->section->addAttributes($attributes, $glue);

        return $this;
    }

    public function id(string $id): self
    {
        $this->section->setAttributes(['id' => $id]);

        return $this;
    }

    public function class(string $class): self
    {
        $this->section->setAttributes(['class' => $class]);

        return $this;
    }

    public function addClass(string $class): self
    {
        $this->section->addAttributes(['class' => $class]);

        return $this;
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

    public function fill($data)
    {
        $this->context->fill($data);
    }

    public function get(): \Formz\Contracts\IForm
    {
        return $this->context->get();
    }
}
