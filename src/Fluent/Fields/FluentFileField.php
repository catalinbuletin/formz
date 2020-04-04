<?php

namespace Formz\Fluent\Fields;

use Formz\Fluent\FluentField;
use Formz\Field;

class FluentFileField extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = Field::file($name, $label, $value);

        return $instance;
    }

    public function theme(string $value): self
    {
        $this->field->theme($value);

        return $this;
    }

    public function maxFiles(?int $value = null): self
    {
        $this->field->maxFiles($value);

        return $this;
    }

    public function helpText(string $value): self
    {
        $this->field->helpText($value);

        return $this;
    }
}
