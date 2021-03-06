<?php

namespace Formz\View\Components;

use Formz\Contracts\IForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Form extends Component
{
    public IForm $form;

    public string $action = '';
    public string $method = 'POST';
    public string $enctype = '';
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

    public string $errorMessage;

    public array $fieldErrors;

    private string $theme;

    /**
     * @var Request
     */
    private Request $request;

    /**
     * Form constructor.
     * @param IForm $form
     * @param string|null $action
     * @param string|null $method
     * @param string|null $enctype
     */
    public function __construct(IForm $form, ?string $action = null, ?string $method = null, ?string $enctype = null)
    {
        $this->form = $form;
        $this->request = app('request');
        $this->action = $action ?: $this->form->getAction();
        $this->method = $method ?: $this->form->getMethod() ?: 'post';
        $this->enctype = $enctype ?: $this->form->getEnctype() ?: '';

        $this->theme = $this->form->getTheme();
        $this->config = Config::get('formz');
        $this->themeConfig = $this->themeConfig();

        $this->errorMessage = $this->errorMessage();
        $this->fieldErrors = $this->fieldErrors();
    }

    public function sections()
    {
        return $this->form->getSections();
    }

    private function errorMessage(): string
    {
        $errors = $this->request->session()->get('errors');

        if (!$errors || !$this->config['errors']['global']['active']) {
            return '';
        }

        return $this->config['errors']['global']['message'];
    }

    public function globalErrors()
    {
        $dedicated = sprintf("formz::components.%s.global-errors", $this->form->getTheme());

        $default = "formz::components.global-errors";

        return View::exists($dedicated) ? $dedicated : $default;
    }

    public function buttons()
    {
        $dedicated = sprintf("formz::components.%s.buttons", $this->form->getTheme());

        $default = "formz::components.buttons";

        return View::exists($dedicated) ? $dedicated : $default;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $dedicated = sprintf("formz::components.%s.form", $this->form->getTheme());

        $default = sprintf("formz::components.%s.form", Config::get('formz.theme'));

        return View::exists($dedicated) ? View::make($dedicated) : View::make($default);
    }

    private function themeConfig()
    {
        $path = sprintf('formz.themes.%s', $this->theme);

        // @todo - throw exception if the theme is not found
        return Config::get($path);
    }


    private function fieldErrors(): array
    {
        if ($this->config['errors']['global']['display'] === 'none') {
            return [];
        }

        $errorMessages = [];

        if ($this->request->getSession()) {
            $errors = $this->request->session()->get('errors');
            if ($errors instanceof ViewErrorBag) {
                foreach ($this->form->getFields() as $field) {
                    if ($errors->has($field->getName())) {
                        switch ($this->config['errors']['global']['display']) {
                            case 'first':
                                $fieldErrors = $errors->get($field->getName());
                                $errorMessages[] = reset($fieldErrors);
                                break;

                            case 'all':
                                $errorMessages = array_merge($errorMessages, $errors->toArray());
                                break;

                            default:
                                return [];
                                break;
                        }
                    }
                }
            }
        }

        return $errorMessages;
    }
}
