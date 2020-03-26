<?php

namespace Formz;

class WorkflowFactory
{
    public static function hide(string $field, array $conditions, IForm $form)
    {
        $field = $form->getField($field);

        return [
            'field' => [
                'id' => $field->getId(),
                'name' => $field->getName(),
            ],
            'conditions' => self::parseConditions($conditions, $form),
        ];
    }

    /**
     * @param array|Condition[] $conditions
     * @param IForm $form
     * @return array
     */
    private static function parseConditions(array $conditions, IForm $form)
    {
        $array = [];

        /** @var Condition $condition */
        foreach ($conditions as $condition) {
            $conditionField = $form->getField($condition->field());
            $array[] = [
                'field' => [
                    'id' => $conditionField->getId(),
                    'name' => $conditionField->getName(),
                ],
                'value' => $condition->value(),
                'operator' => $condition->operator(),
            ];
        }

        return $array;
    }
}
