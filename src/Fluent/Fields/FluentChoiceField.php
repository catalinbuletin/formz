<?php

namespace Formz\Fluent\Fields;

use Formz\Fluent\FluentField;
use Formz\Field;
use Formz\Options;

class FluentChoiceField extends FluentField
{
    public static function make(string $type, string $name, Options $options, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = $type === 'select'
            ? Field::select($name, $options, $label, $value)
            : Field::selectMultiple($name, $options, $label, $value);

        return $instance;
    }
}
