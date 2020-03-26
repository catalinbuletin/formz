<?php

namespace Formz\Rules;

use Formz\Contracts\IRule;

abstract class AbstractRule implements IRule
{
    public function jsonSerialize(): array
    {
        return [
            'label' => $this->label(),
            'name' => $this->name(),
            'description' => $this->description(),
            'params' => $this->params(),
            'form' => $this->form(),
        ];
    }
}
