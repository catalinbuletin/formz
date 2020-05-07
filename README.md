# An easy to use Form Builder for Laravel

The package provides a nice and easy way to generate and manage forms in your Laravel application.

It supports out of the box a few CSS frameworks (Bootstrap 4, Bulma, Foundation) so you can skip directly to what matters to you.


Creating forms is just as easy as ABC.

A. Create your custom form

```php
$formBuilder = $this->build()
            ->section()
                ->text('name')->required()
                ->text('email')->rules(['required', 'email'])
                ->textarea('description')
            ->get();
```

B. Load the form in your view

```php
$form = $formBuilder->form();
return response()->view('welcome', compact('form'));
```

C. Use the Laravel blade component in your view

```html
<x-formz-form :form="$form"></x-formz-form>
```

## Requirements

- Laravel 7
- PHP 7.4


## CSS Frameworks supported out of the box

1. Bootstrap 4
1. Bulma
1. Foundation


## Installation

You can pull in the package via composer 

```composer
composer require catalinbuletin/formz
```

The package will automatically register itself.


## How to use

1. **Set the theme**

    If you want to change the default theme, you have to publish the package's config file
    
    ```
    php artisan vendor:publish --provider="Formz\FormzServiceProvider" --tag=config
    ```
    The config file published under `/config` is named `formz.php`. Here you can change 

1. **Create a custom form using the builder**

    ```html
   php artisan formz:make CustomForm 
   ```
   
   This will create a new file named `CustomForm.php` under `app/Forms` directory
   
   ```html
    namespace App\Forms;
    
    use Formz\AbstractForm;
    use Formz\Contracts\IForm;
    
    class CustomForm extends AbstractForm
    {
        /**
         * Create a new form instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }
    
        protected function buildForm(): IForm
        {
            return
                $this->build()
                    // add sections and fields here
                    ->get();
        }
    
    }
    ```
   
   You can now start add sections and fields inside your form.
   You can check the entire API documentation here.

1. **Load the custom form from a controller into your view**

    ```php
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CustomForm $customForm)
    {
        $form = $customForm->form();
        return response()->view('welcome', compact('form'));
    }
    ```
   
1. **Display the blade component inside your view**

    ```html
    <x-formz-form :form="$form"></x-formz-form>
    ```
   
   This will automatically generate your form using the theme specified in the config file.
   
   

