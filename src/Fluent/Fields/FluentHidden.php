<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Hidden;
use Formz\Fluent\FluentField;

class FluentHidden extends FluentField
{
    public static function make(string $name, $value = null, string $label = null)
    {
        $instance = new static();

        $instance->field = new Hidden($name, $value, $label);

        return $instance;
    }
}
