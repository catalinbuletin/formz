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
    public function setAttributes(array $attributes): self;

    /**
     * Merge Field attributes
     *
     * @param array $attributes
     * @param string $glue
     * @return static
     */
    public function mergeAttributes(array $attributes, string $glue = ' '): self;

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

    // @todo - cleanup
    /**
     * @param array $workflows
     * @return IField
     */
    //public function workflows(array $workflows): IField;

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
     * @param int|string $xs
     * @param int|string|null $sm
     * @param int|string|null $md
     * @param int|string|null $lg
     * @param int|string|null $xlg
     *
     * @return IField
     */
    public function setCols($xs, $sm = null, $md = null, $lg = null, $xlg = null): IField;

    /**
     * @param int $tabindex
     *
     * @return IField
     */
    public function setTabindex(int $tabindex): IField;

    /**
     * @param string $helpText
     *
     * @return IField
     */
    public function setHelpText(string $helpText): IField;

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
     * @return int|null
     */
    public function getTabindex();

    /**
     * @return string
     */
    public function getHelpText(): string;

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

    public function resolve(): void;
}
