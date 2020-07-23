<?php

namespace Formz\Fluent;

use Formz\Contracts\IForm;
use Formz\Form;
use Illuminate\Database\Eloquent\Model;

//FormBuilder::build()
//    ->form()
//    ->section()->name('Personal details')
//    ->text('firstName', 'First Name')->required()
//    ->text('lastName', 'First Name')->required()
//    ->section();

class FluentForm
{
    private \Formz\Contracts\IForm $form;

    private function __construct() {}

    public static function make(): FluentForm
    {
        $instance = new static();

        $instance->form = new Form();

        return $instance;
    }

    public function section(?string $label = null): FluentSection
    {
        $fluentSection = FluentSection::make($label)->setContext($this);

        $this->form->addSection($fluentSection->getSection());

        return $fluentSection;
    }

    public function name(): self
    {
        return $this;
    }

    public function attr(array $attributes): self
    {
        $this->form->setAttributes($attributes);

        return $this;
    }

    public function mergeAttr(array $attributes, string $glue): self
    {
        $this->form->mergeAttributes($attributes, $glue);

        return $this;
    }

    public function id(string $id): self
    {
        $this->form->setAttributes(['id' => $id]);

        return $this;
    }

    public function class(string $class): self
    {
        $this->form->setAttributes(['class' => $class]);

        return $this;
    }

    public function addClass(string $class): self
    {
        $this->form->mergeAttributes(['class' => $class]);

        return $this;
    }

    public function theme(string $theme): self
    {
        $this->form->setTheme($theme);

        return $this;
    }

    public function enctype(string $enctype): self
    {
        $this->form->setEnctype($enctype);

        return $this;
    }

    public function multipart(): self
    {
        return $this->enctype('multipart/form-data');
    }

    public function get(): IForm
    {
        $this->form->resolve();
        return $this->form;
    }
}
