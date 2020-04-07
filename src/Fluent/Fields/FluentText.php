<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Text;
use Formz\Fluent\FluentField;

class FluentText extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = new Text($name, $label, $value);

        return $instance;
    }
}
