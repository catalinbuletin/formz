<?php

namespace Formz\Console;

use Illuminate\Console\GeneratorCommand;

class FormMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'formz:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Form';


    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/form.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Forms';
    }
}
