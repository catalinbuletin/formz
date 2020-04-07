<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Textarea;
use Formz\Fluent\FluentField;
use Formz\Field;

class FluentTextarea extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = new Textarea($name, $label, $value);

        return $instance;
    }
}
