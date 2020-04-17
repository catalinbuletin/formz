<?php

namespace Formz;

use Formz\Blade\Components\Form;
use Formz\Blade\Components\Section;
use Formz\Blade\Components\Field;
use Illuminate\Support\ServiceProvider;

class FormzServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            // Config
            __DIR__.'/../config/formz.php' => config_path('formz.php')
            ], 'config');

        /*$this->publishes([
            __DIR__.'/../src/Blade/Components/Form.php' => app_path('View/Components/Form.php'),
            __DIR__.'/../src/Blade/Components/Section.php' => app_path('View/Components/Section.php'),
            __DIR__.'/../src/Blade/Components/Field.php' => app_path('View/Components/Field.php'),
        ], 'bladeComponentsClasses');

        $this->publishes([
            __DIR__.'/../resources/views/components/inputs' => resource_path('views/vendor/formz/components/inputs'),
            __DIR__.'/../resources/views/components/bulma' => resource_path('views/vendor/formz/components/bulma'),
        ], 'bulmaBladeComponents');*/

//        $this->publishes([
//            // Translations
//            __DIR__.'/../resources/lang' => resource_path('lang/vendor/formz'),
//        ], 'translations');

//      $this->publishes([
//            // Assets
//            __DIR__.'/../resources/js' => public_path('vendor/formz/js'),
//            __DIR__.'/../resources/css' => public_path('vendor/formz/css'),
//      ], 'assets');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'formz');
        $this->loadViewComponentsAs('formz', [
            Form::class,
            Section::class,
            Field::class,
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/formz.php', 'formz');
    }
}
