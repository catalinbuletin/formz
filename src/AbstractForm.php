<?php

namespace Formz;

use Formz\Contracts\IForm;
use Formz\Fluent\FluentForm;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

abstract class AbstractForm implements \JsonSerializable
{
    protected IForm $form;

    abstract protected function buildForm(): IForm;


    public function __construct()
    {
        $this->form = $this->buildForm();
    }

    public function form()
    {
        return $this->form;
    }

    public function validate(?Request $request = null)
    {
        $request = $request ?: request();

        return $this->form->validate($request);
    }

    public function isValid(?Request $request = null): bool
    {
        $request = $request ?: request();

        try {
            $this->validate($request);

            return true;
        } catch (ValidationException $exception) {
            return false;
        }
    }

    public function data(?Request $request = null): Collection
    {
        $request = $request ?: request();

        return collect($request->only(
            $this->form->getFieldNames()
        ));
    }

    public function fields(): array
    {
        return $this->form->getFieldNames();
    }

    public function validationRules(): array
    {
        return $this->form->getValidationRules();
    }

    protected function build()
    {
        return FluentForm::make();
    }

    public function jsonSerialize()
    {
        return $this->form->toArray();
    }
}
