<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class JobTitle extends Model
{
    use HasFactory,
        AsSource,
        Sortable,
        Filterable;

    protected $fillable = [
        'title'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

}
