<?php

namespace Formz\Fields;

use Webmozart\Assert\Assert;

class Textarea extends AbstractField
{
    public const ROWS = 3;

    public function __construct(string $name, string $label = null, $value = null)
    {
        parent::__construct('textarea', $name, $label, $value);
    }

    public function rows($value): Textarea
    {
        Assert::integer($value);

        $this->setAttributes(['rows' => $value]);

        return $this;
    }

    /**
     * @return array
     */
    protected function defaultAttributes(): array
    {
        $defaultAttributes = [
            'rows' => self::ROWS,
        ];

        return array_merge_recursive(parent::defaultAttributes(), $defaultAttributes);
    }
}
