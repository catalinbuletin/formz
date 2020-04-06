<?php

namespace Formz\Fluent;

use Formz\Contracts\IForm;

class FluentForm
{
    private \Formz\Contracts\IForm $form;

    public static function make(): FluentForm
    {
        $instance = new static();

        $instance->form = \Formz\Form::make();

        return $instance;
    }

    public function section(?string $label = null): FluentSection
    {
        $fluentSection = FluentSection::make($label)->setContext($this);

        $this->form->addSection($fluentSection->getSection());

        return $fluentSection;
    }

    public function name()
    {

    }

    public function config()
    {

    }

    public function get(): IForm
    {
        return $this->form;
    }
}
