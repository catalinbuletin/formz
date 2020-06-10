<?php

namespace Formz\Fields;

use Webmozart\Assert\Assert;

class Password extends AbstractField
{
    public const MIN = 0;
    public const MAX = null;

    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('password', $name, $label, $value);
    }

    public function min($length): Password
    {
        Assert::integer($length);

        $this->setAttributes(['min' => $length]);

        return $this;
    }

    public function max($length): Password
    {
        Assert::integer($length);

        $this->setAttributes(['max' => $length]);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes(): array
    {
        $attributes = [
            'min' => self::MIN,
            'max' => self::MAX,
        ];

        return array_merge(parent::defaultAttributes(), $attributes);
    }
}
