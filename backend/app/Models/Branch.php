<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Branch extends Model
{
    use HasFactory,
        AsSource,
        Sortable,
        Filterable;

    protected $fillable = [
        'title',
        'address',
        'phone',
        'email',
        'latitude',
        'longitude',
        'created_at',
    ];

    protected $appends = [
        'employee_count'
    ];

    // /**
    //  * The attributes for which can use sort in url.
    //  *
    //  * @var array
    //  */
    // protected $allowedSorts = [
    //     'title',
    //     'address',
    //     'email',
    // ];

    // /**
    //  * The attributes for which you can use filters in url.
    //  *
    //  * @var array
    //  */
    // protected $allowedFilters = [
    //     'title',
    //     'address',
    //     'email',
    // ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function getEmployeeCountAttribute()
    {
        return $this->hasMany(Employee::class)->count();
    }

    // public function lozalization(){
    //     return $this->morphMany(Localization::class, 'localizable');
    // }
}