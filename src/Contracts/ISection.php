<?php

namespace Formz\Contracts;

use Illuminate\Support\Collection;

interface ISection extends \JsonSerializable
{

    public function addField(IField $field): self;

    /**
     * @param string|IField $field
     */
    public function removeField($field);

    /**
     * @param array |IField[] $field
     */
    public function removeFields(array $field);

    /**
     * @param null $name
     *
     * @return $this
     */
    public function setLabel($name = null): self;

    public function setContext(IForm $context): self;

    public function getContext(): IForm;

    /**
     * @param array $only
     * @return Collection|IField[]
     */
    public function getFields($only = []);


    public function setHelpText(string $helpText): self;

    public function getHelpText(): string;
}
