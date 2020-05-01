<?php

namespace Unit;

use Formz\Option;

class OptionTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    /** @test */
    public function make_option_from_string_key_string_value()
    {
        $option = Option::makeFromKeyValue('key', 'value');

        $this->assertEquals('key', $option->getValue());
        $this->assertEquals('value', $option->getLabel());
    }

    /** @test */
    public function make_option_from_object_with_name_property()
    {
        $object = new class {
            public string $name = 'Label';
        };

        $option = Option::makeFromKeyValue('key', $object);

        $this->assertEquals('Label', $option->getLabel());
    }

    /** @test */
    public function make_option_from_object_with_label_property()
    {
        $object = new class {
            public string $label = 'Label';
        };

        $option = Option::makeFromKeyValue('key', $object);

        $this->assertEquals('Label', $option->getLabel());
    }

    /** @test */
    public function make_option_from_object_with_get_name_method()
    {
        $object = new class {
            public function getName(): string {
                return 'Label';
            }
        };

        $option = Option::makeFromKeyValue('key', $object);

        $this->assertEquals('Label', $option->getLabel());
    }

    /** @test */
    public function make_option_from_object_with_get_label_method()
    {
        $object = new class {
            public function getLabel(): string {
                return 'Label';
            }
        };

        $option = Option::makeFromKeyValue('key', $object);

        $this->assertEquals('Label', $option->getLabel());
    }

    /** @test */
    public function make_option_from_object_with_id_property()
    {
        $object = new class {
            public string $id = 'Value';
            public string $name = 'Label';
        };

        $option = Option::makeFromKeyValue('key', $object);

        $this->assertEquals('Value', $option->getValue());
    }

    /** @test */
    public function make_option_from_object_with_value_property()
    {
        $object = new class {
            public string $value = 'Value';
            public string $name = 'Label';
        };

        $option = Option::makeFromKeyValue('key', $object);

        $this->assertEquals('Value', $option->getValue());
    }

    /** @test */
    public function make_option_from_object_with_get_id_method()
    {
        $object = new class {
            public string $name = 'Label';

            public function getId(): string {
                return 'Value';
            }
        };

        $option = Option::makeFromKeyValue('key', $object);

        $this->assertEquals('Value', $option->getValue());
    }

    /** @test */
    public function make_option_from_object_with_get_value_method()
    {
        $object = new class {
            public string $name = 'Label';

            public function getValue(): string {
                return 'Value';
            }
        };

        $option = Option::makeFromKeyValue('key', $object);

        $this->assertEquals('Value', $option->getValue());
    }
}
