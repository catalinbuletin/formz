<?php

namespace Formz\Workflows;

use JsonSerializable;
use Sincron\Application\Shared\DTO\Dictionary\DictionaryEntry;
use Formz\Contracts\IForm;
use Formz\Workflows\WorkflowOperators;
use Formz\Fields\AbstractField;

class WorkflowCondition implements JsonSerializable
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
    private string $operator;
    /**
     * @var string | int | object
     */
    private $value;

    public function __construct(string $field, string $operator, $value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function setContext(IForm $context)
    {
        $this->context = $context;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray()
    {
        return [
            'field' => $this->field(),
            'value' => $this->value(),
            'operator' => $this->operator(),
        ];
    }

    public function field()
    {
        return $this->context->getField($this->field)->toSelect();
    }

    public function value()
    {
        if ($this->value instanceof AbstractField) {
            return $this->value->getValue();
        }

        return $this->value;
    }

    public function operator()
    {
        return [
            'label' => WorkflowOperators::getOperatorLabel($this->operator),
            'value' => $this->operator,
        ];
    }

    public function __toString(): string
    {
        return $this->fieldText() . $this->operatorText() . $this->valueText();
    }

    public function fieldText(): string
    {
        return $this->field()->label;
    }

    public function operatorText(): string
    {
        return $this->operator()->label;
    }

    public function valueText(): string
    {
        if ($this->value instanceof AbstractField) {
            return $this->value->getLabel();
        }

        return $this->value;
    }
}