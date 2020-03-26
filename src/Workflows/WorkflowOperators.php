<?php

namespace Formz\Workflows;

class WorkflowOperators
{
    private const OPERATORS = [
        '=' => 'Equals',
        '>' => 'Greater than',
        '>=' => 'Greater or Equal with',
        '<' => 'Less than',
        '<=' => 'Less or Equal with',
        '*' => 'Has any value',
        'null' => 'Has no value',
        'contains' => 'Contains',
    ];

    public static function getOperators(): array
    {
        $operators = [];

        foreach (static::OPERATORS as $operator => $label) {
            $operators[] = [
                'value' => $operator,
                'label' => $label,
            ];
        }

        return $operators;
    }

    public static function getOperatorLabel(string $operator): string
    {
        return static::OPERATORS[$operator] ?? '';
    }
}