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
     * @var Request
     */
    private Request $request;


    public string $errorMessage;

    /**
     * Form constructor.
     * @param IForm $form
     * @param string|null $action
     * @param string|null $method
     */
    public function __construct(Request $request, IForm $form, ?string $action = null, ?string $method = null)
    {
        $this->request = $request;
        $this->form = $form;
        $this->action = $action ?: $this->form->getAction();
        $this->method = $method ?: $this->form->getMethod() ?: 'post';
        $this->theme = $this->form->getTheme();
        $this->config = Config::get('formz');
        $this->themeConfig = $this->themeConfig();

        $this->errorMessage = $this->errorMessage();
    }

    public function sections()
    {
        return $this->form->getSections();
    }

    private function errorMessage(): string
    {
        if ($this->config['errors']['global']['active']) {
            $errorMessages = $this->getFieldsErrors();
            if ($errorMessages) {
                $errorMessages = array_merge([$this->config['errors']['global']['message'], ''], $errorMessages);
            }
            return implode("\n", $errorMessages);
        }

        return '';
    }

    public function globalErrors()
    {
        $dedicated = sprintf("formz::components.%s.global-errors", $this->theme);

        $default = "formz::components.global-errors";

        return View::exists($dedicated) ? $dedicated : $default;
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


    private function getFieldsErrors(): array
    {
        $errors = $this->request->session()->get('errors');

        $errorMessages = [];
        if ($errors instanceof ViewErrorBag) {
            foreach ($this->form->getFields() as $field) {
                if ($errors->has($field->getName())) {
                    switch ($this->config['errors']['global']['display']) {
                        case 'first':
                            $fieldErrors = $errors->get($field->getName());
                            $errorMessages[] = reset($fieldErrors);
                            break;

                        case 'all':
                            $errorMessages = array_merge($errorMessages, $errors);
                            break;

                        case 'none':
                        default:
                            return $this->config['errors']['global']['message'];
                            break;
                    }
                }
            }
        }

        return $errorMessages;
    }
}
