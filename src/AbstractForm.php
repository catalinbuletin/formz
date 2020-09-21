<?php

namespace Formz;

use Formz\Contracts\IForm;
use Formz\Fluent\FluentForm;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

abstract class AbstractForm implements \JsonSerializable
{
    /**
     * @var IForm
     */
    protected IForm $form;

    /**
     * @return IForm
     */
    abstract protected function buildForm(): IForm;

    /**
     * AbstractForm constructor.
     */
    public function __construct()
    {
        $this->form = $this->buildForm();
    }

    /**
     * @return IForm
     */
    public function form()
    {
        return $this->form;
    }

    public function fill($data)
    {
        $this->form->setFormData($data);
        $this->form->fill();
    }

    /**
     * @param Request|null $request
     *
     * @return mixed
     */
    public function validate(?Request $request = null)
    {
        $request = $request ?: request();

        return $this->form->validate($request);
    }

    /**
     * @param Request|null $request
     *
     * @return bool
     */
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

    /**
     * @param Request|null $request
     *
     * @return Collection
     */
    public function data(?Request $request = null): Collection
    {
        $request = $request ?: request();

        return collect($request->only(
            $this->form->getFieldNames()
        ));
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return $this->form->getFieldNames();
    }

    /**
     * @return array
     */
    public function validationRules(): array
    {
        return $this->form->getValidationRules();
    }

    /**
     * @return FluentForm
     */
    protected function build()
    {
        return FluentForm::make();
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return $this->form->toArray();
    }
}
