<?php

namespace Formz\Fluent\Fields;

use Formz\Fluent\FluentField;
use Formz\Field;

class FluentDateField extends FluentField
{
    public static function make(string $name, string $label = null, $value = null)
    {
        $instance = new static();

        $instance->field = Field::date($name, $label, $value);

        return $instance;
    }

    public function min($value): self
    {
        $this->field->min($value);

        return $this;
    }

    public function max($value): self
    {
        $this->field->max($value);

        return $this;
    }

    public function enableTime(): self
    {
        $this->field->enableTime();

        return $this;
    }

    public function enableRange(): self
    {
        $this->field->enableRange();

        return $this;
    }

    public function multiDate(): self
    {
        $this->field->multiDate();

        return $this;
    }

    public function showWeekNumbers()
    {
        $this->field->showWeekNumbers();

        return $this;
    }
}
