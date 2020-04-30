<?php

namespace Formz\Fields;

use Webmozart\Assert\Assert;

class Password extends AbstractField
{
    const MIN = 0;
    const MAX = null;

    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('password', $name, $label, $value);
    }

    public function min($length): Password
    {
        Assert::integer($length);

        $this->attributes->set('min', $length);

        return $this;
    }

    public function max($length): Password
    {
        Assert::integer($length);

        $this->attributes->set('max', $length);

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
        ];

        return array_merge(parent::defaultAttributes(), $attributes);
    }
}
