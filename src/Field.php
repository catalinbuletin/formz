<?php

namespace Formz;

use Formz\Fields\Checkbox;
use Formz\Fields\Choice;
use Formz\Fields\Date;
use Formz\Fields\File;
use Formz\Fields\Hidden;
use Formz\Fields\Number as NumberField;
use Formz\Fields\Password;
use Formz\Fields\Radio;
use Formz\Fields\Text;
use Formz\Fields\Textarea;

class Field
{
    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return Text
     */
    public static function text(string $name, string $label = null, $value = null): Text
    {
        return new Text($name, $label, $value);
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return Password
     */
    public static function password(string $name, string $label = null, $value = null): Password
    {
        return new Password($name, $label, $value);
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return Textarea
     */
    public static function textarea(string $name, string $label = null, $value = null): Textarea
    {
        return new Textarea($name, $label, $value);

    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     *
     * @return Hidden
     */
    public static function hidden(string $name, string $label = null, $value = null): Hidden
    {
        return new Hidden($name, $label, $value);
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     * @return NumberField
     */
    public static function number(string $name, string $label = null, $value = null): NumberField
    {
        return new NumberField($name, $label, $value);
    }

    /**
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param $value
     *
     * @return Choice
     */
    public static function select(string $name, $options, string $label = null, $value = null): Choice
    {
        $type = 'select';

        return new Choice($type, $name, $options, $label, $value);
    }


    /**
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param $value
     *
     * @return Choice
     */
    public static function selectMultiple(string $name, $options, string $label = null, $value = null): Choice
    {
        $type = 'multiselect';

        return new Choice($type, $name, $options, $label, $value);
    }

    /**
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param $value
     *
     * @return Radio
     */
    public static function radio(string $name, $options, string $label = null, $value = null): Radio
    {
        return new Radio($name, $options, $label, $value);
    }

    /**
     * @param string $name
     * @param iterable|\Closure $options
     * @param string|null $label
     * @param $value
     *
     * @return Checkbox
     */
    public static function checkbox(string $name, $options, string $label = null, $value = null): Checkbox
    {
        return new Checkbox($name, $options, $label, $value);
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     * @return Date
     */
    public static function date(string $name, string $label = null, $value = null): Date
    {
        return new Date($name, $label, $value);
    }

    /**
     * @param string $name
     * @param string|null $label
     * @param $value
     * @return File
     */
    public static function file(string $name, string $label = null, $value = null): File
    {
        return new File($name, $label, $value);
    }
}
