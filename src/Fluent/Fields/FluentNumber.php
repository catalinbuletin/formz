<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Number;
use Formz\Fluent\FluentField;

class FluentNumber extends FluentField
{
    public static function make(string $name, $value = null, string $label = null)
    {
        $instance = new static();

        $instance->field = new Number($name, $value, $label);

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
