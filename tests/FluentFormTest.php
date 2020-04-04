<?php

use Formz\Fluent\FluentForm;

class FluentFormTest extends PHPUnit\Framework\TestCase
{
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
        $this->assertCount(6, $form->getFields());

        $this->assertArrayHasKey('name', $form->getFieldNames(true));
        $this->assertArrayHasKey('email', $form->getFieldNames(true));
    }
}
