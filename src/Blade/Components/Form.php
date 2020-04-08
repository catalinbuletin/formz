<?php

namespace Formz\Blade\Components;

use Formz\Contracts\IForm;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Form extends Component
{
    public IForm $form;

    public string $header = '';
    public string $footer = '';

    public function __construct(IForm $form)
    {
        $this->form = $form;
    }

    public function sections()
    {
        return $this->form->getSections();
    }

    public function count()
    {
        return 5;
    }

    public function action()
    {
        return $this->form->action ?? '';
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
