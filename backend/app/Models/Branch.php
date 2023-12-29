<?php

namespace App\Models;

class Branch extends ExtendModel
{
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