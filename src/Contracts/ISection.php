<?php

namespace Formz\Contracts;

use Illuminate\Support\Collection;

interface ISection extends \JsonSerializable
{
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
     * @param array |IField[] $field
     */
    public function removeFields(array $field);

    /**
     * @param null $name
     *
     * @return $this
     */
    public function setLabel($name = null);

    /**
     * @param IForm $context
     *
     * @return $this
     */
    public function setContext(IForm $context);

    /**
     * @return IForm
     */
    public function getContext(): IForm;

    /**
     * @param array $only
     * @return Collection|IField[]
     */
    public function getFields($only = []);

}
