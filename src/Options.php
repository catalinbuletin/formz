<?php

namespace Formz;

use Illuminate\Support\Str;

class Options implements \JsonSerializable, \Iterator, \Countable, \ArrayAccess
{
    /** @var null|iterable|\Closure */
    private $resolver = null;

    private array $options = [];

    private int $index = 0;

    /**
     * Options constructor.
     * @param iterable|\Closure $options
     */
    public function __construct($options)
    {
        $this->resolver = $options;
    }

    public function current()
    {
        return $this->options[$this->index];
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        return $this->index++;
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function valid()
    {
        return isset($this->options[$this->key()]);
    }

    public function count()
    {
        return count($this->options);
    }

    public function offsetExists($offset)
    {
        return isset($this->options[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->options[$offset]) ? $this->options[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->options[] = $value;
        } else {
            $this->options[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->options[$offset]);
    }


    /**
     * @return \Closure|iterable|null
     */
    public function getResolver()
    {
        return $this->resolver;
    }

    /**
     * @return Options
     */
    public function resolve(): Options
    {
        if ($this->resolver === null) {
            return $this;
        }

        if ($this->resolver instanceof \Closure) {
            $options = ($this->resolver)();
            if (! is_iterable($options)) {
                // @todo -> throw custom exception
                throw new \InvalidArgumentException('Closure must return an iterable');
            }
        } elseif ($this->resolver instanceof Options) {
            $options = $this->resolver->toArray();
        } else {
            $options = $this->resolver;
        }

        foreach ($options as $key => $value) {
            $option = Option::makeFromKeyValue((string)$key, $value);
            $this->options[$option->getValue()] = $option;
        }


        $this->resolver = null;

        return $this;
    }

    public function toArray(): array
    {
        return $this->options;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
