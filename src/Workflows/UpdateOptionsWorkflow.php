<?php

namespace Formz\Workflows;

class UpdateOptionsWorkflow extends WorkflowBase
{
    protected string $field;
    protected ?array $param;

    public function __construct($field, $param)
    {
        parent::__construct($field, [], $param);
    }

    public function action(): string
    {
        return 'updateOptions';
    }

    public function field(): array
    {
        return $this->context->getField($this->field)->toSelect();
    }

    public function getFieldName(): string
    {
        return $this->field;
    }

    public function conditions(): array
    {
        return [];
    }

    public function params()
    {
        return $this->param;
    }
}