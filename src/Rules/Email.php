<?php

namespace Formz\Rules;

use Formz\Contracts\IForm;

class Email extends AbstractRule
{
    public function name(): string
    {
        return 'email';
    }

    public function label(): string
    {
        return 'Valid E-mail address';
    }

    public function description(): string
    {
        return 'The field under validation must be a valid e-mail address';
    }

    public function form(): ?IForm
    {
        return null;
    }

    public function params(): array
    {
        return [];
    }

    public function __toString(): string
    {
        return 'email';
    }
}
