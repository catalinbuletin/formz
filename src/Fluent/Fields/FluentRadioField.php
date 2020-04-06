<?php

namespace Formz\Fluent\Fields;

use Formz\Fluent\FluentField;
use Formz\Field;
use Formz\Options;

class FluentRadioField extends FluentField
{
    public static function make(string $name, Options $options, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = Field::radio($name, $options, $label, $value);

        return $instance;
    }

    public function optionsInline($inline = true)
    {
        $this->field->inlineOptions($inline);

        return $this;
    }

}
