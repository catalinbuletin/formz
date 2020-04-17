<?php


use Formz\Blade\Components\Form;
use Formz\Contracts\IForm;
use Illuminate\Support\Facades\Config;

class FormComponentTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    /** @test */
    public function a_form_component_has_action_and_method()
    {
        $formComponent = new Form($this->mockForm(), '/action', 'post');

        $this->assertEquals('/action', $formComponent->action);
        $this->assertEquals('post', $formComponent->method);
    }

    /** @test */
    public function a_form_component_has_form_class()
    {
        Config::shouldReceive('get')->with('formz.themes.bootstrap4')
                ->andReturn([
                    'form-class' => 'form-class-assigned'
                ]);

        $formComponent = new Form($this->mockForm());

        $this->assertEquals('form-class-assigned', $formComponent->formClass());
    }

    /** @test */
    public function a_form_component_has_collection_of_sections()
    {
        $formComponent = new Form($this->mockForm());

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $formComponent->sections());
        $this->assertEquals(2, $formComponent->sections()->count());
    }





    private function mockForm(): IForm
    {
        $form = Mockery::mock(IForm::class);
        $form->shouldReceive('getTheme')
            ->andReturn('bootstrap4');
        $form->shouldReceive('getSections')
            ->andReturn(collect(['section1', 'section2']));
        return $form;
    }

}
