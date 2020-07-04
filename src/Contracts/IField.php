<?php

namespace Formz\Contracts;

use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Support\Arrayable;

interface IField extends \JsonSerializable, Arrayable
{
    public function setValue($value): self;

    public function setAttributes(array $attributes): self;

    public function mergeAttributes(array $attributes, string $glue = ' '): self;

    public function getAttributes(): Data;

    /**
     * @param array|IRule[] $rules
     * @return self
     */
    public function rules(array $rules): self;

    public function setDisabled($value = true): self;

    public function setReadonly($value = true): self;

    public function setHidden($value = true): self;

    public function required(): self;

    /**
     * @param int|string $xs
     * @param int|string|null $sm
     * @param int|string|null $md
     * @param int|string|null $lg
     * @param int|string|null $xlg
     * @return self
     */
    public function setCols($xs, $sm = null, $md = null, $lg = null, $xlg = null): self;

    public function setTabindex(int $tabindex): self;

    public function setHelpText(string $helpText): self;

    public function setContext(ISection $section): self;

    public function getContext(): ISection;

    public function getFormContext(): IForm;

    public function getId(): string;

    public function getName(): string;

    public function getLabel(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return mixed
     */
    public function getRules();

    public function getCols(): array;

    public function getTabindex(): ?int;

    public function getHelpText(): string;

    /**
     * @return mixed
     */
    public function getType();

    public function isFile(): bool;

    public function toSelect(): array;

    public function resolve(): void;

    public function isRequired(): bool;

    public function errors(): array;

    public function errorMessage(): string;
}
