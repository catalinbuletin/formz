<?php

namespace Formz;

use Illuminate\Support\Arr;

class ResourceLibrary
{
    public static function get()
    {
        return [
            [
                'name' => 'employees',
                'label' => ucfirst(trans('organization.employees')),
                'availableConditionFields' => ['manager', 'department']
            ], [
                'name' => 'managers',
                'label' => trans('organization.managers'),
                'availableConditionFields' => []
            ], [
                'name' => 'organizationRole',
                'label' => ucfirst(trans('organization.organization-roles')),
                'availableConditionFields' => []
            ], [
                'name' => 'departmentalEntity',
                'label' => ucfirst(trans('organization.departmental-entity')),
                'availableConditionFields' => []
            ], [
                'name' => 'departmentalEntityTree',
                'label' => ucfirst(trans('organization.departmental-entity-tree')),
                'availableConditionFields' => []
            ], [
                'name' => 'company',
                'label' => ucfirst(trans('forms.fields.company')),
                'availableConditionFields' => []
            ], [
                'name' => 'companyOffice',
                'label' => ucfirst(trans('forms.fields.company-office')),
                'availableConditionFields' => ['company']
            ],
        ];
    }

    public static function find($resourceName)
    {
        return Arr::first(self::get(), function ($resource) use ($resourceName) {
            return $resource['name'] === $resourceName;
        });
    }
}
