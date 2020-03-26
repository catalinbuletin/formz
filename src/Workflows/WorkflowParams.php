<?php

namespace Formz\Workflows;

use JsonSerializable;
use Formz\Contracts\IForm;

class WorkflowParams implements JsonSerializable
{
    /**
     * @var IForm
     */
    private IForm $context;

    /**
     * @var string
     */
    private string $field;
    /**
     * @var string
     */
    private string $source;
    /**
     * @var string
     */
    private string $sourceType;
    /**
     * @var string
     */
    private string $sourceColumn;

    public function __construct(string $field, string $source, string $sourceType, string $sourceColumn)
    {
        $this->field = $field;
        $this->source = $source;
        $this->sourceType = $sourceType;
        $this->sourceColumn = $sourceColumn;
    }

    public function setContext(IForm $context)
    {
        $this->context = $context;
    }

    public function field()
    {
        return $this->context->getField($this->field)->toSelect();
    }

    public function source()
    {
        return $this->source;
    }

    public function sourceType()
    {
        return $this->sourceType;
    }

    public function sourceColumn()
    {
        return $this->sourceColumn;
    }
    
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toArray()
    {
        return [
            'field' => $this->field(),
            'source' => $this->source(),
            'sourceType' => $this->sourceType(),
            'sourceColumn' => $this->sourceColumn(),
        ];
    }
}