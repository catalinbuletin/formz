<?php

namespace Formz\View\Components;

use Formz\Contracts\IField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Field extends Component
{
    /**
     * @var IField
     */
    public IField $field;

    /**
     * @var Request
     */
    public Request $request;

    public string $errorMessage;

    public function __construct(Request $request, $field)
    {
        $this->request = $request;
        $this->field = $field;

        $this->errorMessage = $this->errorMessage();
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

    private function errorMessage(): string
    {
        if (!config('formz.errors.input.active')) {
            return '';
        }

        $errors = $this->errors();

        if (config('formz.errors.input.display') === 'all') {
            return implode("\n", $errors);
        }

        return reset($errors) ?: '';
    }

    private function errors(): array
    {
        if ($this->request->getSession()) {
            /** @var ViewErrorBag $errors */
            $errors = $this->request->session()->get('errors');

            return $errors instanceof ViewErrorBag && $errors->has($this->field->getName()) ? $errors->get($this->field->getName()) : [];
        }

        return [];
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
