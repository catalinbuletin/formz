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

    public function __construct(Request $request, $field)
    {
        $this->request = $request;
        $this->field = $field;
        $this->fieldConfig = $this->fieldConfig();
        $this->themeConfig = $this->themeConfig();
    }

    public function attributes()
    {
        return $this->field->getAttributes();
    }

    public function inputClass()
    {
        $classes[] = $this->fieldConfig['input-class'] ?? '';

        if ($this->hasErrors()) {
            $classes[] = 'is-invalid';
        }

        return implode(' ', $classes);
    }

    public function wrapperClass()
    {
        $classes[] = $this->fieldConfig['wrapper-class'] ?? '';

        foreach ($this->field->getCols() as $key => $col) {
            $classes[] = $this->themeConfig['grid-map'][$key] . $col;
        }

        return implode(' ', $classes);
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
        $theme = $this->field->getFormContext()->getTheme();
        $component = sprintf("formz::components.%s.fields.%s", $theme, $this->field->getType());

        $default = sprintf("formz::components.%s.fields.%s", Config::get('theme'), $this->field->getType());

        return View::exists($component) ? View::make($component) : View::make($default);
    }

    private function fieldConfig()
    {
        $theme = $this->field->getFormContext()->getTheme();
        $type = $this->field->getType();

        $path = sprintf('formz.themes.%s.fields.%s', $theme, $type);

        return Config::get($path, []);
    }

    private function themeConfig()
    {
        $theme = $this->field->getFormContext()->getTheme();

        $path = sprintf('formz.themes.%s', $theme);

        return Config::get($path);
    }
}
