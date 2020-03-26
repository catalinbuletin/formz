<?php

namespace Formz\Rules;

use Formz\Contracts\IForm;

class Required extends AbstractRule
{
    public function name(): string
    {
        return 'required';
    }

    public function label(): string
    {
        return 'Required';
    }

    public function description(): string
    {
        return 'The field under validation cannot be empty';
    }

    public function params(): array
    {
        return [];
    }

    public function form(): ?IForm
    {
        return null;
    }

    public function __toString(): string
    {
        return 'required';
    }
}
