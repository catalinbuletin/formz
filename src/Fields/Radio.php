<?php

namespace Formz\Fields;

use Formz\Options;
use Webmozart\Assert\Assert;

class Radio extends Choice
{
    const INLINE_OPTIONS = false;

    public function __construct(string $name, Options $options, $value, string $label = null)
    {
        parent::__construct('radio', $name, $options, $value, $label);
    }

    /**
     * @param bool $value
     *
     * @return Radio
     */
    public function inlineOptions($value = true): Radio
    {
        Assert::boolean($value);

        $this->attributes->set('inlineOptions', $value);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes()
    {
        $attributes = [
            'inlineOptions' => self::INLINE_OPTIONS,
        ];

        return array_merge(parent::defaultAttributes(), $attributes);
    }
}
