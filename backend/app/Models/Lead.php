<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Filters\Types\WhereIn;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Lead extends Model
{
    use HasFactory,
        AsSource,
        Sortable,
        Filterable;

    /**
     * @var array
     */
    protected $allowedFilters = [
        'status'       => WhereIn::class,
    ];

    protected $fillable = [
        'fio',
        'email',
        'phone',
        'message',
        'status',
    ];

}
