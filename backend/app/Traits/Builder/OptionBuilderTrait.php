<?php

namespace App\Traits\Builder;

use Illuminate\Database\Eloquent\Builder;

trait OptionBuilderTrait {

    protected string $orderByFuild = 'created_at';
    protected string $orderByVector = 'asc';

    private function builder(): Builder
    {
        return (new $this->model)
            ->with($this->relationship)
            ->withCount($this->relationship)
                ->orderBy($this->orderByFuild, $this->orderByVector);
    }
}
