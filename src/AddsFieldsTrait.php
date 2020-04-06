<?php

namespace Formz;

use Formz\Contracts\ISection;
use Formz\Fields\Checkbox;
use Formz\Fields\Choice;
use Formz\Fields\Date;
use Formz\Fields\File;
use Formz\Fields\Hidden;
use Formz\Fields\Number as NumberField;
use Formz\Fields\Password;
use Formz\Fields\Radio;
use Formz\Fields\Text;
use Formz\Fields\Textarea;

trait AddsFieldsTrait
{
    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return ISection
     */
    public function text(string $name, string $label = null, $value = null): ISection
    {
        $field = new Text($name, $value, $label);

        $this->context instanceof ISection ? $this->context->addField($field) : $this->addField($field);

        return $field;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return ISection
     */
    public function password(string $name, string $label = null, $value = null): ISection
    {
        $field = new Password($name, $value, $label);
        $this->addField($field);

        return $this;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return ISection
     */
    public function textarea(string $name, string $label = null, $value = null): ISection
    {
        $field = new Textarea($name, $value, $label);
        $this->addField($field);

        return $this;

    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return ISection
     */
    public function hidden(string $name, string $label = null, $value = null): ISection
    {
        $field = new Hidden($name, $value, $label);
        $this->addField($field);

        return $this;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return ISection
     */
    public function number(string $name, string $label = null, $value = null): ISection
    {
        $field = new NumberField($name, $value, $label);
        $this->addField($field);

        return $this;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return ISection
     */
    public function select(string $name, Options $options, string $label = null, $value = null): ISection
    {
        $type = 'select';
        $field = new Choice($type, $name, $options, $value, $label);
        $this->addField($field);

        return $this;
    }


    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return ISection
     */
    public function selectMultiple(string $name, Options $options, string $label = null, $value = null): ISection
    {
        $type = 'multiselect';
        $field = new Choice($type, $name, $options, $value, $label);
        $this->addField($field);

        return $this;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return ISection
     */
    public function radio(string $name, Options $options, string $label = null, $value = null): ISection
    {
        $field = new Radio($name, $options, $value, $label);
        $this->addField($field);

        return $this;
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return ISection
     */
    public function checkbox(string $name, Options $options, string $label = null, $value = null): ISection
    {
        $field = new Checkbox($name, $options, $value, $label);
        $this->addField($field);

        return $this;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return ISection
     */
    public function date(string $name, $label = null, $value = null): ISection
    {
        $field = new Date($name, $value, $label);
        $this->addField($field);

        return $this;
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return ISection
     */
    public function file(string $name, $value = null, $label = null): ISection
    {
        $field = new File($name, $value, $label);
        $this->addField($field);

        return $this;
    }
}
