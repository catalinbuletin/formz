<?php

namespace Formz;

use Formz\Blade\Components\Form;
use Formz\Blade\Components\Section;
use Formz\Blade\Components\Field;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->publishes([
            // Config
            __DIR__.'/../config/formz.php' => config_path('formz.php'),

            // Views
//            __DIR__.'/../resources/views/components' => resource_path('views/vendor/package/view-1.blade.php'),
//            __DIR__.'/../resources/views/view-2.blade.php' => resource_path('views/vendor/package/view-2.blade.php'),
//
//            // Translations
//            __DIR__.'/../resources/lang' => resource_path('lang/vendor/package-name'),
//
//            // Assets
//            __DIR__.'/../resources/js' => public_path('vendor/package-name/js'),
//            __DIR__.'/../resources/css' => public_path('vendor/package-name/css'),
        ]);

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
