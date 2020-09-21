<?php


namespace Formz;

use Dflydev\DotAccessData\Data;

trait HasAttributes
{
    protected Attributes $attributes;

    public function setAttributes(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->attributes->set($key, $value);
        }

        return $this;
    }

    public function addAttributes(array $attributes, string $glue = ' '): self
    {
        foreach ($attributes as $key => $value) {
            if ($this->attributes->has($key)) {
                switch (gettype($this->attributes->get($key))) {
                    case 'string':
                    case 'integer':
                    case 'double':
                        $this->attributes->set(
                            $key,
                            $this->attributes->get($key) . $glue . $value,
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

    protected function setDefaultAttributes()
    {
        if (!isset($this->attributes)) {
            $this->attributes = new Attributes($this->defaultAttributes());
        }
    }

    public function getAttributes(): Data
    {
        return $this->attributes;
    }
}
