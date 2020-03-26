<?php

namespace Formz\Contracts;

use JsonSerializable;

interface IWorkflow extends JsonSerializable
{
    public function setContext(IForm $form);
    public function action(): string;
    public function field(): array;
    public function getFieldName(): string;
    public function conditions(): array;
    public function params();
    public function __toString(): string;
    public function jsonSerialize(): array;
}
