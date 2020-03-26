<?php

namespace Formz\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * @property \Ramsey\Uuid\UuidInterface id
 * @property array form_data
 * @property \Formz\Contracts\IForm builder
 * @property string module
 * @property string zone
 * @property string entity
 * @property string|null conceptName
 * @property string|null name
 *
 * @method static conceptName(string $conceptName)
 * @method static conceptNames(array $conceptNames)
 * @method static zone(string $zone)
 * @method static module(string $module)
 */
class Form extends WriteModel
{
    protected $table = 'form';

    protected $casts = [
        'form_data' => 'array'
    ];

    protected $appends = [
        'builder',
        'entity'
    ];

    /** @var array Form Values to be set on the builder instance */
    private $values = [];

    public function scopeModule(Builder $builder, $module)
    {
        $builder->where('module', $module);
    }

    public function scopeZone(Builder $builder, $zone)
    {
        $builder->where('zone', $zone);
    }

    public function scopeConceptName(Builder $builder, $conceptName)
    {
        $builder->where('concept_name', $conceptName);
    }

    public function scopeConceptNames(Builder $builder, array $conceptNames)
    {
        $builder->whereIn('concept_name', $conceptNames);
    }

    /**
     * @return \Formz\Contracts\IForm
     * @throws \Formz\Exceptions\FormException
     */
    public function getBuilderAttribute()
    {
        if (empty($this->form_data) && $this->conceptName) {
            return FormBuilder::makeFromConceptName($this->module, $this->zone, $this->conceptName)
                ->setValues($this->values);
        }

        return FormBuilder::makeFromArray($this->form_data)
            ->setValues($this->values);
    }

    public function getNameAttribute($value)
    {
        if ($value) {
            return $value;
        }

        if (!$this->conceptName) {
            return 'N/A';
        }

        return trans('forms.' . Str::slug($this->conceptName));
    }

    public function getEntityAttribute()
    {
        return $this->zone;
    }

    public function setValues($values)
    {
        $this->values = $values;
    }
}
