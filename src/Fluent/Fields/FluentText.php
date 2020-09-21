<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Text;
use Formz\Fluent\FluentField;

class FluentText extends FluentField
{
    /**
     * @param string $name
     * @param string|null $label
     * @param string|null $value
     *
     * @return static
     */
    public static function make(string $name, string $label = null, string $value = null)
    {
        $instance = new static();

        $instance->field = new Text($name, $label, $value);

        return $instance;
    }
}
