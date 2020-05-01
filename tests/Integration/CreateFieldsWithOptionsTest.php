<?php


namespace Integration;


use Formz\Field;

class CreateFieldsWithOptionsTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }



    /** @test */
    public function create_select_field_with_options_from_array()
    {
        $field = Field::select('selectField', ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->assertCount(2, $field->getOptions());
    }

    /** @test */
    public function create_select_field_with_options_from_closure()
    {
        $field = Field::select('selectField', fn() => ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->assertCount(2, $field->getOptions());
    }

    /** @test */
    public function create_select_field_with_options_from_laravel_collection()
    {
        $field = Field::select('selectField', collect(['value1' => 'Label 1', 'value2' => 'Label 2']));

        $this->assertCount(2, $field->getOptions());
    }




    /** @test */
    public function create_select_multiple_field_with_options_from_array()
    {
        $field = Field::selectMultiple('selectField', ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->assertCount(2, $field->getOptions());
    }

    /** @test */
    public function create_select_multiple_field_with_options_from_closure()
    {
        $field = Field::selectMultiple('selectField', fn() => ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->assertCount(2, $field->getOptions());
    }

    /** @test */
    public function create_select_multiple_field_with_options_from_laravel_collection()
    {
        $field = Field::selectMultiple('selectField', collect(['value1' => 'Label 1', 'value2' => 'Label 2']));

        $this->assertCount(2, $field->getOptions());
    }



    /** @test */
    public function create_checkbox_field_with_options_from_array()
    {
        $field = Field::checkbox('selectField', ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->assertCount(2, $field->getOptions());
    }

    /** @test */
    public function create_checkbox_field_with_options_from_closure()
    {
        $field = Field::checkbox('selectField', fn() => ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->assertCount(2, $field->getOptions());
    }

    /** @test */
    public function create_checkbox_field_with_options_from_laravel_collection()
    {
        $field = Field::checkbox('selectField', collect(['value1' => 'Label 1', 'value2' => 'Label 2']));

        $this->assertCount(2, $field->getOptions());
    }



    /** @test */
    public function create_radio_field_with_options_from_array()
    {
        $field = Field::radio('selectField', ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->assertCount(2, $field->getOptions());
    }

    /** @test */
    public function create_radio_field_with_options_from_closure()
    {
        $field = Field::radio('selectField', fn() => ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->assertCount(2, $field->getOptions());
    }

    /** @test */
    public function create_radio_field_with_options_from_laravel_collection()
    {
        $field = Field::radio('selectField', collect(['value1' => 'Label 1', 'value2' => 'Label 2']));

        $this->assertCount(2, $field->getOptions());
    }
}
