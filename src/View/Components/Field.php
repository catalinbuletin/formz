<?php

namespace Formz\View\Components;

use Formz\Contracts\IField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Field extends Component
{
    /**
     * @var IField
     */
    public IField $field;

    public Request $request;

    public bool $isRequired = false;

    public bool $hasErrors = false;

    public string $errorMessage = '';

    public function __construct($field)
    {
        $this->field = $field;
        $this->request = app()->get('request');
    }

    public function input()
    {
        $dedicated = sprintf(
            "formz::components.%s.inputs.%s",
            $this->field->getFormContext()->getTheme(),
            $this->field->getType(),
        );

        $default = sprintf("formz::components.inputs.%s", $this->field->getType());

        return View::exists($dedicated) ? $dedicated : $default;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $dedicated = sprintf("formz::components.%s.field", $this->field->getFormContext()->getTheme());

        $default = 'formz::components.field';

        return View::exists($dedicated) ? View::make($dedicated) : View::make($default);
    }
}
