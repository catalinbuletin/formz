<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Choice;
use Formz\Fluent\FluentField;
use Formz\Options;

class FluentChoice extends FluentField
{
    public static function make(string $type, string $name, Options $options, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = new Choice($type, $name, $options, $label, $value);

        return $instance;
    }
}
