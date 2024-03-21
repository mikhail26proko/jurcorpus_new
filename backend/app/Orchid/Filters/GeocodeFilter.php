<?php

declare(strict_types=1);

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;

class GeocodeFilter extends Filter
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

        if ($filter['geocode'])
        {
            return $builder->whereNotNull(['latitude','longitude']);
        }
        return $builder;
    }
}

