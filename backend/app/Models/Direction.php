<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Direction extends ExtendModel
{
    use SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
