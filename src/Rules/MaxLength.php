<?php

namespace Formz\Rules;

use Formz\Contracts\IForm;
use Sincron\Infrastructure\Services\Form\Form;
use Formz\Fields\Number;

class MaxLength extends AbstractRule
{
    protected $length;

    public function __construct($length = null)
    {
        $this->length = $length;
    }

    public function name(): string
    {
        return 'max';
    }

    public function label(): string
    {
        return 'Max Length';
    }

    public function description(): string
    {
        return 'Maximum length of the field under validation';
    }

    public function params(): array
    {
        return [
            'value' => $this->length
        ];
    }

    public function form(): ?IForm
    {
        return Form::makeWithFields([
            (new Number('value', $this->length, 'Value'))->min(2)->w1p3()
        ]);
    }

    public function __toString(): string
    {
        return sprintf('%s:%d', $this->name(), intval($this->length));
    }
}
