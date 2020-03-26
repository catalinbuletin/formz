<?php

namespace Formz\Rules;

use Formz\Contracts\IForm;
use Formz\Options;
use Formz\Fields\Choice;

class RequiredWith extends AbstractRule
{
    protected array $fields;

    public function __construct(array $fields = [])
    {
        $this->fields = $fields;
    }

    /**
     * Returns the name of the rule
     * @return string
     */
    public function label(): string
    {
        return 'Required With Any';
    }

    /**
     * Returns the slug
     * @return string
     */
    public function name(): string
    {
        return 'required_with';
    }

    /**
     * Returns the description of the rupe
     * @return string
     */
    public function description(): string
    {
        return 'The field under validation must be present and not empty only if any of the other specified fields are not empty.';
    }

    /**
     * Returns an array of fields to be used when updating params on the rule
     * @return IForm
     */
    public function form(): IForm
    {
        return Form::makeWithFields([
            new Choice('multiselect', 'fields', new Options(), $this->fields),
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
            'fields' => $this->fields
        ];
    }

    public function __toString(): string
    {
        return sprintf('%s:%s', $this->name(), implode(',', $this->params()['fields']));
    }
}
