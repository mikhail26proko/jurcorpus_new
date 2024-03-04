<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;

class FullNameSort extends Filter
{
    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['sort'];
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
        $sort = $this->request->get('sort') ?? null;

        $vector = ($sort == 'full_name') ? 'asc' : (($sort == '-full_name') ? 'desc': '');

        if (!empty($vector)) {
            return $builder->orderBy('last_name', $vector)
                ->orderBy('first_name', $vector)
                    ->orderBy('sur_name', $vector);
        }

        return $builder;
    }
}
