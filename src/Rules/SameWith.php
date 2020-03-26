<?php

namespace Formz\Rules;

use Formz\Contracts\IForm;
use Formz\Options;
use Formz\Rules\SameWith as ISameWith;
use Formz\Fields\Choice;
use Sincron\Infrastructure\Services\Form\Form;

class SameWith extends AbstractRule implements ISameWith
{
    protected string $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * Returns the name of the rule
     * @return string
     */
    public function label(): string
    {
        return 'Same value as';
    }

    /**
     * Returns the slug
     * @return string
     */
    public function name(): string
    {
        return 'same';
    }

    /**
     * Returns the description of the rupe
     * @return string
     */
    public function description(): string
    {
        return 'The field under validation must match the given field.';
    }

    /**
     * Returns an array of fields to be used when updating params on the rule
     * @return Form
     */
    public function form(): IForm
    {
        return Form::makeWithFields([
            new Choice('select', 'field', new Options(), $this->field),
        ]);
    }

    /**
     * This holds the default value for the fields.
     *
     * !!! It will be overwritten with the value stored in the database
     *
     * @return array
     */
    public function params(): array
    {
        return [
            'field' => $this->field
        ];
    }

    public function __toString(): string
    {
        return sprintf('%s:%s', $this->name(), $this->params()['field']);
    }
}
