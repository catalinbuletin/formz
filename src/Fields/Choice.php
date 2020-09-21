<?php

namespace Formz\Fields;

use Formz\Options;
use Formz\ResourceOptions;

class Choice extends AbstractField
{
    /**
     * Possible options for select
     *
     * @var Options
     */
    private Options $options;

    /**
     * @optionSource 'manual', 'resource', 'collection'
     */
    /*private string $optionSource = 'manual';

    private ?ResourceOptions $resource = null;*/

    /**
     * Field constructor.
     * @param string $type
     * @param string $name
     * @param iterable|\Closure $options
     * @param string $label
     * @param mixed $value
     */
    public function __construct(string $type, string $name, $options, string $label = null, $value = null)
    {
        parent::__construct($type, $name, $label, $value);

        $this->setOptions(new Options($options));
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'options' => $this->options->resolve(),
            //'optionSource' => $this->optionSource,
            //'resource' => $this->resource ? $this->resource->toArray() : null,
        ]);
    }

    /**
     * @param Options $options
     * @return void
     */
    private function setOptions(Options $options): void
    {
        $this->options = $options;
    }

    /**
     * @return Options
     */
    public function getOptions(): Options
    {
        return $this->options->resolve();
    }
}
