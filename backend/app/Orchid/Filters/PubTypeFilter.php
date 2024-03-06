<?php

declare(strict_types=1);

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;

class PubTypeFilter extends Filter
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
            if (!empty($pub_type = $filter['pub_type_id'] ?? null))
            {
                return $builder->whereHas('pub_type', function (Builder $query) use ($pub_type) {
                    return $query->whereIn('id', $pub_type);
                });
            }
        }
        return $builder;
    }
}
