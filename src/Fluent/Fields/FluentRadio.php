<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Radio;
use Formz\Fluent\FluentField;
use Formz\Options;

class FluentRadio extends FluentField
{
    public static function make(string $name, Options $options, $value = null, string $label = null)
    {
        $instance = new static();

        $instance->field = new Radio($name, $options, $value, $label);

        return $instance;
    }

    public function optionsInline($inline = true)
    {
        $this->field->inlineOptions($inline);

        return $this;
    }

}
