<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends ExtendModel
{
    use SoftDeletes;

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
        // 'employees_count'
    ];

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