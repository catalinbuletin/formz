<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Password;
use Formz\Fluent\FluentField;

class FluentPassword extends FluentField
{
    public static function make(string $name, $value = null, string $label = null)
    {
        $instance = new static();

        $instance->field = new Password($name, $value, $label);

        return $instance;
    }
}
