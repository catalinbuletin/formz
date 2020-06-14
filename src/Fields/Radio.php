<?php

namespace Formz\Fields;

use Formz\Options;
use Webmozart\Assert\Assert;

class Radio extends Choice
{
    public const INLINE_OPTIONS = false;

    /**
     * Radio constructor.
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param null $value
     */
    public function __construct(string $name, $options, string $label = null, $value = null)
    {
        parent::__construct('radio', $name, $options, $label, $value);
    }

    /**
     * @param bool $value
     *
     * @return Radio
     */
    public function inlineOptions($value = true): Radio
    {
        Assert::boolean($value);

        $this->setAttributes(['inlineOptions' => $value]);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes(): array
    {
        $defaultAttributes = [
            'inlineOptions' => self::INLINE_OPTIONS,
        ];

        return array_merge_recursive(parent::defaultAttributes(), $defaultAttributes);
    }
}
