<?php

namespace Formz\Rules;

use Formz\Contracts\IForm;
use Formz\Options;
use Formz\Fields\Choice;
use Sincron\Infrastructure\Services\Form\Form;

class RequiredWithAll extends AbstractRule
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
        return 'Required With All';
    }

    /**
     * Returns the slug
     * @return string
     */
    public function name(): string
    {
        return 'required_with_all';
    }

    /**
     * Returns the description of the rupe
     * @return string
     */
    public function description(): string
    {
        return 'The field under validation must be present and not empty only when ALL of the other specified fields are not empty.';
    }

    /**
     * Returns an array of fields to be used when updating params on the rule
     * @return Form
     */
    public function form(): IForm
    {
        $form = Form::makeWithFields([
            new Choice('multiselect', 'fields', new Options(), $this->fields),
        ]);

        return $form;
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
