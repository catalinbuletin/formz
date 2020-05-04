<?php

namespace Unit;

use Formz\View\Components\Form;
use Formz\Contracts\IForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Mockery;

class FormComponentTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    /** @test */
    public function a_form_component_has_action_and_method()
    {
        $formComponent = new Form($this->app->make(Request::class), $this->mockForm(), '/action', 'post');

        $this->assertEquals('/action', $formComponent->action);
        $this->assertEquals('post', $formComponent->method);
    }

    /** @test */
    public function a_form_component_has_form_class()
    {
        $formComponent = new Form($this->app->make(Request::class), $this->mockForm('bulma'));

        $this->assertEquals('', $formComponent->formClass());
    }

    /** @test */
    public function a_form_component_has_collection_of_sections()
    {
        $formComponent = new Form($this->app->make(Request::class), $this->mockForm());

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $formComponent->sections());
        $this->assertEquals(2, $formComponent->sections()->count());
    }





    private function mockForm(string $theme = 'bootstrap4'): IForm
    {
        $form = Mockery::mock(IForm::class);
        $form->shouldReceive('getTheme')
            ->andReturn($theme);
        $form->shouldReceive('getSections')
            ->andReturn(collect(['section1', 'section2']));
        $form->shouldReceive('getAction')
            ->andReturn('/');
        $form->shouldReceive('getMethod')
            ->andReturn('post');
        return $form;
    }

}