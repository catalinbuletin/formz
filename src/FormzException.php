<?php

namespace Formz;

use Throwable;

class FormzException extends \Exception
{
    public function __construct($message = '', $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function couldNotResolveOptions($field)
    {
        return new static("Could not resolve options for the '{$field}' field");
    }
}
