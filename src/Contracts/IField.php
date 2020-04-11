<?php

namespace Formz\Contracts;

use Dflydev\DotAccessData\Data;

interface IField extends \JsonSerializable
{
    /**
     * Sets the value of the field
     *
     * @param $value
     * @return IField
     */
    public function setValue($value);

    /**
     * Set Field attributes
     *
     * @param array $attributes
     * @return static
     */
    public function setAttributes(array $attributes): IField;

    /**
     * Set Field attributes
     *
     * @return Data
     */
    public function getAttributes(): Data;

    /**
     * @param array|IRule[] $rules
     * @return IField
     */
    public function rules(array $rules): IField;

    /**
     * @param array $workflows
     * @return IField
     */
    public function workflows(array $workflows): IField;

    /**
     * Sets the field as disabled
     *
     * @param bool $value
     * @return IField
     */
    public function setDisabled($value = true);

    /**
     * Sets the field as readonly
     *
     * @param bool $value
     * @return IField
     */
    public function setReadonly($value = true): IField;

    /**
     * Sets the field as hidden
     *
     * @param bool $value
     * @return IField
     */
    public function setHidden($value = true): IField;

    /**
     * @return IField
     */
    public function required(): IField;

    /**
     * @param int $xs
     * @param int|null $sm
     * @param int|null $md
     * @param int|null $lg
     *
     * @return IField
     */
    public function setCols(int $xs, ?int $sm = null, ?int $md = null, ?int $lg = null): IField;

    /**
     * @param ISection $section
     *
     * @return IField
     */
    public function setContext(ISection $section): IField;

    /**
     * @return ISection
     */
    public function getContext(): ISection;

    /**
     * @return IForm
     */
    public function getFormContext(): IForm;

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getLabel(): string;
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return mixed
     */
    public function getRules();

    /**
     * @return array
     */
    public function getCols();

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @return bool
     */
    public function isFile(): bool;

    /**
     * @return array
     */
    public function toSelect(): array;

    /**
     * @return array
     */
    public function toArray(): array;
}
