<?php

namespace Formz\Blade\Components;

use Formz\Contracts\IField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Field extends Component
{
    /**
     * @var IField
     */
    public IField $field;

    /**
     * @var Request
     */
    public Request $request;

    /**
     * Array containing config values for the specific field type of the used theme
     * @var array|mixed
     */
    public array $fieldConfig;

    /**
     * Array containing config values for the used theme
     * @var array|mixed
     */
    public array $themeConfig;

    /**
     * @var string
     */
    private string $theme;

    public function __construct(Request $request, $field)
    {
        $this->request = $request;
        $this->field = $field;
        $this->theme = $this->field->getFormContext()->getTheme();
        $this->fieldConfig = $this->fieldConfig();
        $this->themeConfig = $this->themeConfig();
    }

    public function attributes()
    {
        return $this->field->getAttributes();
    }

    public function input()
    {
        $dedicated = sprintf("formz::components.%s.inputs.%s", $this->theme, $this->field->getType());

        $default = sprintf("formz::components.inputs.%s", $this->field->getType());

        return View::exists($dedicated) ? $dedicated : $default;
    }

    public function inputClass()
    {
        $classes = [$this->fieldConfig['input-class'] ?? ''];

        if ($this->hasErrors()) {
            $classes[] = 'is-invalid';
        }

        if ($this->hasErrors()) {
            $classes[] = $this->themeConfig['error-class']['input'];
        }

        return implode(' ', $classes);
    }

    public function wrapperClass()
    {
        $classes = [$this->fieldConfig['wrapper-class'] ?? ''];

        foreach ($this->field->getCols() as $key => $col) {
            $classes[] = $this->themeConfig['grid-map'][$key] . $col;
        }

        if ($this->hasErrors()) {
            $classes[] = $this->themeConfig['error-class']['wrapper'];
        }

        return trim(implode(' ', $classes));
    }

    public function labelClass()
    {
        $classes = [$this->fieldConfig['label-class'] ?? ''];

        if ($this->hasErrors()) {
            $classes[] = $this->themeConfig['error-class']['label'];
        }

        return trim(implode(' ', $classes));
    }

    public function isRequired()
    {
        return in_array('required', $this->field->getRules());
    }

    public function hasErrors(): bool
    {
        /** @var ViewErrorBag $errors */
        $errors = $this->request->session()->get('errors');

        return $errors instanceof ViewErrorBag && $errors->has($this->field->getName());
    }

    public function errors(): array
    {
        /** @var ViewErrorBag $errors */
        $errors = $this->request->session()->get('errors');

        return $errors instanceof ViewErrorBag && $errors->has($this->field->getName()) ? $errors->get($this->field->getName()) : [];
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $dedicated = sprintf("formz::components.%s.field", $this->theme);

        $default = 'formz::components.field';

        return View::exists($dedicated) ? View::make($dedicated) : View::make($default);
    }

    private function fieldConfig()
    {
        $type = $this->field->getType();

        $dedicated = sprintf('formz.themes.%s.fields.%s', $this->theme, $type);

        $default = sprintf('formz.themes.%s.fields.default', $this->theme);

        return Config::get($dedicated, Config::get($default));
    }

    private function themeConfig()
    {
        $path = sprintf('formz.themes.%s', $this->theme);

        return Config::get($path);
    }
}
