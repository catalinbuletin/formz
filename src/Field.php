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
     * @param $value
     * @param string|null $label
     *
     * @return Text
     */
    public static function text(string $name, string $label = null, $value = null): Text
    {
        return new Text($name, $value, $label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return Password
     */
    public static function password(string $name, string $label = null, $value = null): Password
    {
        return new Password($name, $value, $label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return Textarea
     */
    public static function textarea(string $name, string $label = null, $value = null): Textarea
    {
        return new Textarea($name, $value, $label);

    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     *
     * @return Hidden
     */
    public static function hidden(string $name, string $label = null, $value = null): Hidden
    {
        return new Hidden($name, $value, $label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return NumberField
     */
    public static function number(string $name, string $label = null, $value = null): NumberField
    {
        return new NumberField($name, $value, $label);
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return Choice
     */
    public static function select(string $name, Options $options, string $label = null, $value = null): Choice
    {
        $type = 'select';

        return new Choice($type, $name, $options, $value, $label);
    }


    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return Choice
     */
    public static function selectMultiple(string $name, Options $options, string $label = null, $value = null): Choice
    {
        $type = 'multiselect';

        return new Choice($type, $name, $options, $value, $label);
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return Radio
     */
    public static function radio(string $name, Options $options, string $label = null, $value = null): Radio
    {
        return new Radio($name, $options, $value, $label);
    }

    /**
     * @param string $name
     * @param Options $options
     * @param $value
     * @param string|null $label
     *
     * @return Checkbox
     */
    public static function checkbox(string $name, Options $options, string $label = null, $value = null): Checkbox
    {
        return new Checkbox($name, $options, $value, $label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return Date
     */
    public static function date(string $name, $label = null, $value = null): Date
    {
        return new Date($name, $value, $label);
    }

    /**
     * @param string $name
     * @param $value
     * @param string|null $label
     * @return File
     */
    public static function file(string $name, $value = null, $label = null): File
    {
        return new File($name, $value, $label);
    }
}
