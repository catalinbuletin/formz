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

    /**
     * @param array $attributes
     * @param string $glue Used only for string and numeric values
     * @return $this
     */
    public function mergeAttributes(array $attributes, string $glue = ' '): self
    {
        foreach ($attributes as $key => $value) {
            if ($this->attributes->has($key)) {
                switch (gettype($this->attributes->get($key))) {
                    case 'string':
                    case 'integer':
                    case 'double':
                        $this->attributes->set(
                            $key,
                            $this->attributes->get('key') . $glue . $value,
                        );
                        break;
                    default:
                        $this->attributes->append($key, $value);
                        break;
                }
            } else {
                $this->attributes->set($key, $value);
            }
        }

        return $this;
    }

    public function getAttributes(): Data
    {
        return $this->attributes;
    }
}
