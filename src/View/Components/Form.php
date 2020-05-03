<?php

namespace Formz\View\Components;

use Formz\Contracts\IForm;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Form extends Component
{
    public IForm $form;

    public string $action = '';
    public string $method = '';

    public string $header = '';
    public string $footer = '';

    /**
     * Array containing config values for the package
     * @var array|mixed
     */
    public array $config;

    /**
     * Array containing config values for the used theme
     * @var array|mixed
     */
    public array $themeConfig;

    private string $theme;

    /**
     * Form constructor.
     * @param IForm $form
     * @param string|null $action
     * @param string|null $method
     */
    public function __construct(IForm $form, ?string $action = null, ?string $method = null)
    {
        $this->form = $form;
        $this->action = $action ?: $this->form->getAction();
        $this->method = $method ?: ($this->form->getMethod() ?: 'post');
        $this->theme = $this->form->getTheme();
        $this->config = Config::get('formz');
        $this->themeConfig = $this->themeConfig();
    }

    public function sections()
    {
        return $this->form->getSections();
    }

    public function formClass()
    {
        return $this->themeConfig['form-class'];
    }

    public function buttons()
    {
        $dedicated = sprintf("formz::components.%s.buttons", $this->theme);

        $default = "formz::components.buttons";

        return View::exists($dedicated) ? $dedicated : $default;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $dedicated = sprintf("formz::components.%s.form", $this->theme);
        $default = sprintf("formz::components.%s.form", Config::get('formz.theme'));

        return View::exists($dedicated) ? View::make($dedicated) : View::make($default);
    }

    private function themeConfig()
    {
        $path = sprintf('formz.themes.%s', $this->theme);

        // @todo - throw exception if the theme is not found
        return Config::get($path);
    }
}
