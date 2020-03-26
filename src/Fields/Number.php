<?php

namespace Formz\Fields;

use Webmozart\Assert\Assert;

class Number extends AbstractField
{
    const MIN = 0;
    const MAX = null;
    const STEP = 1;

    public function __construct(string $name, $value, string $label = null)
    {
        parent::__construct('number', $name, $value, $label);

        return $this;
    }

    public function min($length): self
    {
        Assert::integer($length);

        $this->attributes->set('min', $length);

        return $this;
    }

    public function max($length): self
    {
        Assert::integer($length);

        $this->attributes->set('max', $length);

        return $this;
    }

    public function step($step): self
    {
        Assert::integer($step);

        $this->attributes->set('step', $step);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes()
    {
        $attributes = [
            'min' => self::MIN,
            'max' => self::MAX,
            'step' => self::STEP,
        ];

        return array_merge(parent::defaultAttributes(), $attributes);
    }
}