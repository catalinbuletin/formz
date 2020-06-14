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
     * Form constructor.
     * @param IForm $form
     * @param string|null $action
     * @param string|null $method
     * @param string|null $enctype
     */
    public function __construct(IForm $form, ?string $action = null, ?string $method = null, ?string $enctype = null)
    {
        $this->form = $form;
        $this->action = $action ?: $this->form->getAction();
        $this->method = $method ?: $this->form->getMethod() ?: 'post';
        $this->enctype = $enctype ?: $this->form->getEnctype() ?: '';
    }

    public function sections()
    {
        return $this->form->getSections();
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
}
