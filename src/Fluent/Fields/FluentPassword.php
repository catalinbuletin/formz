<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Password;
use Formz\Fluent\FluentField;

class FluentPassword extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = new Password($name, $label, $value);

        return $instance;
    }
}
