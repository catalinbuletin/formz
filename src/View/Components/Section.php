<?php

namespace Formz\View\Components;

use Formz\Contracts\ISection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Section extends Component
{
    public ISection $section;

    public string $helpText;

    /**
     * Array containing config values for the used theme
     * @var array|mixed
     */
    public array $themeConfig;

    private string $theme;

    public function __construct(ISection $section)
    {
        $this->section = $section;
        $this->theme = $this->section->getContext()->getTheme();
        $this->themeConfig = $this->themeConfig();
        $this->helpText = $this->section->getHelpText();
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

    private function themeConfig()
    {
        $path = sprintf('formz.themes.%s', $this->theme);

        return Config::get($path);
    }
}
