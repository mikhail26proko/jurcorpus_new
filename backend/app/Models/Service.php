<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends ExtendModel
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'sort',
    ];
}
