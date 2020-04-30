<?php

namespace Formz\Fields;

class Hidden extends AbstractField
{
    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('hidden', $name, $label, $value);
    }
}
