<?php

namespace Formz\Fluent\Fields;

use Formz\Fluent\FluentField;
use Formz\Field;

class FluentTextareaField extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = Field::textarea($name, $label, $value);

        return $instance;
    }
}
