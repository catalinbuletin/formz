<?php

namespace Formz\Blade\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Label extends Component
{

    public string $label;
    public string $forId;
    public bool $isRequired;

    /**
     * Label constructor.
     * @param string $label
     * @param string $forId
     * @param bool $isRequired
     */
    public function __construct(string $label, string $forId, bool $isRequired)
    {
        $this->label = $label;
        $this->forId = $forId;
        $this->isRequired = $isRequired;
    }



    /**
     * @inheritDoc
     */
    public function render()
    {
        if (View::exists("formz::components.".config('formz.style').".label")) {
            return View::make("formz::components." . config('formz.style') . ".label");
        }
        return View::make("formz::components.label");
    }
}
