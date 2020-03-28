<?php

namespace Formz\Contracts;

use Illuminate\Support\Collection;

interface ISection extends \JsonSerializable
{
    /**
     * @param array $only
     * @return Collection|IField[]
     */
    public function getFields($only = []);

    /**
     * @param IField $field
     * @return $this
     */
    public function addField(IField $field);

    /**
     * @param string|IField $field
     */
    public function removeField($field);

    /**
     * @param \Traversable|IField[] $field
     */
    public function removeFields(\Traversable $field);

    /**
     * @param null $name
     *
     * @return $this
     */
    public function setName($name = null);
}
