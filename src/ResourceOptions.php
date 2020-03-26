<?php

namespace Formz;

class ResourceOptions
{
    protected string $name;
    protected string $label;
    protected array $availableConditionFields;
    protected array $where = [];
    protected array $orderBy = [];

    /**
     * ResourceOptions constructor.
     * @param $name
     * @param $label
     * @param $availableConditionFields
     */
    public function __construct($name, $label, $availableConditionFields = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->availableConditionFields = $availableConditionFields;

        return $this;
    }

    /**
     * @param $data
     * @return self
     */
    public static function makeFromArray($data)
    {
        $instance = new self(
            $data['name'],
            $data['label'],
            $data['availableConditionFields']
        );

        return $instance;
    }

    public function where($criteria = [])
    {
        $this->where = $criteria;

        return $this;
    }

    public function addWhere($criteria = [])
    {
        $this->where = array_merge($this->where, $criteria);

        return $this;
    }

    public function orderBy($column, $direction)
    {
        $this->orderBy = [
            $column => $direction
        ];

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    public function getQueryClassNamespace()
    {
        $folder = $this->getQueryFolderName();
        $class = $this->getQueryClassName();

        return "\\Sincron\\Application\\Shared\\Services\\Forms\\FormBuilder\\Queries\\{$folder}\\$class";
    }

    public function getQueryFolderName()
    {
        $name = ucfirst($this->name);

        return "Get{$name}Options";
    }

    public function getQueryClassName()
    {
        return $this->getQueryFolderName() . 'Query';
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'availableConditionFields' => $this->availableConditionFields,
            'where' => $this->where,
            'orderBy' => $this->orderBy
        ];
    }
}
