<?php

namespace App\Traits\Builder;

use Illuminate\Database\Eloquent\Builder;

trait OptionBuilderTrait {

    private function builder(): Builder
    {
        return (new $this->model)
            ->with($this->relationship)
            ->withCount($this->relationship)
                ->orderBy('created_at','desc');
    }

}
