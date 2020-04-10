<?php

namespace Formz\Blade\Components;

use Formz\Contracts\IForm;
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
     * Form constructor.
     * @param IForm $form
     * @param string|null $action
     * @param string|null $method
     */
    public function __construct(IForm $form, ?string $action = null, ?string $method = null)
    {
        $this->form = $form;
        $this->action = $action ?? '';
        $this->method = $method ?? 'get';
    }

    public function sections()
    {
        return $this->form->getSections();
    }

    public function count()
    {
        return 5;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        if (View::exists('formz::components.'.config('formz.style').'.form')) {
            return View::make('formz::components.'.config('formz.style').'.form');
        }
        return View::make('formz::components.bootstrap4.form');
    }
}
