<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Employee extends Model
{

    use HasFactory,
        AsSource,
        Sortable,
        Filterable,
        Attachable;

    protected $fillable = [
        'last_name',
        'first_name',
        'sur_name',
        'email',
        'phone',
        'branch_id'
    ];

    protected $appends = [
        'full_name'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function getFullNameAttribute()
    {
        return implode(' ',[$this->last_name, $this->first_name, $this->sur_name]);
    }

    // public function lozalization(){
    //     return $this->morphMany(Localization::class, 'localizable');
    // }
}