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
     * @return IField
     */
    public function wFull(): IField;

    /**
     * @return IField
     */
    public function w1p2(): IField;

    /**
     * @return IField
     */
    public function w1p3(): IField;

    /**
     * @return IField
     */
    public function w1p4(): IField;

    /**
     * @return IField
     */
    public function w1p6(): IField;

    /**
     * @return IField
     */
    public function w2p3(): IField;

    /**
     * @return IField
     */
    public function w3p4(): IField;

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
