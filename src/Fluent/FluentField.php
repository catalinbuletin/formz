<?php

namespace Formz\Fluent;

use Formz\Contracts\IField;
use Formz\Contracts\IForm;
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

    public function cols(int $xs, ?int $sm = null, ?int $md = null, ?int $lg = null)
    {
        $this->field->setCols($xs, $sm, $md, $lg);

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

    public function text(string $name, string $label = null, $value = null): FluentText
    {
        return $this->context->text($name, $label, $value);
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
        return $this->context->password($name, $value, $label);
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
        return $this->context->textarea($name, $value, $label);

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
        return $this->context->hidden($name, $value, $label);
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
        return $this->context->number($name, $value, $label);
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
        return $this->context->select($name, $options, $value, $label);
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
        return $this->context->selectMultiple($name, $options, $value, $label);
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
        return $this->context->radio($name, $options, $value, $label);
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
        return $this->context->checkbox($name, $options, $value, $label);
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
        return $this->context->date($name, $value, $label);
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
