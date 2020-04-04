<?php

namespace Formz\Blade\Components;

use Formz\Contracts\IForm;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Form extends Component
{
    public IForm $form;

    public function __construct(IForm $form)
    {
        $this->form = $form;
    }

    public function sections()
    {
        return $this->form->getSections();
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return View::make('formz::components.form');
    }
}
