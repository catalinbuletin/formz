<?php

namespace Formz\Fluent\Fields;

use Formz\Fluent\FluentField;
use Formz\Field;

class FluentNumberField extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = Field::number($name, $label, $value);

        return $instance;
    }

    public function min(int $value)
    {
        $this->field->min($value);

        return $this;
    }

    public function max(int $value)
    {
        $this->field->max($value);

        return $this;
    }

    public function step(int $value)
    {
        $this->field->step($value);

        return $this;
    }
}
