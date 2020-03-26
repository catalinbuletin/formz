<?php

namespace Formz\Fields;

use Dflydev\DotAccessData\Data;
use Formz\Rules\Required;
use Illuminate\Support\Str;
use Formz\Contracts\IField;
use Formz\Contracts\IRule;
use Formz\Contracts\IWorkflow;

class AbstractField implements IField
{
    protected string $id;

    protected string $type;

    protected string $name;

    protected $value;

    protected string $namespace;

    protected ?string $label = null;

    protected bool $readonly = false;

    protected bool $disabled = false;

    protected bool $hidden = false;

    protected array $rules = [];

    protected array $workflows = [];

    protected string $width = 'wFull';

    protected array $listeners = [];

    protected Data $attributes;

    /**
     * Field constructor.
     * @param string $type
     * @param string $name
     * @param $value
     * @param string $label
     * @internal param array $attributes
     */
    public function __construct(string $type, string $name, $value, string $label = null)
    {
        $this->id = Str::random(10);
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->attributes = new Data($this->defaultAttributes());

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Sets the value of the field
     *
     * @param $value
     *
     * @return AbstractField
     */
    public function setValue($value)
    {
        if (in_array($this->type, ['text', 'textarea', 'number', 'date'])) {
            if (is_object($value)) {
                $value = (string) $value;
            }
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Set Field attributes
     *
     * @param array $attributes
     * @return static
     */
    public function setAttributes(array $attributes): IField
    {
        foreach ($attributes as $key => $value) {
            $this->attributes->set($key, $value);
        }

        return $this;
    }

    /**
     * @param array|IRule[] $rules
     *
     * @return AbstractField
     */
    public function rules(array $rules): IField
    {
        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

    /**
     * @param array|IWorkflow[] $workflows
     *
     * @return AbstractField
     */
    public function workflows(array $workflows): IField
    {
        $this->workflows = array_merge($this->workflows, $workflows);

        return $this;
    }

    /**
     * Sets the field as disabled
     *
     * @param bool $value
     *
     * @return AbstractField
     */
    public function setDisabled($value = true)
    {
        $this->disabled = $value;

        return $this;
    }

    /**
     * Sets the field as readonly
     *
     * @param bool $value
     *
     * @return AbstractField
     */
    public function setReadonly($value = true): IField
    {
        $this->readonly = $value;

        return $this;
    }

    /**
     * Sets the field as hidden
     *
     * @param bool $value
     *
     * @return AbstractField
     */
    public function setHidden($value = true): IField
    {
        $this->hidden = $value;

        return $this;
    }

    /**
     * Sets the field as hidden
     * @return AbstractField
     */
    public function required(): IField
    {
        $this->rules([new Required()]);

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function wFull(): IField
    {
        $this->width = 'wFull';
        $this->attributes->set('container.class', 'col-xs-12');

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function w1p2(): IField
    {
        $this->width = 'w1p2';
        $this->attributes->set('container.class', 'col-xs-12 col-sm-6');

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function w1p3(): IField
    {
        $this->width = 'w1p3';
        $this->attributes->set('container.class', 'col-xs-12 col-sm-6 col-md-4');

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function w1p4(): IField
    {
        $this->width = 'w1p4';
        $this->attributes->set('container.class', 'col-xs-12 col-sm-6 col-md-3');

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function w1p6(): IField
    {
        $this->width = 'w1p6';
        $this->attributes->set('container.class', 'col-xs-12 col-sm-6 col-md-2');

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function w2p3(): IField
    {
        $this->width = 'w2p3';
        $this->attributes->set('container.class', 'col-xs-12 col-sm-8 col-md-8');

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function w3p4(): IField
    {
        $this->width = 'w3p4';
        $this->attributes->set('container.class', 'col-xs-12 col-sm-9 col-md-9');

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->guessLabel();
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public function isFile(): bool
    {
        return $this->getType() === 'file';
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toSelect(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'width' => $this->width,
            'name' => $this->name,
            'value' => $this->value,
            'disabled' => $this->disabled,
            'readonly' => $this->readonly,
            'hidden' => $this->hidden,
            'rules' => $this->rulesArray(),
            'workflows' => $this->workflows,
            'attributes' => $this->attributes->export()
        ];
    }


    /**
     * @return array
     */
    protected function defaultAttributes()
    {
        return [
            'placeholder' => null,
            'class' => 'form-control input-md',
            'required' => $this->isRequired(),
            'container' => [
                'class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12'
            ],
            'label' => [
                'value' => $this->guessLabel(),
                'class' => 'control-label'
            ]
        ];
    }

    private function guessLabel()
    {
        if ($this->label) {
            return trans($this->label);
        }

        $label = Str::snake($this->name);

        $transString = str_replace('_', '-', $label);

        return trans("forms.fields.{$transString}");
    }

    /**
     * @return bool
     */
    private function isRequired(): bool
    {
        return in_array('required', $this->rules);
    }

    private function rulesArray()
    {
        return array_map(function ($rule) {
            if ($rule instanceof IRule) {
                return [
                    'name' => $rule->name(),
                    'params' => $rule->params()
                ];
            }

            return [
                'name' => $rule['name'],
                'params' => $rule['params']
            ];
        }, $this->rules);
    }
}
