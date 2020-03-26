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
     * @param string $fieldName
     */
    public function removeField(string $fieldName);

    /**
     * @param null $name
     *
     * @return $this
     */
    public function setName($name = null);
}
