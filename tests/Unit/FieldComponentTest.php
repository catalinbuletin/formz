<?php

namespace Unit;

use Formz\Contracts\IField;
use Formz\Contracts\IForm;
use Formz\Contracts\ISection;
use Formz\View\Components\Field;
use Illuminate\Http\Request;
use Mockery;

class FieldComponentTest extends \Orchestra\Testbench\TestCase
{

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
    }


    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    /** @test */
    public function a_field_component_has_attributes()
    {
        $fieldComponent = $this->getFieldComponent();
        $this->assertInstanceOf(\Dflydev\DotAccessData\Data::class, $fieldComponent->attributes());
    }

    /** @test */
    public function a_field_component_returns_an_input_class()
    {
        $fieldComponent = $this->getFieldComponent();
        $this->assertEquals('form-control', $fieldComponent->inputClass());
    }

    /** @test */
    public function a_field_component_returns_a_wrapper_class()
    {
        $fieldComponent = $this->getFieldComponent();
        $this->assertEquals('form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xlg-12', $fieldComponent->wrapperClass());
    }

    /** @test */
    public function a_field_component_returns_a_label_class()
    {
        $fieldComponent = $this->getFieldComponent();
        $this->assertEquals('', $fieldComponent->labelClass());
    }

    /** @test */
    public function a_field_does_not_repeat_wrapper_classes()
    {
        $fieldComponent = $this->getFieldComponent('text', 'foundation');
        $this->assertEquals('cell small-12 medium-12 large-12', $fieldComponent->wrapperClass());
    }




    private function getFieldComponent(string $type = 'text', string $theme = 'bootstrap4')
    {
        return $fieldComponent = new Field($this->app->make(Request::class), $this->mockField($type, $theme));
    }

    private function mockField(string $type = 'text', string $theme = 'bootstrap4'): IField
    {
        $field = Mockery::mock(IField::class);

        $field->shouldReceive('getFormContext')
            ->andReturn($this->mockForm($theme));
        $field->shouldReceive('getContext')
            ->andReturn($this->mockSection($theme));
        $field->shouldReceive('getType')
            ->andReturn($type);
        $field->shouldReceive('getCols')
            ->andReturn(['xs' => 12, 'sm' => 12, 'md' => 12, 'lg' => 12, 'xlg' => 12]);
        $field->shouldReceive('getAttributes')
            ->andReturn(new \Dflydev\DotAccessData\Data([]));

        return $field;
    }

    private function mockSection(string $theme = 'bootstrap4'): ISection
    {
        $section = Mockery::mock(ISection::class);

        $section->shouldReceive('getContext')
            ->andReturn($this->mockForm($theme));

        return $section;
    }

    private function mockForm(string $theme = 'bootstrap4'): IForm
    {
        $form = Mockery::mock(IForm::class);

        $form->shouldReceive('getTheme')
            ->andReturn($theme);

        return $form;
    }
}
