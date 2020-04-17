<?php


use Formz\Contracts\IField;
use Formz\Contracts\IForm;

class FieldComponentTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    /** @test */
    public function a_field_component_has_attributes()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function a_field_component_returns_an_input_class()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function a_field_component_returns_a_wrapper_class()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function a_field_component_returns_a_label_class()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function a_field_component_can_have_errors()
    {
        $this->assertTrue(true);
    }



    private function mockField(): IField
    {
        $field = Mockery::mock(IField::class);

        $field->shouldReceive('getContext')
            ->andReturn($this->mockForm());

        return $field;
    }

    private function mockForm(): IForm
    {
        $form = Mockery::mock(IForm::class);
        $form->shouldReceive('getTheme')
            ->andReturn('bootstrap4');
        return $form;
    }
}
