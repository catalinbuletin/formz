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
     * @param $rules
     *
     * @return $this
     */
    public function rules($rules): self
    {
        $rules = is_array($rules) ? $rules : func_get_args();

        $this->field->rules($rules);

        return $this;
    }

    /**
     * @param int $xs
     * @param int|null $sm
     * @param int|null $md
     * @param int|null $lg
     * @param int|null $xlg
     *
     * @return $this
     */
    public function cols(int $xs, ?int $sm = null, ?int $md = null, ?int $lg = null, ?int $xlg = null): self
    {
        $this->field->setCols($xs, $sm, $md, $lg, $xlg);

        return $this;
    }

    /**
     * @return $this
     */
    public function required(): self
    {
        $this->field->required();

        return $this;
    }

    /**
     * @param int $tabindex
     *
     * @return $this
     */
    public function tabindex(int $tabindex): self
    {
        $this->field->setTabindex($tabindex);

        return $this;
    }

    /**
     * @param string $helpText
     *
     * @return $this
     */
    public function helpText(string $helpText): self
    {
        $this->field->setHelpText($helpText);

        return $this;
    }

    public function attr(array $attributes): self
    {
        $this->field->setAttributes($attributes);

        return $this;
    }

    public function mergeAttr(array $attributes, string $glue): self
    {
        $this->field->addAttributes($attributes, $glue);

        return $this;
    }

    public function id(string $id): self
    {
        $this->field->setAttributes(['input.id' => $id]);

        return $this;
    }

    public function class(string $class): self
    {
        $this->field->setAttributes(['input.class' => $class]);

        return $this;
    }

    public function addClass(string $class): self
    {
        $this->field->addAttributes(['input.class' => $class]);

        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->field->setAttributes(['input.placeholder' => $placeholder]);

        return $this;
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param null $value
     *
     * @return FluentText
     */
    public function text(string $name, string $label = null, $value = null): FluentText
    {
        return $this->context->text($name, $label, $value);
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
        return $this->context->password($name, $label, $value);
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
        return $this->context->textarea($name, $label, $value);

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
        return $this->context->hidden($name, $label, $value);
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
        return $this->context->number($name, $label, $value);
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
        return $this->context->select($name, $options, $label, $value);
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
        return $this->context->selectMultiple($name, $options, $label, $value);
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
        return $this->context->radio($name, $options, $label, $value);
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
        return $this->context->checkbox($name, $options, $label, $value);
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
        return $this->context->date($name, $label, $value);
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return FluentFile
     */
    public function file(string $name, $label = null, $value = null): FluentFile
    {
        return $this->context->file($name, $label, $value);
    }

    /**
     * @param FluentSection $context
     *
     * @return $this
     */
    public function setContext(FluentSection $context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return IField
     */
    public function getField(): IField
    {
        return $this->field;
    }

    public function fill($data)
    {
        $this->context->fill($data);
    }

    /**
     * @return IForm
     */
    public function get(): IForm
    {
        return $this->context->get();
    }
}
