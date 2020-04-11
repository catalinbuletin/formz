<?php

namespace Formz\Fluent\Fields;

use Formz\Fields\Date;
use Formz\Fluent\FluentField;

class FluentDate extends FluentField
{
    public static function make(string $name, $value = null, string $label = null)
    {
        $instance = new static();

        $instance->field = new Date($name, $value, $label);

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
