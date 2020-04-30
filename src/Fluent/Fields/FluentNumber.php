<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Number;
use Formz\Fluent\FluentField;

class FluentNumber extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = new Number($name, $label, $value);

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
