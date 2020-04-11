<?php

namespace Formz\Blade\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Error extends Component
{
    public array $errors;

    /**
     * Error constructor.
     * @param string|array $errors
     */
    public function __construct($errors)
    {
        if (is_string($errors)) {
            $this->errors = [$errors];
        } else {
            $this->errors = $errors;
        }
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        if (View::exists("formz::components.".config('formz.style').".error")) {
            return View::make("formz::components." . config('formz.style') . ".error");
        }
        return View::make("formz::components.error");
    }
}
