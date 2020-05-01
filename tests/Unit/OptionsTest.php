<?php

namespace Unit;

use Formz\Option;
use Formz\Options;

class OptionsTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    /** @test */
    public function resolver_accepts_array()
    {
        $options = new Options(['key' => '1']);

        $this->assertArrayHasKey('key', $options->getResolver());
    }

    /** @test */
    public function resolver_accepts_self_instance()
    {
        $options = new Options(new Options([]));

        $this->assertInstanceOf(Options::class, $options->getResolver());
    }

    /** @test */
    public function options_are_created_after_resolving_array()
    {
        $options = new Options(['value1'=> 'label1', 'value2' => 'label2']);

        $this->assertCount(0, $options);

        $options->resolve();

        $this->assertCount(2, $options);
        $this->assertInstanceOf(Option::class, $options['value1']);
        $this->assertEquals('value1', $options['value1']->getValue());
        $this->assertEquals('label1', $options['value1']->getLabel());
    }

    /** @test */
    public function options_are_created_after_resolving_closure()
    {
        $options = new Options(fn() => ['value1'=> 'label1', 'value2' => 'label2']);

        $this->assertCount(0, $options);

        $options->resolve();

        $this->assertCount(2, $options);
        $this->assertInstanceOf(Option::class, $options['value1']);
        $this->assertEquals('value1', $options['value1']->getValue());
        $this->assertEquals('label1', $options['value1']->getLabel());
    }

    /** @test */
    public function options_are_created_after_resolving_laravel_collection()
    {
        $options = new Options(collect(['value1'=> 'label1', 'value2' => 'label2']));

        $this->assertCount(0, $options);

        $options->resolve();

        $this->assertCount(2, $options);
        $this->assertInstanceOf(Option::class, $options['value1']);
        $this->assertEquals('value1', $options['value1']->getValue());
        $this->assertEquals('label1', $options['value1']->getLabel());
    }
}
