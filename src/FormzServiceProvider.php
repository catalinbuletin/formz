<?php

namespace Formz;

use Formz\View\Components\Form;
use Formz\View\Components\Section;
use Formz\View\Components\Field;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class FormzServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/formz.php' => config_path('formz.php')
        ], 'config');

        /**
         * Not yet supported
         */
//        $this->publishes([
//            __DIR__.'/View/Components/Form.php' => app_path('View/Components/Form.php'),
//            __DIR__.'/View/Components/Section.php' => app_path('View/Components/Section.php'),
//            __DIR__.'/View/Components/Field.php' => app_path('View/Components/Field.php'),
//        ], 'bladeComponentsClasses');


        $theme = Config::get('formz.theme');

        $this->publishes([
            __DIR__.'/../resources/views/components/inputs' => resource_path('views/vendor/formz/components/inputs'),
            __DIR__."/../resources/views/components/{$theme}" => resource_path("views/vendor/formz/components/{$theme}"),
        ], 'views');

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
