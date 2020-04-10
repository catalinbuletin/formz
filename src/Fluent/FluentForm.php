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

    /**
     * @return FluentForm
     */
    public static function make(): FluentForm
    {
        $instance = new static();

        $instance->form = new Form();

        return $instance;
    }

    /**
     * @return FluentForm
     */
    public static function for(Model $model): FluentForm
    {
        $instance = new static();

        $instance->form = new Form();

        return $instance;
    }
//
//    public function model(Model $model)
//    {
//        $this->model = $model;
//
//        return $this;
//    }

    /**
     * @param string|null $label
     *
     * @return FluentSection
     */
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
