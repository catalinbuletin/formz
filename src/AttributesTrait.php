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

    public function mergeAttributes(array $attributes, string $glue = ' '): self
    {
        foreach ($attributes as $key => $value) {
            $this->attributes->set(
                $key,
                $this->attributes->get('key') ? $this->attributes->get('key') . $glue . $value : $value,
            );
        }

        return $this;
    }

    public function getAttributes(): Data
    {
        return $this->attributes;
    }
}
