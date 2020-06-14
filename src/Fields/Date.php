<?php

namespace Formz\Fields;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class Date extends AbstractField
{
    private string $mode = 'single';
    private bool $hasTime = false;
    private bool $displaySeconds = false;
    private bool $hasWeekNumbers = false;

    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('date', $name, $label, $value);
    }

    public static function makeFromArray(array $fieldData)
    {
        $field = new static(
            $fieldData['name'],
            $fieldData['label'] ?? null,
            $fieldData['value'] ?? null
        );

        $field->setId($fieldData['id']);
        $field->setAttributes($fieldData['attributes']);
        $field->setDateConfig($fieldData['dateConfig']);
        $field->rules($fieldData['rules']);
        $field->workflows($fieldData['workflows']);

        return $field;
    }

    private function setDateConfig($config)
    {
        $this->mode = Arr::get($config, 'mode');
        $this->hasTime = Arr::get($config, 'enableTime', false);
        $this->displaySeconds = Arr::get($config, 'enableSeconds', false);
        $this->hasWeekNumbers = Arr::get($config, 'enableWeekNumbers', false);
    }

    public function min($value): self
    {
        $this->setAttributes(['min' => $value]);

        return $this;
    }

    public function max($value): self
    {
        $this->setAttributes(['max' => $value]);

        return $this;
    }

    private function minDate()
    {
        $value = $this->attributes->get('min');

        if (!$value) {
            return null;
        }

        $date = Carbon::parse($value);

        return $date->format('Y-m-d H:i');
    }

    private function maxDate()
    {
        $value = $this->attributes->get('max');

        if (!$value) {
            return null;
        }

        $date = Carbon::parse($value);

        return $date->format('Y-m-d H:i');
    }

    public function enableTime(): self
    {
        $this->hasTime = true;

        return $this;
    }

    public function enableRange(): self
    {
        $this->mode = 'range';

        return $this;
    }

    public function multiDate(): self
    {
        $this->mode = 'multiple';

        return $this;
    }

    public function showWeekNumbers()
    {
        $this->hasWeekNumbers = true;
    }

    /**
     * @return array
     */
    protected function defaultAttributes(): array
    {
        $defaultAttributes = [
            'min' => null,
            'max' => null,
        ];

        return array_merge_recursive(parent::defaultAttributes(), $defaultAttributes);

    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'dateConfig' => [
                'enableTime' => $this->hasTime,
                'enableSeconds' => $this->displaySeconds,
                'enableWeekNumbers' => $this->hasWeekNumbers,
                'mode' => $this->mode,
                'minDate' => $this->minDate(),
                'maxDate' => $this->maxDate(),
            ]
        ]);
    }
}
