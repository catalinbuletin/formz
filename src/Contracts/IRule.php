<?php

namespace Formz\Contracts;

interface IRule extends \JsonSerializable
{
    public function name(): string;
    public function label(): string;
    public function description(): string;
    public function params(): array;
    public function form(): ?IForm;
    public function __toString(): string;
    public function jsonSerialize(): array;
}
