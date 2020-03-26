<?php

namespace Formz\Fields;

class Hidden extends AbstractField
{
    public function __construct(string $name, $value, string $label = null)
    {
        parent::__construct('hidden', $name, $value, $label);

        return $this;
    }
}
