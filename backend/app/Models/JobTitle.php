<?php

namespace App\Models;

class JobTitle extends ExtendModel
{
    protected $fillable = [
        'title'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

}
