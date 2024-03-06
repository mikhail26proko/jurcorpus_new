<?php

declare(strict_types=1);

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;

class EmployeeFilter extends Filter
{
    /**
     * The array of matched parameters.
     *
     * @return array
     */
    public function parameters(): array
    {
        return ['filter'];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        $filter = $this->request->get('filter');

        if (!empty($filter))
        {
            if (!empty($employee = $filter['employee_id'] ?? null))
            {
                return $builder->whereHas('employee', function (Builder $query) use ($employee) {
                    return $query->whereIn('id', $employee);
                });
            }
        }
        return $builder;
    }
}
