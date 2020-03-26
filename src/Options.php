<?php

namespace Formz;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Options implements \JsonSerializable
{
    /**
     * @var ResourceOptions|null
     */
    protected $resource;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array|null
     */
    protected $where;

    /**
     * @var array|null
     */
    protected $orderBy;

    public static function dictionary($dictionary): Options
    {
        $instance = new static();

        if (!$dictionary instanceof DictionaryOptions) {
            $dictionary = new DictionaryOptions($dictionary);
        }
        
        $instance->dictionary = $dictionary;

        return $instance;
    }

    public static function resource(ResourceOptions $resource): Options
    {
        $instance = new static();

        $instance->resource = $resource;

        return $instance;
    }

    public static function fromKeyValueArray(array $values): Options
    {
        $instance = new static();

        $options = [];

        foreach ($values as $key => $value) {
            if (is_array($value) && isset($value['label']) && isset($value['value'])) {
                $options[] = $value;

                continue;
            }

            $options[] = [
                'value' => $key,
                'label' => $value
            ];
        }

        $instance->options = $options;

        return $instance;
    }

    public static function fromSimpleArray(array $values): Options
    {
        $instance = new static();

        $options = [];

        foreach ($values as $value) {
            $options[] = [
                'value' => Str::camel($value),
                'label' => ucfirst($value)
            ];
        }

        $instance->options = $options;

        return $instance;
    }

    public static function fromDatabase($value)
    {
        $instance = new static();

        $instance->options = $value;

        return $instance;
    }

    public static function yesNo()
    {
        $instance = new static();

        $instance->options = [
            [
                'label' => trans('global.yes'),
                'value' => 1,
            ], [
                'label' => trans('global.no'),
                'value' => 0,
            ],
        ];

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'options' => $this->options,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getOptions()
    {
        if ($this->resource) {
            return $this->optionsFromResource()->toArray();
        }

        return $this->options;
    }


    public function getResource()
    {
        return $this->resource;
    }

    public function hasResource()
    {
        return (bool) $this->resource;
    }

    public function __call($name, $arguments)
    {
        if (Str::contains($name, 'where')) {
            $name = Str::replaceFirst('where', '', $name);
            $name = Str::lower($name);
            $this->where[$name] = array_shift($arguments);
        }

        return $this;
    }


    private function optionsFromResource(): Collection
    {
        $queryBus = app()->make(QueryBus::class);

        $queryClass = $this->resource->getQueryClassNamespace();
        $query = new $queryClass($this->resource->getWhere(), $this->resource->getOrderBy());

        return $queryBus->execute($query);
    }
}