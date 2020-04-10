<?php


namespace Formz;


use Formz\Contracts\IForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseForm
{
    protected IForm $builder;

    /**
     * @var string|null
     */
    protected ?string $model;


    /**
     * BaseForm constructor.
     * @param string|null $model
     */
    public function __construct()
    {
        $this->builder = $this->build();
    }

    abstract public function build(): IForm;

    /**
     * @return IForm
     */
    public function getBuilder(): IForm
    {
        return $this->builder;
    }

    /**
     * @return array|void
     */
    public function validate(Request $request)
    {
        return request()->validate($this->builder->getValidationRules());
    }

    /**
     * @param array|null $params
     * @return Model
     */
    public function store(?array $params = []): Model
    {
        if ($this->model) {
            $newEntity = new $this->model();



            $newEntity->save(request()->only($this->builder->getFieldNames()));
            return $newEntity;
        }

        return null;
    }
}
