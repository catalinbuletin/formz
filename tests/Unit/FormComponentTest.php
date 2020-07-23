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
        $formComponent = new Form($this->mockForm(), '/action', 'post');

        $this->assertEquals('/action', $formComponent->action);
        $this->assertEquals('post', $formComponent->method);
    }

    /** @test */
    public function a_form_component_has_enctype()
    {
        $formComponent = new Form(
            $this->mockForm(),
            '/action',
            'post',
            'application/x-www-form-urlencoded',
        );

        $this->assertEquals('application/x-www-form-urlencoded', $formComponent->enctype);
    }

    /** @test */
    public function a_form_component_has_collection_of_sections()
    {
        $formComponent = new Form($this->mockForm());

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
        $form->shouldReceive('getEnctype')
            ->andReturn('application/x-www-form-urlencoded');
        return $form;
    }

}
