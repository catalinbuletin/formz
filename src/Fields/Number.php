<?php

namespace Formz\Fields;

use Webmozart\Assert\Assert;

class Number extends AbstractField
{
    public const MIN = 0;
    public const MAX = null;
    public const STEP = 1;

    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('number', $name, $label, $value);
    }

    public function min($length): self
    {
        Assert::integer($length);

        $this->setAttributes(['min' => $length]);

        return $this;
    }

    public function max($length): self
    {
        Assert::integer($length);

        $this->setAttributes(['max' => $length]);

        return $this;
    }

    public function step($step): self
    {
        Assert::integer($step);

        $this->setAttributes(['step' => $step]);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes(): array
    {
        $defaultAttributes = [
            'min' => self::MIN,
            'max' => self::MAX,
            'step' => self::STEP,
        ];

        return array_merge_recursive(parent::defaultAttributes(), $defaultAttributes);
    }
}
