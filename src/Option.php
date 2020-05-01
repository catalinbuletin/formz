<?php


namespace Formz;


class Option
{
    private string $value;

    private string $label;

    private bool $selected = false;

    /**
     * Option constructor.
     * @param string $value
     * @param string $label
     */
    private function __construct(string $value, string $label)
    {
        $this->value = $value;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return bool
     */
    public function isSelected(): bool
    {
        return $this->selected;
    }

    /**
     * @param bool $selected
     */
    public function setSelected(bool $selected): void
    {
        $this->selected = $selected;
    }


    /**
     * @param string|int $key
     * @param mixed $value
     * @return static
     */
    public static function makeFromKeyValue($key, $value): self
    {
        if (is_string($value)) {
            return new static((string)$key, $value);
        }

        if (is_object($value)) {
            if (isset($value->value)) {
                $key = $value->value;
            } elseif (isset($value->id)) {
                $key = $value->id;
            } elseif (method_exists($value, 'getValue')) {
                $key = $value->getValue();
            } elseif (method_exists($value, 'getId')) {
                $key = $value->getId();
            }

            if (isset($value->name)) {
                return new static((string)$key, (string)$value->name);
            }

            if (isset($value->label)) {
                return new static((string)$key, (string)$value->label);
            }

            if (method_exists($value, 'getName')) {
                return new static((string)$key, (string)$value->getName());
            }

            if (method_exists($value, 'getLabel')) {
                return new static((string)$key, (string)$value->getLabel());
            }
        }
    }

}
