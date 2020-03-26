<?php

namespace Formz\Workflows;

class HideWorkflow extends WorkflowBase
{
    public function __construct(string $field, $conditions)
    {
        parent::__construct($field, $conditions);
    }

    public function action(): string
    {
        return 'hide';
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
        return $this->conditions;
    }

    public function params()
    {
        return [];
    }
}
