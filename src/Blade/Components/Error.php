<?php

namespace Formz\Blade\Components;

use Formz\Contracts\IField;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Error extends Component
{
    public array $errors;
    protected IField $field;

    /**
     * Error constructor.
     *
     * @param IField $field
     * @param string|array $errors
     */
    public function __construct(IField $field, $errors)
    {
        $this->errors = is_string($errors) ? [$errors] : $errors;
        $this->field = $field;
    }


    /**
     * @inheritDoc
     */
    public function render()
    {
        $component = sprintf("formz::components.%s.error", $this->field->getFormContext()->getTheme());
        $default = sprintf("formz::components.%s.error", Config::get('theme'));

        return View::exists($component) ? View::make($component) : View::make($default);
    }
}
