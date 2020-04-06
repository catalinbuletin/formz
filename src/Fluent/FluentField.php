<?php

namespace Formz\Fluent;

use Formz\Contracts\IField;
use Formz\Contracts\IForm;
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

class FluentField
{
    protected IField $field;
    protected FluentSection $context;

    public function section(?string $label = null): FluentSection
    {
        return $this->context->section($label);
    }

    public function rules($rules): self
    {
        $rules = is_array($rules) ? $rules : func_get_args();

        $this->field->rules($rules);

        return $this;
    }

    public function w1in2()
    {
        $this->field->w1p2();

        return $this;
    }

    public function placeholder($value)
    {
        $this->field->setAttributes(['placeholder' => $value]);

        return $this;
    }

    public function required()
    {
        $this->field->required();

        return $this;
    }

    public function text(string $name, string $label = null, $value = null): FluentTextField
    {
        return $this->context->text($name, $label, $value);
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
        return $this->context->password($name, $value, $label);
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
        return $this->context->textarea($name, $value, $label);

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
        return $this->context->hidden($name, $value, $label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return FluentNumberField
     */
    public function number(string $name, string $label = null, $value = null): FluentNumberField
    {
        return $this->context->number($name, $value, $label);
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
        return $this->context->select($name, $options, $value, $label);
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
        return $this->context->selectMultiple($name, $options, $value, $label);
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
        return $this->context->radio($name, $options, $value, $label);
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
        return $this->context->checkbox($name, $options, $value, $label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return FluentDateField
     */
    public function date(string $name, $label = null, $value = null): FluentDateField
    {
        return $this->context->date($name, $value, $label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return FluentFileField
     */
    public function file(string $name, $value = null, $label = null): FluentFileField
    {
        return $this->context->file($name, $value, $label);
    }

    public function setContext(FluentSection $context)
    {
        $this->context = $context;

        return $this;
    }

    public function getField(): IField
    {
        return $this->field;
    }

    public function get(): IForm
    {
        return $this->context->get();
    }
}
