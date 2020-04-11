<?php

namespace Formz\Blade\Components;

use Formz\Contracts\ISection;
use Illuminate\Support\Facades\Config;
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
        $component = sprintf("formz::components.%s.section", $this->section->getContext()->getTheme());
        $default = sprintf("formz::components.%s.section", Config::get('theme'));

        return View::exists($component) ? View::make($component) : View::make($default);
    }
}
