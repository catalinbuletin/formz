<?php

namespace Unit;

use Formz\Fluent\FluentForm;

class FluentFormTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    public function testFluent()
    {
        $builder = FluentForm::make()
            ->section('First Section')
                ->text('firstName', 'First name')->rules('required', 'min:3')
                ->text('lastName', 'Last name')->rules('required', 'min:3')
                ->text('email', 'E-mail')->rules('required', 'email')
            ->section('Second section')
                ->text('hobbies', 'Your hobbies')->rules('required')
                ->number('age')->min(18)->max(65)
                ->date('dateOfBirth', 'Date of Birth')->showWeekNumbers()
            ->section('Third')
                ->textarea('description', 'Description')->required();

        $form = $builder->get();

        $this->assertCount(3, $form->getSections());
        $this->assertCount(7, $form->getFields());

        $this->assertArrayHasKey('firstName', $form->getFieldNames(true));
        $this->assertArrayHasKey('email', $form->getFieldNames(true));
    }
}
