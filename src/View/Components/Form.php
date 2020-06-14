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
    public string $enctype = '';

    public string $header = '';
    public string $footer = '';

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
     * @param string|null $enctype
     */
    public function __construct(Request $request, IForm $form, ?string $action = null, ?string $method = null, ?string $enctype = null)
    {
        $this->request = $request;
        $this->form = $form;
        $this->action = $action ?: $this->form->getAction();
        $this->method = $method ?: $this->form->getMethod() ?: 'post';
        $this->enctype = $enctype ?: $this->form->getEnctype() ?: '';

        $this->errorMessage = $this->errorMessage();
    }

    public function sections()
    {
        return $this->form->getSections();
    }

    private function errorMessage(): string
    {
        if ($this->form->getConfig()['errors']['global']['active']) {
            $errorMessages = $this->getFieldsErrors();
            if ($errorMessages) {
                $errorMessages = array_merge([$this->form->getConfig()['errors']['global']['message'], ''], $errorMessages);
            }
            return implode("\n", $errorMessages);
        }

        return '';
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

    private function getFieldsErrors(): array
    {
        $errorMessages = [];

        if ($this->request->getSession()) {
            $errors = $this->request->session()->get('errors');
            if ($errors instanceof ViewErrorBag) {
                foreach ($this->form->getFields() as $field) {
                    if ($errors->has($field->getName())) {
                        switch ($this->form->getConfig()['errors']['global']['display']) {
                            case 'first':
                                $fieldErrors = $errors->get($field->getName());
                                $errorMessages[] = reset($fieldErrors);
                                break;

                            case 'all':
                                $errorMessages = array_merge($errorMessages, $errors);
                                break;

                            case 'none':
                            default:
                                return $this->form->getConfig()['errors']['global']['message'];
                                break;
                        }
                    }
                }
            }
        }

        return $errorMessages;
    }
}
