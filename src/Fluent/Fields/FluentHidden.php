<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Hidden;
use Formz\Fluent\FluentField;

class FluentHidden extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = new Hidden($name, $label, $value);

        return $instance;
    }
}
