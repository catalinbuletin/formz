<?php

namespace Formz\Rules;

use Formz\Contracts\IForm;
use Formz\Fields\Number;
use Sincron\Infrastructure\Services\Form\Form;

class MinLength extends AbstractRule
{
    protected $length;

    public function __construct($length = null)
    {
        $this->length = $length;
    }

    public function name(): string
    {
        return 'min';
    }

    public function label(): string
    {
        return 'Min Length';
    }

    public function description(): string
    {
        return 'Minimum length of the field under validation';
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
            (new Number('value', $this->length, 'Value'))->min(1)->w1p3()
        ]);
    }

    public function __toString(): string
    {
        return sprintf('%s:%d', $this->name(), intval($this->length));
    }
}
