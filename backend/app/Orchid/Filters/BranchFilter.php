<?php

declare(strict_types=1);

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;

class BranchFilter extends Filter
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
            if (!empty($branches =  $filter['branch'] ?? null))
            {
                return $builder->whereHas('branch', function (Builder $query) use ($branches) {
                    return $query->whereIn('id', $branches);
                });
            }
        }
        return $builder;
    }
}
