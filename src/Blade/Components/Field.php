<?php

namespace Formz\Blade\Components;

use Formz\Contracts\IField;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Field extends Component
{
    public IField $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function attributes()
    {
        return $this->field->getAttributes();
    }

    public function isRequired()
    {
        return in_array('required', $this->field->getRules());
    }

    public function hasErrors(): bool
    {
        /** @var ViewErrorBag $errors */
        $errors = request()->session()->get('errors');
        return $errors->isNotEmpty();
    }

    public function errors(): array
    {
        /** @var ViewErrorBag $errors */
        $errors = request()->session()->get('errors');
        return $errors->has($this->field->getName()) ? $errors->get($this->field->getName()) : [];
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        if (View::exists("formz::components.".config('formz.style').".fields.{$this->field->getType()}")) {
            return View::make("formz::components." . config('formz.style') . ".fields.{$this->field->getType()}");
        }
        return View::make("formz::components.fields.{$this->field->getType()}");
    }
}
