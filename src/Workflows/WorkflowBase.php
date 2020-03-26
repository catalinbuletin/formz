<?php

namespace Formz\Workflows;

use Formz\Contracts\IForm;
use Formz\Contracts\IWorkflow;

abstract class WorkflowBase implements IWorkflow
{
    protected string $field;

    /**
     * @var WorkflowCondition[]
     */
    protected array $conditions;

    /**
     * @var WorkflowParams[]
     */
    protected ?array $param;

    protected IForm $context;

    public function __construct(string $field, $conditions, ?WorkflowParams $param = null)
    {
        $this->field = $field;
        $this->conditions = is_array($conditions) ? $conditions : [$conditions];
        $this->param = $param;
    }

    public function setContext(IForm $context)
    {
        $this->context = $context;

        $this->setAttributesContext();
    }

    public function toArray()
    {
        return [
            'action' => $this->action(),
            'field' => $this->field(),
            'conditions' => $this->conditions(),
            'params' => $this->params(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __toString(): string
    {
        return '';
    }

    private function setAttributesContext()
    {
        /** @var WorkflowCondition $condition */
        foreach ($this->conditions as $condition) {
            $condition->setContext($this->context);
        }

        /** @var WorkflowParams $param */
        if ($this->param instanceof WorkflowParams) {
            $this->param->setContext($this->context);
        }
    }
}
