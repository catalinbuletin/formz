<?php


namespace Formz;

use Dflydev\DotAccessData\Data;

trait AttributesTrait
{
    protected Data $attributes;

    /**
     * Set Form attributes
     *
     * @param array $attributes
     * @return static
     */
    public function setAttributes(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->attributes->set($key, $value);
        }

        return $this;
    }

    public function getAttributes(): Data
    {
        return $this->attributes;
    }
}
