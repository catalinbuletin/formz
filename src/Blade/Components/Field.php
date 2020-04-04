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

    /**
     * @inheritDoc
     */
    public function render()
    {
        return View::make("formz::components.fields.{$this->field->getType()}");
    }
}
