<?php

namespace Formz\Fields;

use Formz\HasAttributes;
use Formz\Contracts\IForm;
use Formz\Contracts\ISection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Formz\Contracts\IField;
use Illuminate\Support\ViewErrorBag;

class AbstractField implements IField
{
    use HasAttributes;

    protected string $id;
    protected string $type;
    protected string $name;
    protected $value;
    protected string $namespace;
    protected ?string $label = null;
    protected bool $readonly = false;
    protected bool $disabled = false;
    protected bool $hidden = false;
    protected ?int $tabindex = null;
    protected string $helpText;
    protected array $rules = [];
    protected string $width = 'wFull';
    protected array $cols = [
        'xs' => 12,
        'sm' => 12,
        'md' => 12,
        'lg' => 12,
        'xlg' => 12
    ];
    protected ISection $context;
    protected bool $resolved = false;

    public const TEXT = 'text';
    public const PASSWORD = 'password';
    public const NUMBER = 'number';
    public const TEXTAREA = 'textarea';
    public const SELECT = 'select';
    public const MULTISELECT = 'multiselect';
    public const CHECKBOX = 'checkbox';
    public const RADIO = 'radio';
    public const DATE = 'date';
    public const FILE = 'file';

    public const FIELDS_MAPPER = [
        self::TEXT => Text::class,
        self::PASSWORD => Password::class,
        self::NUMBER => Number::class,
        self::TEXTAREA => Textarea::class,
        self::SELECT => Choice::class,
        self::MULTISELECT => Choice::class,
        self::CHECKBOX => Checkbox::class,
        self::RADIO => Radio::class,
        self::DATE => Date::class,
        self::FILE => File::class,
    ];

    public function __construct(string $type, string $name, string $label = null, $value = null)
    {
        $this->id = Str::random(10);
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setValue($value): IField
    {
        // @todo - refactor this. number should be int
        if (in_array($this->type, ['text', 'textarea', 'number', 'date'])) {
            if (is_object($value)) {
                $value = (string) $value;
            }
        }

        $this->value = $value;

        return $this;
    }

    public function rules(array $rules): IField
    {
        foreach ($rules as $rule) {
            $rulesToBeAdded = explode('|', $rule);
            foreach ($rulesToBeAdded as $ruleToBeAdded) {
                $this->rules[] = $ruleToBeAdded;
            }
        }
        $this->rules = array_unique($this->rules);

        return $this;
    }

    public function setDisabled($value = true): IField
    {
        $this->disabled = $value;

        return $this;
    }

    public function setReadonly($value = true): IField
    {
        $this->readonly = $value;

        return $this;
    }

    public function setHidden($value = true): IField
    {
        $this->hidden = $value;

        return $this;
    }

    public function required(): IField
    {
        //$this->rules([new Required()]);
        $this->rules(['required']);

        return $this;
    }

    /**
     * Set field 'width' when using the grid system
     * Used to set the proper classes for our fields so that are responsive
     *
     * @param int|string $xs
     * @param int|string|null $sm
     * @param int|string|null $md
     * @param int|string|null $lg
     * @param int|string|null $xlg
     *
     * @return IField
     */
    public function setCols($xs, $sm = null, $md = null, $lg = null, $xlg = null): IField
    {
        $sm = $sm ?: $xs;
        $md = $md ?: $sm;
        $lg = $lg ?: $md;
        $xlg = $xlg ?: $lg;

        $this->cols = [
            'xs' => $xs,
            'sm' => $sm,
            'md' => $md,
            'lg' => $lg,
            'xlg' => $xlg
        ];

        return $this;
    }

    public function setTabindex(int $tabindex): IField
    {
        $this->tabindex = $tabindex;

        return $this;
    }

    public function setHelpText(string $helpText): IField
    {
        $this->helpText = $helpText;

        return $this;
    }

    public function setContext(ISection $section): IField
    {
        $this->context = $section;

        if ($this->isFile()) {
            /** We have a file input, let's set the enctype of the form to multipart/form-data */
            $this->getFormContext()->setEnctype('multipart/form-data');
        }

        $this->setDefaultAttributes();

        return $this;
    }

    public function getContext(): ISection
    {
        return $this->context;
    }

    public function getFormContext(): IForm
    {
        return $this->context->getContext();
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

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

    public function getRules(): array
    {
        return $this->rules;
    }

    public function getCols(): array
    {
        return $this->cols;
    }

    public function getTabindex(): ?int
    {
        return $this->tabindex;
    }

    public function getHelpText(): string
    {
        return $this->helpText ?? '';
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
            'errors' => $this->errors(),
            'errorMessage' => $this->errorMessage(),
            'attributes' => $this->attributes->export(),
        ];
    }

    protected function defaultAttributes(): array
    {
        return [
            'input' => [
                'id' => $this->id,
                'placeholder' => null,
                'class' =>
                    Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.fields.' . $this->type . '.input_class') ?:
                    Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.fields.default.input_class'),
            ],
            'container' => [
                'class' => Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.fields.' . $this->type . '.wrapper_class') ?:
                    Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.fields.default.wrapper_class'),
            ],
            'label' => [
                'class' => Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.fields.' . $this->type . '.label_class') ?:
                    Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.fields.default.label_class'),
                'required_asterisk_class' => Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.required_asterisk_class'),
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

        return trans("fields.{$transString}");
    }

    public function isRequired(): bool
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

    public function errors(): array
    {
        if (Session::has('errors')) {
            /** @var ViewErrorBag $errors */
            $errors = Session::get('errors');

            return $errors instanceof ViewErrorBag && $errors->has($this->getName()) ? $errors->get($this->getName()) : [];
        }

        return [];
    }

    public function errorMessage(): string
    {
        if (!Config::get('formz.errors.input.active')) {
            return '';
        }

        $errors = $this->errors();

        if (Config::get('formz.errors.input.display') === 'all') {
            return implode("\n", $errors);
        }

        return reset($errors) ?: '';
    }



    private function mergeContainerGridClass(): void
    {
        $classes = [];

        foreach (Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.grid_map') as $key => $colClass) {
            $classes[] = sprintf($colClass, $this->getCols()[$key] ?? 12);
        }

        $this->addAttributes(['container.class' => implode(' ', $classes)]);
    }

    private function addErrorClasses()
    {
        if ($this->errors()) {
            $this->addAttributes([
                'input.class' => Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.error_class.input'),
                'label.class' => Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.error_class.label'),
                'container.class' => Config::get('formz.themes.' . $this->getFormContext()->getTheme() . '.error_class.container'),
            ]);
        }
    }

    public function resolve(): void
    {
        if (!$this->resolved) {
            $this->mergeContainerGridClass();
            $this->addErrorClasses();
            $this->resolved = true;
        }
    }
}
