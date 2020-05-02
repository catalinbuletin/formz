<?php


namespace Integration;

use Formz\Fields\AbstractField;
use Formz\Field;
use Formz\Option;

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

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }

    /** @test */
    public function create_select_field_with_options_from_closure()
    {
        $field = Field::select('selectField', fn() => ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }

    /** @test */
    public function create_select_field_with_options_from_laravel_collection()
    {
        $field = Field::select('selectField', collect(['value1' => 'Label 1', 'value2' => 'Label 2']));

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }




    /** @test */
    public function create_select_multiple_field_with_options_from_array()
    {
        $field = Field::selectMultiple('selectField', ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }

    /** @test */
    public function create_select_multiple_field_with_options_from_closure()
    {
        $field = Field::selectMultiple('selectField', fn() => ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }

    /** @test */
    public function create_select_multiple_field_with_options_from_laravel_collection()
    {
        $field = Field::selectMultiple('selectField', collect(['value1' => 'Label 1', 'value2' => 'Label 2']));

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }



    /** @test */
    public function create_checkbox_field_with_options_from_array()
    {
        $field = Field::checkbox('selectField', ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }

    /** @test */
    public function create_checkbox_field_with_options_from_closure()
    {
        $field = Field::checkbox('selectField', fn() => ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }

    /** @test */
    public function create_checkbox_field_with_options_from_laravel_collection()
    {
        $field = Field::checkbox('selectField', collect(['value1' => 'Label 1', 'value2' => 'Label 2']));

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }



    /** @test */
    public function create_radio_field_with_options_from_array()
    {
        $field = Field::radio('selectField', ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }

    /** @test */
    public function create_radio_field_with_options_from_closure()
    {
        $field = Field::radio('selectField', fn() => ['value1' => 'Label 1', 'value2' => 'Label 2']);

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }

    /** @test */
    public function create_radio_field_with_options_from_laravel_collection()
    {
        $field = Field::radio('selectField', collect(['value1' => 'Label 1', 'value2' => 'Label 2']));

        $this->check_options_were_created_and_can_iterate_over_them($field);
    }



    private function check_options_were_created_and_can_iterate_over_them(AbstractField $field): void
    {
        $options = $field->getOptions();

        /// check we can iterate over options
        $i = 0;
        foreach ($options as $option) {
            $i++;
            if ($i === 1) {
                $option1 = $option;
            }
            if ($i === count($options)) {
                $option2 = $option;
            }
        }

        $this->assertEquals(2, $i);

        /** @var Option $option1 */
        $this->assertEquals('value1', $option1->getValue());
        $this->assertEquals('Label 1', $option1->getLabel());

        /** @var Option $option2 */
        $this->assertEquals('value2', $option2->getValue());
        $this->assertEquals('Label 2', $option2->getLabel());
    }
}
