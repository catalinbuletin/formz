<?php

namespace Formz\Contracts;

use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

interface ISection extends \JsonSerializable, Arrayable
{

    public function addField(IField $field): self;

    /**
     * @param string|IField $field
     */
    public function removeField($field);

    /**
     * @param array|IField[] $field
     */
    public function removeFields(array $field);

    public function setLabel(?string $name = null): self;

    public function getLabel(): string;

    /**
     * @param IField[] $fields
     * @return ISection
     */
    public function addFields(array $fields): self;

    public function setContext(IForm $context): self;

    public function setAttributes(array $attributes): self;

    public function addAttributes(array $attributes, string $glue = ' '): self;

    public function getContext(): IForm;

    /**
     * @param array $only
     * @return Collection|IField[]
     */
    public function getFields(array $only = []);


    public function setHelpText(string $helpText): self;

    public function getHelpText(): string;

    public function getAttributes(): Data;

    public function resolve(): void;

    public function hasErrors(): bool;

    public function getFieldsErrors(): array;
}
