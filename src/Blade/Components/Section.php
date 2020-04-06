<?php

namespace Formz\Blade\Components;

use Formz\Contracts\ISection;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Section extends Component
{
    public ISection $section;

    public function __construct($section)
    {
        $this->section = $section;
    }

    public function fields()
    {
        return $this->section->getFields();
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return View::make('formz::components.section');
    }
}
