<?php

namespace Formz\Blade\Components;

use Formz\Contracts\IField;
use Illuminate\Support\Facades\View;
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
