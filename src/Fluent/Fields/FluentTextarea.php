<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Textarea;
use Formz\Fluent\FluentField;
use Formz\Field;

class FluentTextarea extends FluentField
{
    public static function make(string $name, $value = null, string $label = null)
    {
        $instance = new static();

        $instance->field = new Textarea($name, $value, $label);

        return $instance;
    }
}
