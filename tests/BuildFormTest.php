<?php

use Formz\Field;
use Formz\Form;
use Formz\Section;


class BuildFormTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    public function testMake()
    {
        $emptyForm = Form::make();

        $this->assertInstanceOf(Form::class, $emptyForm);
        $this->assertCount(0, $emptyForm->getSections());
        $this->assertCount(0, $emptyForm->getFields());

        $personalDetails = Section::make();
        $personalDetails->setLabel('Personal Details');
        $personalDetails->addField(Field::text('name', 'Name'));
        $personalDetails->addField(Field::text('username', 'Username'));
        $personalDetails->addField(Field::password('password', 'Password'));

        $address = Section::make('Address', [
            Field::text('addressLine1', 'Address Line 1'),
            Field::text('addressLine2', 'Address Line 1'),
            Field::text('city', 'City'),
            Field::text('zipCode', 'zipCode')
        ]);

        $form = Form::make([$personalDetails, $address]);

        $this->assertInstanceOf(Form::class, $form);
        $this->assertCount(2, $form->getSections());
        $this->assertContainsOnlyInstancesOf(Section::class, $form->getSections());
        $this->assertCount(7, $form->getFields());

        $this->assertArrayHasKey('name', $form->getFieldNames(true));
        $this->assertArrayHasKey('username', $form->getFieldNames(true));
        $this->assertArrayHasKey('password', $form->getFieldNames(true));

        $this->assertArrayHasKey('addressLine1', $form->getFieldNames(true));
        $this->assertArrayHasKey('addressLine2', $form->getFieldNames(true));
        $this->assertArrayHasKey('city', $form->getFieldNames(true));
        $this->assertArrayHasKey('zipCode', $form->getFieldNames(true));
    }

    public function testAddFields()
    {
        $form = Form::make();

        $form->addFields([
            Field::text('name', 'Name'),
            Field::text('username', 'Username'),
            Field::password('password', 'Password')
        ]);

        $form->addFields([
            Field::text('addressLine1', 'Address Line 1'),
            Field::text('addressLine2', 'Address Line 2'),
            Field::text('city', 'City'),
            Field::text('zipCode', 'zipCode')
        ]);

        $this->assertInstanceOf(Form::class, $form);
        $this->assertCount(2, $form->getSections());
        $this->assertCount(7, $form->getFields());
    }

    public function testAddSection()
    {
        $form = Form::make();

        $section = Section::make('Detaii Personale');
        $section->addField(Field::text('name', 'Name'));
        $section->addField(Field::text('username', 'Username'));
        $section->addField(Field::password('password', 'Password'));

        $form->addSection($section);

        $this->assertCount(1, $form->getSections());
        $this->assertContainsOnlyInstancesOf(Section::class, $form->getSections());

        $this->assertCount(3, $form->getFields());
    }

    public function testFormExceptFields()
    {
        $form = Form::make();

        $form->addFields([
            Field::text('name', 'Name'),
            Field::text('username', 'Username'),
            Field::password('password', 'Password')
        ]);

        $form->except(['username', 'password']);

        $this->assertCount(1, $form->getFields());
        $this->assertArrayHasKey('name', $form->getFieldNames(true));
        $this->assertArrayNotHasKey('username', $form->getFieldNames(true));
        $this->assertArrayNotHasKey('password', $form->getFieldNames(true));
    }

    public function testFormOnlyFields()
    {
        $form = Form::make()
            ->addFields([
                Field::text('name', 'Name'),
                Field::text('username', 'Username'),
                Field::password('password', 'Password')
            ])->addFields([
                Field::text('hobbies', 'Hobbies'),
                Field::text('interests', 'Interests'),
            ]);

        $form->only(['name']);

        $this->assertCount(1, $form->getFields());
        $this->assertArrayHasKey('name', $form->getFieldNames(true));
        $this->assertArrayNotHasKey('username', $form->getFieldNames(true));
        $this->assertArrayNotHasKey('password', $form->getFieldNames(true));
    }
}
