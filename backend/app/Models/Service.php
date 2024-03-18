<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Platform\Concerns\Sortable;

class Service extends ExtendModel
{
    use SoftDeletes, Sortable;

    protected $fillable = [
        'title',
        'content',
        'sort',
    ];

    public function getSortColumnName(): string
    {
        return 'sort';
    }

}
