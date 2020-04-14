<?php

namespace Formz\Blade\Components;

use Formz\Contracts\ISection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Section extends Component
{
    public ISection $section;

    /**
     * Array containing config values for the used theme
     * @var array|mixed
     */
    public array $themeConfig;

    private string $theme;

    public function __construct($section)
    {
        $this->section = $section;
        $this->theme = $this->section->getContext()->getTheme();
        $this->themeConfig = $this->themeConfig();
    }

    public function fields()
    {
        return $this->section->getFields();
    }

    public function sectionClass()
    {
        return $this->themeConfig['section-class'];
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

    private function themeConfig()
    {
        $path = sprintf('formz.themes.%s', $this->theme);

        return Config::get($path);
    }
}
