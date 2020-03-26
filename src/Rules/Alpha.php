<?php

namespace Formz\Rules;

use Formz\Contracts\IForm;

class Alpha extends AbstractRule
{
    /**
     * Returns the name of the rule
     * @return string
     */
    public function label(): string
    {
        return 'Alpha';
    }

    /**
     * Returns the slug
     * @return string
     */
    public function name(): string
    {
        return 'alpha';
    }

    /**
     * Returns the description of the rupe
     * @return string
     */
    public function description(): string
    {
        return 'The field under validation must be entirely alphabetic characters.';
    }

    /**
     * Returns an array of fields to be used when updating params on the rule
     * @return IForm
     */
    public function form(): ?IForm
    {
        return null;
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
        return [];
    }

    public function __toString(): string
    {
        return $this->name();
    }
}
