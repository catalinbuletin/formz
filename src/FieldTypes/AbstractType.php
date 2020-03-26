<?php

namespace Formz\FieldTypes;

abstract class AbstractType implements \JsonSerializable
{
    protected bool $hasOptions = false;

    abstract public function type();
    abstract public function label();
    abstract public function icon();
    abstract public function attributes();

    public function jsonSerialize()
    {
        return [
            'type' => $this->type(),
            'label' => $this->label(),
            'icon' => $this->icon(),
            'hasOptions' => $this->hasOptions,
            'attributes' => $this->attributes()
        ];
    }
}
