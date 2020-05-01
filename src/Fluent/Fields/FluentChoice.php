<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Choice;
use Formz\Fluent\FluentField;
use Formz\Options;

class FluentChoice extends FluentField
{
    /**
     * @param string $type
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param null $value
     * @return static
     */
    public static function make(string $type, string $name, $options, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = new Choice($type, $name, $options, $label, $value);

        return $instance;
    }
}
