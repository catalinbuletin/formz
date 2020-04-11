<?php

namespace Formz\Blade\Components;

use Formz\Contracts\IField;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Label extends Component
{
    public string $label;
    public string $forId;

    protected IField $field;

    /**
     * Label constructor.
     *
     * @param IField $field
     */
    public function __construct(IField $field)
    {
        $this->field = $field;
        $this->label = $field->getLabel();
        $this->forId = $field->getId();
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
        $component = sprintf("formz::components.%s.label", $this->field->getFormContext()->getTheme());
        $default = sprintf("formz::components.%s.label", Config::get('theme'));

        return View::exists($component) ? View::make($component) : View::make($default);
    }
}
