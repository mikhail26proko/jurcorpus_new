<?php

namespace App\Models;

class Direction extends ExtendModel
{
    protected $fillable = [
        'title'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
