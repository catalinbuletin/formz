<?php

namespace Formz\Fields;

use Webmozart\Assert\Assert;

class Textarea extends AbstractField
{
    const ROWS = 3;

    public function __construct(string $name, $value, string $label = null)
    {
        parent::__construct('textarea', $name, $value, $label);
    }

    public function rows($value): Textarea
    {
        Assert::integer($value);

        $this->attributes->set('rows', $value);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes()
    {
        $attributes = [
            'rows' => self::ROWS
        ];

        return array_merge(parent::defaultAttributes(), $attributes);
    }
}
